<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testing Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .table-responsive {
            display: block;
            width: 100%;
            overflow: hidden;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            white-space: nowrap;
        }
    </style>
</head>
<body>

@extends('dashboard.index')

@section('content')
<div class="container">
    <button class="btn btn-primary" id="addNewContent">Add New Content</button>

    <table class="table" id="testingTable">
        <thead>
            <tr>
                <th>Steps</th>
                <th>Description</th>
                <th>Images</th>
                <th>App</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Add New Content Modal -->
<div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContentModalLabel">Add New Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="dynamicFields"></div>
                <button type="button" class="btn btn-success" id="addStep">+</button>
                <button type="button" class="btn btn-danger" id="removeStep">-</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitAddContent">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Content Modal -->
<div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContentModalLabel">Edit Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="editDynamicFields"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitEditContent">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
let stepCount = 1;

// Load DataTable
$(document).ready(function() {
    loadTableData();

    // CSRF token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add New Content Button
    $('#addNewContent').click(function() {
        stepCount = 1;
        $('#dynamicFields').html(getStepField(stepCount));
        $('#addContentModalLabel').text('Add New Content');
        $('#addContentModal').modal('show');
    });

    // Add Step Button for Add Modal
    $('#addStep').click(function() {
        stepCount++;
        $('#dynamicFields').append(getStepField(stepCount));
    });

    // Remove Step Button for Add Modal
    $('#removeStep').click(function() {
        if (stepCount > 1) {
            stepCount--;
            $('#dynamicFields .step-field:last-child').remove();
        }
    });

    // Submit Add Content Button
    $('#submitAddContent').click(function() {
        let formData = prepareFormData('#dynamicFields');
        $.ajax({
            url: '{{ route('testings.store') }}',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#addContentModal').modal('hide');
                $('#testingTable').DataTable().ajax.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Load DataTable
    function loadTableData() {
        $('#testingTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('testings.index') }}',
            columns: [
                { data: 'steps', name: 'steps' },
                { data: 'description', name: 'description' },
                { data: 'images', name: 'images', render: function(data) {
                    return data.map(image => `<img src="{{ asset('${image}') }}" style="width: 50px; height: 50px;"/>`).join(' ');
                }},
                { data: 'app', name: 'app' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    }

    // Function to get step field HTML
    function getStepField(stepNumber) {
        return `
            <div class="step-field mb-3">
                <input type="text" name="steps[]" class="form-control" placeholder="Step ${stepNumber}" required />
                <textarea name="description[]" class="form-control" placeholder="Description" required></textarea>
                <input type="file" name="image[]" class="form-control" />
                <select name="app[]" class="form-control">
                    <option value="app1">App 1</option>
                    <option value="app2">App 2</option>
                </select>
            </div>
        `;
    }

    // Edit functionality
    $(document).on('click', '.edit', function() {
        const id = $(this).data('id');
        $.ajax({
            url: `{{ url('admin/testings') }}/${id}/edit`,
            method: 'GET',
            success: function(data) {
                $('#editDynamicFields').empty();
                data.steps.forEach((step, index) => {
                    $('#editDynamicFields').append(getEditStepField(data, index));
                });
                $('#editContentModal').data('id', id); // Store the ID for the update
                $('#editContentModal').modal('show');
            }
        });
    });

    // Function to get edit step field HTML
    function getEditStepField(data, index) {
        return `
            <div class="step-field mb-3">
                <input type="text" name="steps[]" class="form-control" value="${data.steps[index]}" placeholder="Step" required />
                <textarea name="description[]" class="form-control" required placeholder="Description">${data.description[index]}</textarea>
                <input type="file" name="image[]" class="form-control" />
                <select name="app[]" class="form-control">
                    <option value="app1" ${data.app[index] === 'app1' ? 'selected' : ''}>App 1</option>
                    <option value="app2" ${data.app[index] === 'app2' ? 'selected' : ''}>App 2</option>
                </select>
            </div>
        `;
    }

    // Submit Edit Content Button
    $('#submitEditContent').click(function() {
        const id = $('#editContentModal').data('id'); // Get the ID of the item being edited
        let formData = prepareFormData('#editDynamicFields');

        // Log the form data to debug
        for (let pair of formData.entries()) {
            console.log(`${pair[0]}: ${pair[1]}`);
        }

        $.ajax({
            url: `{{ url('admin/testings') }}/${id}`,
            method: 'PUT',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#editContentModal').modal('hide');
                $('#testingTable').DataTable().ajax.reload();
            },
            error: function(xhr) {
                console.log('Error Response:', xhr.responseJSON);
            }
        });
    });

    // Delete functionality
    $(document).on('click', '.delete', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: `{{ url('admin/testings') }}/${id}`,
                method: 'DELETE',
                success: function(response) {
                    $('#testingTable').DataTable().ajax.reload();
                }
            });
        }
    });

    // Prepare form data for submission
    function prepareFormData(dynamicFieldSelector) {
        let formData = new FormData();
        // Collect steps
        $(`${dynamicFieldSelector} input[name="steps[]"]`).each(function() {
            formData.append('steps[]', $(this).val());
        });
        // Collect descriptions
        $(`${dynamicFieldSelector} textarea[name="description[]"]`).each(function() {
            formData.append('description[]', $(this).val());
        });
        // Collect images
        $(`${dynamicFieldSelector} input[name="image[]"]`).each(function() {
            if (this.files.length > 0) {
                formData.append('image[]', this.files[0]);
            }
        });
        // Collect app selections
        $(`${dynamicFieldSelector} select[name="app[]"]`).each(function() {
            formData.append('app[]', $(this).val());
        });
        return formData;
    }
});
</script>
@endsection

</body>
</html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">


<title>Manage Descriptions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<style>
    .image-preview { max-width: 100px; margin-top: 10px; display: none; }
    .field-buttons { position: absolute; right: 10px; top:-20px; }
    .description-field { position: relative; padding-top: 30px; }
    .quill-editor {
        height: 150px;
        border: 1px solid #ccc;
    }
</style>
</head>

<body>

@extends('dashboard.index')

@section('content')

<div class="container mt-5">

<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#descriptionModal">Add New Description</button>

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>App</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Add New Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="descriptionForm" enctype="multipart/form-data">

                    <div id="descriptionFields">
                        <div class="description-field mb-3">
                            <input type="text" class="form-control" name="title[]" value="Step 1" placeholder="Title" required>
                            <div class="quill-editor"></div>
                            <input type="file" class="form-control mt-2" name="image[]" accept="image/*" onchange="previewImage(event, this)">
                            <img class="image-preview" src="" alt="Image preview">
                            <select class="form-control mt-2" name="app[]">
                                <option value="app1">App 1</option>
                                <option value="app2">App 2</option>
                            </select>
                            <div class="field-buttons mb-5">
                                <button type="button" class="btn btn-primary add-field">+</button>
                                <button type="button" class="btn btn-danger remove-field" style="display:none;">-</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveDescription">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this description?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    let quillEditors = [];
    let step = 1;
    let editQuill;

    function initializeQuill(editorElement) {
        const quill = new Quill(editorElement, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['link'],
                    [{ 'color': [] }, { 'background': [] }],
                ]
            }
        });
        quillEditors.push(quill);
    }

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let isQuillInitialized = false;

        $('#descriptionModal').on('show.bs.modal', function() {
            $('#descriptionForm')[0].reset();
            $('.image-preview').hide();
            $('#descriptionId').val('');

            if (!isQuillInitialized) {
                initializeQuill($('.quill-editor')[0]);
                isQuillInitialized = true;
            }
        });

        $(document).on('click', '.add-field', function() {
            step++;
            const newField = `
                <div class="description-field mb-3">
                    <input type="text" class="form-control" name="title[]" value="Step ${step}" placeholder="Title" required>
                    <div class="quill-editor"></div>
                    <input type="file" class="form-control mt-2" name="image[]" accept="image/*" onchange="previewImage(event, this)">
                    <img class="image-preview" src="" alt="Image preview" style="display:none;">
                    <select class="form-control mt-2" name="app[]">
                        <option value="app1">App 1</option>
                        <option value="app2">App 2</option>
                    </select>
                    <div class="field-buttons">
                        <button type="button" class="btn btn-danger remove-field">-</button>
                    </div>
                </div>`;

            $('#descriptionFields').append(newField);

            initializeQuill($('#descriptionFields .description-field:last .quill-editor')[0]);
        });

        $(document).on('click', '.remove-field', function() {
            $(this).closest('.description-field').remove();
            updateSteps();
        });

        function updateSteps() {
            step = 0;
            $('#descriptionFields .description-field').each(function(index) {
                step++;
                $(this).find('input[name="title[]"]').val(`Step ${step}`);
            });
        }

        const descriptionTable = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('telemedicine.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description', render: function(data, type, row) {
                    return type === 'display' ? $('<div/>').html(data).text() : data;
                }},
                { data: 'app', name: 'app' },
                { data: 'image', name: 'image', render: function(data, type, row) {
                    return `<img src="/storage/${data}" alt="Image" style="width: 50px;">`;
                }},
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#saveDescription').click(function (e) {
            e.preventDefault();
            const formData = new FormData($('#descriptionForm')[0]);

            quillEditors.forEach((quill, index) => {
                const html = quill.root.innerHTML;
                formData.append('description[]', html);
            });

            $.ajax({
                type: "POST",
                url: "{{ route('telemedicine.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#descriptionModal').modal('hide');
                    $('.modal-backdrop').remove();
                    descriptionTable.ajax.reload();
                    toastr.success('Description saved successfully.');
                },
                error: function (response) {
                    toastr.error('Error saving description.');
                }
            });
        });
 $(document).on('click', '.delete', function() {
            const id = $(this).data('id');
            $('#confirmDelete').data('id', id); // Store the ID of the description to be deleted
            $('#deleteModal').modal('show');
        });

        // Confirm Delete
        $('#confirmDelete').click(function() {
            const id = $(this).data('id');
            $.ajax({
                type: 'DELETE',
                url: "{{ route('telemedicine.destroy', '') }}/" + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    descriptionTable.ajax.reload(); // Reload the table data
                    toastr.success('Description deleted successfully.');
                },
                error: function(response) {
                    toastr.error('Error deleting description.');
                }
            });
        });
    });

    // Preview the image when selected
    function previewImage(event, input) {
        const preview = $(input).siblings('.image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.hide(); // Hide preview if no file is selected
        }
    }
</script>

@endsection
</body>
</html>

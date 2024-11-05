<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Specialist Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 17px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 17px;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
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
        .table th {
            background-color: #f8f9fa;
            color: #212529;
        }
        .table td,
        .table th {
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            word-wrap: break-word;
        }
    </style>
</head>
<body>

@extends('dashboard.index')

@section('content')
<div class="container">

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSpecialistModal">
        Add New Specialist
    </button>
    <div class="table-responsive">
        <table class="table table-striped" id="specialists-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Specialist Name</th>
                    <th>Speciality</th>
                    <th>Specialist Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add Specialist Modal -->
<div class="modal fade" id="addSpecialistModal" tabindex="-1" aria-labelledby="addSpecialistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSpecialistModalLabel">Add New Specialist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSpecialistForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="image">Select Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; margin-top:10px; max-width:100%;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="specialist_name">Specialist Name</label>
                        <input type="text" id="specialist_name" name="specialist_name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="speciality">Speciality</label>
                        <input type="text" id="speciality" name="speciality" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="specialist_description">Specialist Description</label>
                        <div id="specialistDescriptionEditor"></div>
                        <input type="hidden" id="specialist_description" name="specialist_description">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Specialist Modal -->
<div class="modal fade" id="editSpecialistModal" tabindex="-1" aria-labelledby="editSpecialistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSpecialistModalLabel">Edit Specialist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSpecialistForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_specialist_id" name="specialist_id">
                    <div class="form-group mb-3">
                        <label for="edit_image">Select Image</label>
                        <input type="file" id="edit_image" name="image" class="form-control" accept="image/*">
                        <img id="edit_imagePreview" src="#" alt="Image Preview" style="display:none; margin-top:10px; max-width:100%;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_specialist_name">Specialist Name</label>
                        <input type="text" id="edit_specialist_name" name="specialist_name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_speciality">Speciality</label>
                        <input type="text" id="edit_speciality" name="speciality" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_specialist_description">Specialist Description</label>
                        <div id="editSpecialistDescriptionEditor"></div>
                        <input type="hidden" id="edit_specialist_description" name="specialist_description">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteSpecialistModal" tabindex="-1" aria-labelledby="deleteSpecialistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSpecialistModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this specialist?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var specialistDescriptionEditor = new Quill('#specialistDescriptionEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        var editSpecialistDescriptionEditor = new Quill('#editSpecialistDescriptionEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        $('#image').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#addSpecialistForm').on('submit', function(e) {
            e.preventDefault();
            $('#specialist_description').val(specialistDescriptionEditor.root.innerHTML);

            $.ajax({
                type: "POST",
                url: "{{ route('specialists.store') }}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addSpecialistModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addSpecialistForm')[0].reset();
                    specialistDescriptionEditor.root.innerHTML = '';
                    $('#imagePreview').hide();
                    $('#specialists-table').DataTable().ajax.reload();
                    alert('Specialist added successfully.');
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        alert('Validation errors:\n' + JSON.stringify(response.responseJSON.errors));
                    } else {
                        alert('Error adding specialist.');
                    }
                }
            });
        });

        var table = $('#specialists-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('specialists.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'image', name: 'image', render: function(data) {
                    return data ? `<img src="/storage/specialists/${data}" width="100"/>` : 'No Image';
                }},
                {data: 'specialist_name', name: 'specialist_name'},
                {data: 'speciality', name: 'speciality'},
                {data: 'description', name: 'description', render: function(data) {

            var plainText = $('<div>').html(data).text();
            var maxLength = 200;
            return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
        }},
                {data: 'status', name: 'status', render: function(data, type, row) {
                    return `
                        <label class="switch">
                            <input type="checkbox" class="toggle-status" data-id="${row.id}" ${data === 'active' ? 'checked' : ''}>
                            <span class="slider"></span>
                        </label>
                    `;
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#specialists-table').on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('specialists.index') }}" + '/' + id + '/edit', function(data) {
                $('#edit_specialist_id').val(data.id);
                $('#edit_specialist_name').val(data.specialist_name);
                $('#edit_speciality').val(data.speciality);
                editSpecialistDescriptionEditor.root.innerHTML = data.description;
                $('#edit_imagePreview').attr('src', '/storage/specialists/' + data.image).show();
                $('#editSpecialistModal').modal('show');
            });
        });

        $('#editSpecialistForm').on('submit', function(e) {
    e.preventDefault();
    $('#edit_specialist_description').val(editSpecialistDescriptionEditor.root.innerHTML);

    var id = $('#edit_specialist_id').val();
    $.ajax({
        type: "POST",
        url: "{{ route('specialists.update', '') }}/" + id,
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(response) {
            $('#editSpecialistModal').modal('hide');
            $('#editSpecialistForm')[0].reset();
            editSpecialistDescriptionEditor.root.innerHTML = '';
            $('#edit_imagePreview').hide();
            $('#specialists-table').DataTable().ajax.reload();
            alert('Specialist updated successfully.');
        },
        error: function(response) {
            if (response.responseJSON && response.responseJSON.errors) {
                alert('Validation errors:\n' + JSON.stringify(response.responseJSON.errors));
            } else {
                alert('Error updating specialist.');
            }
        }
    });
});

        var specialistIdToDelete;
        $('#specialists-table').on('click', '.delete', function() {
            specialistIdToDelete = $(this).data('id');
            $('#deleteSpecialistModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                type: "DELETE",
                url: "{{ route('specialists.destroy', '') }}/" + specialistIdToDelete,
                success: function(response) {
                    $('#specialists-table').DataTable().ajax.reload();
                    $('#deleteSpecialistModal').modal('hide');
                    alert('Specialist deleted successfully.');
                },
                error: function(response) {
                    alert('Error deleting specialist.');
                }
            });
        });

        $(document).on('change', '.toggle-status', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/admin/dashboard/specialists/' + id + '/toggle-status',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert(response.success);
                },
                error: function(response) {
                    console.error(response);
                    alert('Error toggling status: ' + response.responseText);
                }
            });
        });
    });
</script>
@endsection

</body>
</html>

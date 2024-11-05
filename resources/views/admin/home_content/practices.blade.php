<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPracticeModal">
        Add New Content
    </button>
    <div class="table-responsive">
        <table class="table table-striped" id="practices-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add Practice Modal -->
<div class="modal fade" id="addPracticeModal" tabindex="-1" aria-labelledby="addPracticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPracticeModalLabel">Add New Practice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPracticeForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="image">Select Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; margin-top:10px; max-width:100%;">
                    </div>
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <div id="titleEditor"></div>
                        <input type="hidden" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="subtitle">Subtitle</label>
                        <div id="subtitleEditor"></div>
                        <input type="hidden" id="subtitle" name="subtitle">
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <div id="descriptionEditor"></div>
                        <input type="hidden" id="description" name="description">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Practice Modal -->
<div class="modal fade" id="editPracticeModal" tabindex="-1" aria-labelledby="editPracticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPracticeModalLabel">Edit Practice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPracticeForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_practice_id" name="practice_id">
                    <div class="mb-3">
                        <label for="edit_image">Select Image</label>
                        <input type="file" id="edit_image" name="image" class="form-control" accept="image/*">
                        <img id="edit_imagePreview" src="#" alt="Image Preview" style="display:none; margin-top:10px; max-width:100%;">
                    </div>
                    <div class="mb-3">
                        <label for="edit_title">Title</label>
                        <div id="editTitleEditor"></div>
                        <input type="hidden" id="edit_title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="edit_subtitle">Subtitle</label>
                        <div id="editSubtitleEditor"></div>
                        <input type="hidden" id="edit_subtitle" name="subtitle">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description">Description</label>
                        <div id="editDescriptionEditor"></div>
                        <input type="hidden" id="edit_description" name="description">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deletePracticeModal" tabindex="-1" aria-labelledby="deletePracticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePracticeModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this practice?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var titleEditor = new Quill('#titleEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{'color': []}, {'background': []}],
                ['link'],
                ['clean']
            ]
        }
    });

    var subtitleEditor = new Quill('#subtitleEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{'color': []}, {'background': []}],
                ['link'],
                ['clean']
            ]
        }
    });

    var descriptionEditor = new Quill('#descriptionEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{'color': []}, {'background': []}],
                ['link'],
                ['clean']
            ]
        }
    });

    var editTitleEditor = new Quill('#editTitleEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{'color': []}, {'background': []}],
                ['link'],
                ['clean']
            ]
        }
    });

    var editSubtitleEditor = new Quill('#editSubtitleEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{'color': []}, {'background': []}],
                ['link'],
                ['clean']
            ]
        }
    });

    var editDescriptionEditor = new Quill('#editDescriptionEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{'color': []}, {'background': []}],
                ['link'],
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

    $('#edit_image').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#edit_imagePreview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#addPracticeForm').on('submit', function(e) {
        e.preventDefault();
        $('#title').val(titleEditor.root.innerHTML);
        $('#subtitle').val(subtitleEditor.root.innerHTML);
        $('#description').val(descriptionEditor.root.innerHTML);

        $.ajax({
            type: "POST",
            url: "{{ route('practices.store') }}",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                $('#addPracticeModal').modal('hide');
                $('#addPracticeForm')[0].reset();
                $('.modal-backdrop').remove();
                titleEditor.root.innerHTML = '';
                subtitleEditor.root.innerHTML = '';
                descriptionEditor.root.innerHTML = '';
                $('#imagePreview').hide();
                $('#practices-table').DataTable().ajax.reload();
                alert('Practice added successfully.');
            },
            error: function(response) {
                alert('Error adding practice.');
            }
        });
    });

    $(document).ready(function() {
        var table = $('#practices-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('practices.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'image', name: 'image', render: function(data) {
                    return data ? `<img src="/storage/practices/${data}" width="100"/>` : 'No Image';
                }},
                {data: 'title', name: 'title', render: function(data) {
                    return $('<div/>').html(data).text();
                }},
                {data: 'subtitle', name: 'subtitle', render: function(data) {
                    return $('<div/>').html(data).text();
                }},
                {data: 'description', name: 'description', render: function(data) {
                    return $('<div/>').html(data).text();
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#practices-table').on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('practices.index') }}" + '/' + id + '/edit', function(data) {
                $('#edit_practice_id').val(data.id);
                editTitleEditor.root.innerHTML = data.title;
                editSubtitleEditor.root.innerHTML = data.subtitle;
                editDescriptionEditor.root.innerHTML = data.description;
                $('#edit_imagePreview').attr('src', '/storage/practices/' + data.image).show();
                $('#editPracticeModal').modal('show');
            });
        });

        $('#editPracticeForm').on('submit', function(e) {
            e.preventDefault();
            $('#edit_title').val(editTitleEditor.root.innerHTML);
            $('#edit_subtitle').val(editSubtitleEditor.root.innerHTML);
            $('#edit_description').val(editDescriptionEditor.root.innerHTML);

            var id = $('#edit_practice_id').val();
            $.ajax({
                type: "POST",
                url: "{{ route('practices.update', '') }}/" + id,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editPracticeModal').modal('hide');
                    $('#editPracticeForm')[0].reset();
                    editTitleEditor.root.innerHTML = '';
                    editSubtitleEditor.root.innerHTML = '';
                    editDescriptionEditor.root.innerHTML = '';
                    $('#edit_imagePreview').hide();
                    $('#practices-table').DataTable().ajax.reload();
                    alert('Practice updated successfully.');
                },
                error: function(response) {
                    alert('Error updating practice.');
                }
            });
        });

        var practiceIdToDelete;
        $('#practices-table').on('click', '.delete', function() {
            practiceIdToDelete = $(this).data('id');
            $('#deletePracticeModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                type: "DELETE",
                url: "{{ route('practices.destroy', '') }}/" + practiceIdToDelete,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#practices-table').DataTable().ajax.reload();
                    $('#deletePracticeModal').modal('hide');
                    alert('Practice deleted successfully.');
                },
                error: function(response) {
                    alert('Error deleting practice.');
                }
            });
        });
    });
</script>
@endsection
</body>
</html>

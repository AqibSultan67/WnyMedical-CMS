<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Page Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <style>
        .table-wrapper {
            display: flex;
            flex-direction: row;
            overflow: hidden;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow: hidden;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            white-space: nowrap;
        }
        .table th {
            background-color: #4B49AC;
            color: white;
        }
        .table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }
        .table td,
        .table th {
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            word-wrap: break-word;
        }
        .editor {
            height: 200px;
        }
    </style>
</head>
<body>
    @extends('dashboard.index')

    @section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addContentModal">
            Add New Content
        </button>
        <div class="table-wrapper mt-3">
            <div class="table-responsive">
                <table class="table table-striped" id="content-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Decsription</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                <tbody></tbody>
            </div>
        </div>
    </div>

    <!-- Add Content Modal -->
    <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContentModalLabel">Add New Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addContentForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="addTitle">Title</label>
                            <input type="text" class="form-control" id="addTitle" name="title" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addLink">Link</label>
                            <input type="url" class="form-control" id="addLink" name="link" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="addDescription">Description</label>
                            <div id="addQuillEditor" class="editor"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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
                    <form id="editContentForm">
                        @csrf
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group mb-3">
                            <label for="editTitle">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editLink">Link</label>
                            <input type="url" class="form-control" id="editLink" name="link" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editDescription">Description</label>
                            <div id="editQuillEditor" class="editor"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Content Modal -->
    <div class="modal fade" id="deleteContentModal" tabindex="-1" aria-labelledby="deleteContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteContentModalLabel">Delete Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this content?</p>
                    <input type="hidden" id="deleteId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize DataTable
        var table = $('#content-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('media-link.index') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'title', name: 'title'},
        {data: 'link', name: 'link'},
        {data: 'description',
                    name: 'description',
                    render: function(data, type, row) {
                        return type === 'display' ? $('<div/>').html(data).text() : data;
                    }
                },
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

        // Initialize Quill editors
        var addQuill = new Quill('#addQuillEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ color: [] }, { background: [] }],
                    ['link', 'image', 'clean']
                ]
            }
        });

        var editQuill = new Quill('#editQuillEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ color: [] }, { background: [] }],
                    ['link', 'image', 'clean']
                ]
            }
        });

        // Handle Add Content Form Submission
        $('#addContentForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize() + '&description=' + addQuill.root.innerHTML;
            $.ajax({
                type: "POST",
                url: "{{ route('media-link.store') }}",
                data: formData,
                success: function(response) {
                    $('#addContentModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addContentForm')[0].reset();
                    addQuill.setContents([]);
                    table.ajax.reload();
                    alert('Content added successfully');
                },
                error: function(response) {
                    alert('Error adding content');
                }
            });
        });

      // Handle Edit Button Click
$(document).on('click', '.edit', function() {
    var id = $(this).data('id');
    $.get("{{ route('media-link.index') }}" + '/' + id + '/edit', function(data) {
        $('#editId').val(data.id);
        $('#editTitle').val(data.title);
        $('#editLink').val(data.link);
        editQuill.root.innerHTML = data.description; // Populate Quill editor with description
        $('#editContentModal').modal('show');
    });
});

// Handle Edit Content Form Submission
$('#editContentForm').on('submit', function(e) {
    e.preventDefault();
    var id = $('#editId').val();
    var formData = $(this).serialize() + '&description=' + editQuill.root.innerHTML; // Include description
    $.ajax({
        type: "PUT",
        url: "{{ route('media-link.update', '') }}/" + id,
        data: formData,
        success: function(response) {
            $('#editContentModal').modal('hide');
            table.ajax.reload();
            alert('Content updated successfully');
        },
        error: function(response) {
            alert('Error updating content');
        }
    });
});
        // Handle Edit Button Click
        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('media-link.index') }}" + '/' + id + '/edit', function(data) {
                $('#editId').val(data.id);
                $('#editTitle').val(data.title);
                $('#editLink').val(data.link);
                editQuill.root.innerHTML = data.description;
                $('#editContentModal').modal('show');
            });
        });

        // Handle Delete Button Click
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            $('#deleteId').val(id);
            $('#deleteContentModal').modal('show');
        });

        // Confirm Delete
        $('#confirmDelete').on('click', function() {
            var id = $('#deleteId').val();
            $.ajax({
                type: "DELETE",
                url: "{{ route('media-link.destroy', '') }}/" + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteContentModal').modal('hide');
                    table.ajax.reload();
                    alert('Content deleted successfully');
                },
                error: function(response) {
                    alert('Error deleting content');
                }
            });
        });
    });
    </script>
    @endsection
</body>
</html>

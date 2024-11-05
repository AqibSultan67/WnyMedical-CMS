<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Info</title>
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
    </style>
</head>
<body>

@extends('dashboard.index')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addInfoModal">
        Add New Info
    </button>

    <div class="table-wrapper mt-3">
        <div class="table-responsive">
            <table class="table table-striped w-100" id="info-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Main Title</th>
                        <th>Description</th>
                        <th>Location Title</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add Info Modal -->
<div class="modal fade" id="addInfoModal" tabindex="-1" aria-labelledby="addInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInfoModalLabel">Add New Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addInfoForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Main Title</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div id="quillDescription" style="height: 200px;"></div>
                        <input type="hidden" name="description" id="descriptionInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="location_title" class="form-label">Location Title</label>
                        <input type="text" class="form-control" name="location_title" id="location_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Info Modal -->
<div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInfoModalLabel">Edit Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editInfoForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="infoId" name="infoId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Main Title</label>
                        <input type="text" class="form-control" name="title" id="edit_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <div id="quillEditDescription" style="height: 200px;"></div>
                        <input type="hidden" name="description" id="edit_descriptionInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_location_title" class="form-label">Location Title</label>
                        <input type="text" class="form-control" name="location_title" id="edit_location_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="edit_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="edit_phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteInfoModal" tabindex="-1" aria-labelledby="deleteInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteInfoModalLabel">Delete Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this info?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        var table = $('#info-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('info.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description', render: function(data) {
                    return $('<div/>').html(data).text();
                }},
                {data: 'location_title', name: 'location_title'},
                {data: 'address', name: 'address'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });


        var quill = new Quill('#quillDescription', {
            theme: 'snow'
        });

        $('#addInfoForm').submit(function(e) {
            e.preventDefault();
            $('#descriptionInput').val(quill.root.innerHTML);
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('info.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#addInfoModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addInfoForm')[0].reset();
                    quill.setContents([]);
                    table.ajax.reload();
                    alert('Info added successfully!');
                },
                error: function(response) {
                    alert('Failed to add info');
                }
            });
        });


        var editQuill = new Quill('#quillEditDescription', {
            theme: 'snow'
        });

        $(document).on('click', '.edit', function() {
    var infoId = $(this).data('id');
    var editUrl = "{{ route('info.index') }}" + '/' + infoId + '/edit';

    $.get(editUrl, function(data) {
        $('#infoId').val(data.id);
        $('#edit_title').val(data.title);
        editQuill.root.innerHTML = data.description;
        $('#edit_location_title').val(data.location_title);
        $('#edit_address').val(data.address);
        $('#edit_phone').val(data.phone);
        $('#edit_email').val(data.email);
        $('#editInfoModal').modal('show');
    }).fail(function(jqXHR) {
        console.log(jqXHR.responseText);
        alert('Could not retrieve info data');
    });
});
        $('#editInfoForm').submit(function(e) {
            e.preventDefault();
            $('#edit_descriptionInput').val(editQuill.root.innerHTML);
            let formData = new FormData(this);
            var infoId = $('#infoId').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('info.update', '') }}/" + infoId,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#editInfoModal').modal('hide');
                    $('#editInfoForm')[0].reset();
                    editQuill.setContents([]);
                    table.ajax.reload();
                    alert('Info updated successfully!');
                },
                error: function(response) {
                    alert('Failed to update info');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var infoId = $(this).data('id');
            $('#confirmDelete').data('id', infoId);
            $('#deleteInfoModal').modal('show');
        });

        $('#confirmDelete').click(function() {
            var infoId = $(this).data('id');

            $.ajax({
                type: 'DELETE',
                url: "{{ route('info.destroy', '') }}/" + infoId,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteInfoModal').modal('hide');
                    table.ajax.reload();
                    alert('Info deleted successfully!');
                },
                error: function(response) {
                    alert('Failed to delete info');
                }
            });
        });
    });
</script>
</body>
</html>

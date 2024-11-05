<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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


table td img,
.jsgrid .jsgrid-table td img {

    border: none !important;
    border-radius: 0 !important;
}
    </style>
</head>
<body>

@extends('dashboard.index')

@section('content')
<div class="container">

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAboutImageModal">
        Add New Image
    </button>

    <div class="table-wrapper mt-3">
        <div class="table-responsive">
            <table class="table table-striped w-100" id="schedule-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
            <tbody></tbody>
        </div>
    </div>

</div>

<div class="modal fade" id="addAboutImageModal" tabindex="-1" aria-labelledby="addAboutImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAboutImageModalLabel">Add New  Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAboutImageForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image">Choose Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <img id="imagePreview" src="#" alt="Preview" style="display: none; width: 100%; max-height: 300px;">
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

<div class="modal fade" id="editAboutImageModal" tabindex="-1" aria-labelledby="editAboutImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAboutImageModalLabel">Edit  Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAboutImageForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="aboutImageId" name="aboutImageId">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editImage">Choose Image</label>
                        <input type="file" name="image" id="editImage" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <img id="editImagePreview" src="#" alt="Preview" style="display: none; width: 100%; max-height: 300px;">
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


<div class="modal fade" id="deleteAboutImageModal" tabindex="-1" aria-labelledby="deleteAboutImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAboutImageModalLabel">Delete About Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this about image?</p>
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
        var table = $('#schedule-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('services-schedule.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'image', name: 'image', render: function(data) {
    return `<img src="/storage/schedule-images/${data}" style="width:100%; height:100px;"/>`;
}},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#addAboutImageForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('services-schedule.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#addAboutImageModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addAboutImageForm')[0].reset();
                    $('#imagePreview').hide();
                    table.ajax.reload();
                    alert('About image added successfully!');
                },
                error: function(response) {
                    alert('Failed to upload image');
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var aboutImageId = $(this).data('id');
            var editUrl = "{{ route('services-schedule.edit', '') }}/" + aboutImageId;
            $.get(editUrl, function(data) {
                $('#aboutImageId').val(data.id);
                $('#editImagePreview').attr('src', '/storage/schedule-images/' + data.image).show();
                $('#editAboutImageModal').modal('show');
            }).fail(function() {
                alert('Could not retrieve about image data');
            });
        });

        $('#editAboutImageForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            var aboutImageId = $('#aboutImageId').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('services-schedule.update', '') }}/" + aboutImageId,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#editAboutImageModal').modal('hide');
                    $('#editAboutImageForm')[0].reset();
                    $('#editImagePreview').hide();
                    table.ajax.reload();
                    alert('About image updated successfully!');
                },
                error: function(response) {
                    alert('Failed to update image');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var aboutImageId = $(this).data('id');
            $('#confirmDelete').data('id', aboutImageId);
            $('#deleteAboutImageModal').modal('show');
        });

        $('#confirmDelete').click(function() {
            var aboutImageId = $(this).data('id');

            $.ajax({
                type: 'DELETE',
                url: "{{ route('services-schedule.destroy', '') }}/" + aboutImageId,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteAboutImageModal').modal('hide');
                    table.ajax.reload();
                    alert('About image deleted successfully!');
                },
                error: function(response) {
                    alert('Failed to delete image');
                }
            });
        });


        $('#image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreview').show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#editImage').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#editImagePreview').attr('src', e.target.result);
                $('#editImagePreview').show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Team Title Images</title>
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
            background-color:#4B49AC;
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

@section('sliders')
<div class="container">

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSliderModal">
        Add New Image
    </button>

    <div class="table-wrapper mt-3">
        <div class="table-responsive">

    <table class="table table-striped w-100" id="slider-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
</div>

</div>

<div class="modal fade" id="addSliderModal" tabindex="-1" aria-labelledby="addSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSliderModalLabel">Add New Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSliderForm" enctype="multipart/form-data">
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

<div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="editSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSliderModalLabel">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSliderForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="sliderId" name="sliderId">
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteSliderModal" tabindex="-1" aria-labelledby="deleteSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSliderModalLabel">Delete Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this slider image?</p>
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
        var table = $('#slider-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('team-title-image.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'image', name: 'image', render: function(data) {
                    return `<img src="/storage/specialists/${data}" style="width:50%;" />`;
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#addSliderForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('team-title-image.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#addSliderModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addSliderForm')[0].reset();
                    $('#imagePreview').hide();
                    table.ajax.reload();
                    alert('Image added successfully!');
                },
                error: function(response) {
                    alert('Failed to upload image');
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var sliderId = $(this).data('id');
            var editUrl = "/admin/dashboard/team-title-image/" + sliderId + "/edit";
            console.log("Fetching data from: " + editUrl);
            $.get(editUrl, function(data) {
                $('#sliderId').val(data.id);
                $('#editImagePreview').attr('src', '/storage/specialists/' + data.image).show();
                $('#editSliderModal').modal('show');
            }).fail(function() {
                alert('Could not retrieve image data');
            });
        });

        $('#editSliderForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            var sliderId = $('#sliderId').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('team-title-image.update', '') }}/" + sliderId,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#editSliderModal').modal('hide');
                    $('#editSliderForm')[0].reset();
                    $('#editImagePreview').hide();
                    table.ajax.reload();
                    alert(' Image updated successfully!');
                },
                error: function(response) {
                    alert('Failed to update image');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var sliderId = $(this).data('id');
            $('#confirmDelete').data('id', sliderId);
            $('#deleteSliderModal').modal('show');
        });

        $('#confirmDelete').click(function() {
            var sliderId = $(this).data('id');

            $.ajax({
                type: 'DELETE',
                url: "{{ route('team-title-image.destroy', '') }}/" + sliderId,
                data: {
                _token: '{{ csrf_token() }}'},
                success: function(response) {
                    $('#deleteSliderModal').modal('hide');
                    table.ajax.reload();
                    alert('Image deleted successfully!');
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

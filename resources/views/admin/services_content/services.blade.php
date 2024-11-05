<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Services Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        #imagePreview {
        display: flex;
        flex-wrap: wrap;
    }
    #imagePreview img {
        margin-top: 10px;
        width: 30%;
        margin-right: 5%;
    }
    #imagePreview img:nth-child(3n) {
        margin-right: 0;
    }

    </style>
</head>
<body>

@extends('dashboard.index')

@section('content')
<div class="container">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        Add New Service
    </button>
    <div class="table-responsive">
        <table class="table table-striped" id="services-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover Image</th>
                    <th>Service Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addServiceForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="cover_image">Select Cover Image</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*" required>
                        <img id="coverImagePreview" src="#" alt="Cover Image Preview" style="display:none; margin-top:10px; width:50px;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="service_title">Service Title</label>
                        <input type="text" id="service_title" name="service_title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="service_description">Service Description</label>
                        <div id="serviceDescriptionEditor"></div>
                        <input type="hidden" id="service_description" name="service_description">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <input type="text" id="category" name="category" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="content_images">Select Content Images</label>
                        <input type="file" id="content_images" name="content_images[]" class="form-control" accept="image/*" multiple>
                        <div id="contentImagesPreview" class="row"style="margin-top:10px;"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_service_id" name="service_id">
                    <div class="form-group mb-3">
                        <label for="edit_cover_image">Select Cover Image</label>
                        <input type="file" id="edit_cover_image" name="cover_image" class="form-control" accept="image/*">
                        <img id="editCoverImagePreview" src="#" alt="Cover Image Preview" style="display:none; margin-top:10px; max-width:100%;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_service_title">Service Title</label>
                        <input type="text" id="edit_service_title" name="service_title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_service_description">Service Description</label>
                        <div id="editServiceDescriptionEditor"></div>
                        <input type="hidden" id="edit_service_description" name="service_description">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_category">Category</label>
                        <input type="text" id="edit_category" name="category" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_content_images">Select Content Images</label>
                        <input type="file" id="edit_content_images" name="content_images[]" class="form-control" accept="image/*" multiple>
                        <div id="editContentImagesPreview" style="margin-top:10px; "></div>
                    </div>
                    <div id="existingContentImages" class="row" style="margin-top:10px;"></div> <!-- Existing content images preview -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteServiceModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this service?
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


        var serviceDescriptionEditor = new Quill('#serviceDescriptionEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline','link'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        var editServiceDescriptionEditor = new Quill('#editServiceDescriptionEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline','link'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        $('#cover_image').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#coverImagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('#content_images').change(function() {
            $('#contentImagesPreview').empty();
            for (var i = 0; i < this.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#contentImagesPreview').append('<img src="' + e.target.result + '" style="margin-top:10px; width:50px;">');
                }
                reader.readAsDataURL(this.files[i]);
            }
        });


        $('#addServiceForm').on('submit', function(e) {
            e.preventDefault();
            $('#service_description').val(serviceDescriptionEditor.root.innerHTML);

            $.ajax({
                type: "POST",
                url: "{{ route('service.store') }}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addServiceModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addServiceForm')[0].reset();
                    serviceDescriptionEditor.root.innerHTML = '';
                    $('#coverImagePreview').hide();
                    $('#contentImagesPreview').empty();
                    $('#services-table').DataTable().ajax.reload();
                    alert('Service added successfully.');
                },
                error: function(response) {
                    handleErrors(response);
                }
            });
        });


        var table = $('#services-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('service.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'cover_image', name: 'cover_image',render: function(data) {
                    return `<img src="/storage/services/${data}" style="width: 80px; height: 80px;"/>`;
                }},
                {data: 'service_title', name: 'service_title'},
                {data: 'service_description', name: 'service_description', render: function(data) {

var plainText = $('<div>').html(data).text();
var maxLength = 100;
return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
}},
                {data: 'category', name: 'category'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });


        $('#services-table').on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('service.index') }}" + '/' + id + '/edit', function(data) {
                fillEditForm(data);
                $('#editServiceModal').modal('show');
            });
        });

        $('#edit_cover_image').change(function() {
            $('#editCoverImagePreview').hide();
            previewImage(this, '#editCoverImagePreview');
        });


        $('#edit_content_images').change(function() {
            $('#existingContentImages').hide();
            $('#editContentImagesPreview').empty();
            previewMultipleImages(this, '#editContentImagesPreview');
        });


        $('#editServiceForm').on('submit', function(e) {
            e.preventDefault();
            $('#edit_service_description').val(editServiceDescriptionEditor.root.innerHTML);

            var id = $('#edit_service_id').val();
            $.ajax({
                type: "POST",
                url: "{{ route('service.update', ':id') }}".replace(':id', id),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editServiceModal').modal('hide');
                    resetEditForm();
                    $('#services-table').DataTable().ajax.reload();
                    alert('Service updated successfully.');
                },
                error: function(response) {
                    handleErrors(response);
                }
            });
        });


        var serviceIdToDelete;
        $('#services-table').on('click', '.delete', function() {
            serviceIdToDelete = $(this).data('id');
            $('#deleteServiceModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                type: "DELETE",
                url: "{{ route('service.destroy', '') }}/" + serviceIdToDelete,
                success: function(response) {
                    $('#services-table').DataTable().ajax.reload();
                    $('#deleteServiceModal').modal('hide');
                    alert('Service deleted successfully.');
                },
                error: function(response) {
                    alert('Error deleting service.');
                }
            });
        });


        $('#editServiceModal').on('hidden.bs.modal', function () {
            resetEditForm();
        });


        function previewImage(input, target) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(target).attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }

        function previewMultipleImages(input, target) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(target).append('<img src="' + e.target.result + '" style="margin-top:10px; width:50px;">');
                }
                reader.readAsDataURL(input.files[i]);
            }
        }

        // function truncateDescription(data) {
        //     var plainText = $('<div>').html(data).text();
        //     var maxLength = 200;
        //     return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
        // }

        function fillEditForm(data) {
            $('#edit_service_id').val(data.id);
            $('#edit_service_title').val(data.service_title);
            editServiceDescriptionEditor.root.innerHTML = data.service_description;
            $('#edit_category').val(data.category);
            $('#editCoverImagePreview').attr('src', '/storage/services/' + data.cover_image).show();


            $('#existingContentImages').empty();
    if (data.content_images) {
        var images = JSON.parse(data.content_images);
        images.forEach(function(image) {
            $('#existingContentImages').append(`
                <div class="col-4 mb-2">
                    <img src="/storage/services/content/${image}" class="img-fluid" style="margin-top:10px;">
                </div>
            `);
        });
    }
            $('#existingContentImages').show();
            $('#editContentImagesPreview').empty();
        }

        function resetEditForm() {
            $('#existingContentImages').show();
            $('#editContentImagesPreview').empty();
            $('#editCoverImagePreview').hide();
        }

        function handleErrors(response) {
            if (response.responseJSON && response.responseJSON.errors) {
                alert('Validation errors:\n' + JSON.stringify(response.responseJSON.errors));
            } else {
                alert('An error occurred.');
            }
        }
    });
</script>


@endsection

</body>
</html>

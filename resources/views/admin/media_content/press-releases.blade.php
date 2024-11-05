<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs Management</title>
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
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBlogModal">
        Add New Blog
    </button>
    <div class="table-responsive">
        <table class="table table-striped" id="blogs-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover Image</th>
                    <th>Blog Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add Blog Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBlogModalLabel">Add New Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBlogForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="cover_image">Select Cover Image</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*" required>
                        <img id="coverImagePreview" src="#" alt="Cover Image Preview" style="display:none; margin-top:10px; width:50px;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="blog_title">Blog Title</label>
                        <input type="text" id="blog_title" name="blog_title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="blog_description">Blog Description</label>
                        <div id="blogDescriptionEditor"></div>
                        <input type="hidden" id="blog_description" name="blog_description">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="" selected disabled>Select a category</option>
                            <option value="A">Category A</option>
                            <option value="B">Category B</option>
                            <option value="C">Category C</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="content_images">Select Content Images</label>
                        <input type="file" id="content_images" name="content_images[]" class="form-control" accept="image/*" multiple>
                        <div id="contentImagesPreview" class="row" style="margin-top:10px;"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Blog Modal -->
<div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBlogForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_blog_id" name="blog_id">
                    <div class="form-group mb-3">
                        <label for="edit_cover_image">Select Cover Image</label>
                        <input type="file" id="edit_cover_image" name="cover_image" class="form-control" accept="image/*">
                        <img id="editCoverImagePreview" src="#" alt="Cover Image Preview" style="display:none; margin-top:10px; max-width:100%;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_blog_title">Blog Title</label>
                        <input type="text" id="edit_blog_title" name="blog_title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_blog_description">Blog Description</label>
                        <div id="editBlogDescriptionEditor"></div>
                        <input type="hidden" id="edit_blog_description" name="blog_description">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_category">Category</label>
                        <select id="edit_category" name="category" class="form-select" required>
                            <option value="" selected disabled>Select a category</option>
                            <option value="A">Category A</option>
                            <option value="B">Category B</option>
                            <option value="C">Category C</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_content_images">Select Content Images</label>
                        <input type="file" id="edit_content_images" name="content_images[]" class="form-control" accept="image/*" multiple>
                        <div id="editContentImagesPreview" style="margin-top:10px;"></div>
                    </div>
                    <div id="existingContentImages" class="row" style="margin-top:10px;"></div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteBlogModal" tabindex="-1" aria-labelledby="deleteBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBlogModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this blog?
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

        var blogDescriptionEditor = new Quill('#blogDescriptionEditor', {
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

        var editBlogDescriptionEditor = new Quill('#editBlogDescriptionEditor', {
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

        $('#addBlogForm').on('submit', function(e) {
            e.preventDefault();
            $('#blog_description').val(blogDescriptionEditor.root.innerHTML);

            $.ajax({
                type: "POST",
                url: "{{ route('blog.store') }}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addBlogModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addBlogForm')[0].reset();
                    blogDescriptionEditor.root.innerHTML = '';
                    $('#coverImagePreview').hide();
                    $('#contentImagesPreview').empty();
                    $('#blogs-table').DataTable().ajax.reload();
                    alert('Blog added successfully.');
                },
                error: function(response) {
                    handleErrors(response);
                }
            });
        });

        var table = $('#blogs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('blog.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'cover_image', name: 'cover_image', render: function(data) {
                    return `<img src="/storage/blogs/${data}" style="width: 80px; height: 80px;"/>`;
                }},
                {data: 'blog_title', name: 'blog_title'},
                {data: 'blog_description', name: 'blog_description', render: function(data) {
                    var plainText = $('<div>').html(data).text();
                    var maxLength = 100;
                    return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
                }},
                {data: 'category', name: 'category'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#blogs-table').on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('blog.index') }}" + '/' + id + '/edit', function(data) {
                fillEditForm(data);
                $('#editBlogModal').modal('show');
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

        $('#editBlogForm').on('submit', function(e) {
            e.preventDefault();
            $('#edit_blog_description').val(editBlogDescriptionEditor.root.innerHTML);

            var id = $('#edit_blog_id').val();
            $.ajax({
                type: "POST",
                url: "{{ route('blog.update', ':id') }}".replace(':id', id),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editBlogModal').modal('hide');
                    resetEditForm();
                    $('#blogs-table').DataTable().ajax.reload();
                    alert('Blog updated successfully.');
                },
                error: function(response) {
                    handleErrors(response);
                }
            });
        });

        var blogIdToDelete;
        $('#blogs-table').on('click', '.delete', function() {
            blogIdToDelete = $(this).data('id');
            $('#deleteBlogModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                type: "DELETE",
                url: "{{ route('blog.destroy', '') }}/" + blogIdToDelete,
                success: function(response) {
                    $('#blogs-table').DataTable().ajax.reload();
                    $('#deleteBlogModal').modal('hide');
                    alert('Blog deleted successfully.');
                },
                error: function(response) {
                    alert('Error deleting blog.');
                }
            });
        });

        $('#editBlogModal').on('hidden.bs.modal', function () {
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

        function fillEditForm(data) {
            $('#edit_blog_id').val(data.id);
            $('#edit_blog_title').val(data.blog_title);
            editBlogDescriptionEditor.root.innerHTML = data.blog_description;
            $('#edit_category').val(data.category);
            $('#editCoverImagePreview').attr('src', '/storage/blogs/' + data.cover_image).show();

            $('#existingContentImages').empty();
            if (data.content_images) {
                var images = JSON.parse(data.content_images);
                images.forEach(function(image) {
                    $('#existingContentImages').append(`
                        <div class="col-4 mb-2">
                            <img src="/storage/blogs/content/${image}" class="img-fluid" style="margin-top:10px;">
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

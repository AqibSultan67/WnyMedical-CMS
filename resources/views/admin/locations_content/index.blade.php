<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Location Page Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <style>
        .working-hour-row {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .working-hour-select {
            margin-right: 10px;
        }


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


        .quill {
            height: 150px;
        }
    </style>
</head>
<body>
@extends('dashboard.index')

@section('content')
<div class="container">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addLocationModal">Add Location</button>
    <div class="table-wrapper mt-3">
        <div class="table-responsive">
            <table class="table table-bordered" id="locationsTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Location</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Services</th>
                        <th></th>
                        <th>Times</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add Location Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLocationLabel">Add Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLocationForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="link" placeholder="https://example.com">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Services</label>
                        <div id="editor" class="quill"></div>
                        <input type="hidden" id="description" name="description">
                    </div>
                    <div id="workingHours">
                        <div class="working-hour-row d-flex align-items-center mb-2">
                            <select name="days[]" class="form-control working-hour-select" required>
                                <option value="">Select Day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                            <input type="text" name="times[]" class="form-control" placeholder="e.g. 7:30-3" required>
                            <button type="button" class="btn btn-danger remove-hour ms-2">-</button>
                            <button type="button" class="btn btn-success add-hour ms-2">+</button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Save Location</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Location Modal -->
<div class="modal fade" id="editLocationModal" tabindex="-1" aria-labelledby="editLocationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLocationLabel">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-lg">
                <form id="editLocationForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-location-id" name="id">
                    <div class="form-group mb-3">
                        <label for="edit-location">Location</label>
                        <input type="text" class="form-control" id="edit-location" name="location" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-phone">Phone</label>
                        <input type="text" class="form-control" id="edit-phone" name="phone" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-address">Address</label>
                        <input type="text" class="form-control" id="edit-address" name="address" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-link">Link</label>
                        <input type="text" class="form-control" id="edit-link" name="link" placeholder="https://example.com">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-description">Services</label>
                        <div id="edit-editor" class="quill"></div>
                        <input type="hidden" id="edit-description" name="description">
                    </div>
                    <div id="edit-workingHours"></div>
                    <button type="submit" class="btn btn-primary">Update Location</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Location Modal -->
<div class="modal fade" id="deleteLocationModal" tabindex="-1" aria-labelledby="deleteLocationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLocationLabel">Delete Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this location?</p>
                <input type="hidden" id="delete-location-id">
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

    const table = $('#locationsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('location.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'location', name: 'location' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            {data: 'description', name: 'description', render: function(data) {

var plainText = $('<div>').html(data).text();
var maxLength = 50;
return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
}},
            { data: 'days', name: 'days', title: ' Working Days' },
            { data: 'times', name: 'times', title: 'Times' },
            {data: 'link', name: 'link', render: function(data) {

var plainText = $('<div>').html(data).text();
var maxLength = 50;
return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
}},
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });


    const quill = new Quill('#editor', {
        theme: 'snow'
    });
    const editQuill = new Quill('#edit-editor', {
        theme: 'snow'
    });

    // Add Location
    $('#addLocationForm').on('submit', function(e) {
        e.preventDefault();
        $('#description').val(quill.root.innerHTML);
        $.ajax({
            url: "{{ route('location.store') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#addLocationModal').modal('hide');
                $('.modal-backdrop').remove();
                $('body').css('overflow', 'auto');
                $('#addLocationForm')[0].reset();
                quill.setContents([]);

                table.ajax.reload(function() {
                    $('body').css('overflow', 'auto');
                });
                alert(response.success);
            },
            error: function(xhr) {
                alert('Failed to add location.');
            }
        });
    });

    // Edit Location
    $('#locationsTable').on('click', '.edit', function() {
        const id = $(this).data('id');
        $.ajax({
            url: `/admin/dashboard/location/${id}/edit`,
            method: 'GET',
            success: function(data) {
                $('#edit-location-id').val(data.id);
                $('#edit-location').val(data.location);
                $('#edit-phone').val(data.phone);
                $('#edit-address').val(data.address);
                $('#edit-link').val(data.link);
                editQuill.root.innerHTML = data.description;

                $('#edit-workingHours').empty();
                data.days.forEach((day, index) => {
                    $('#edit-workingHours').append(`
                        <div class="working-hour-row d-flex align-items-center mb-2">
                            <select name="days[]" class="form-control working-hour-select" required>
                                <option value="${day}" selected>${day}</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                            <input type="text" name="times[]" class="form-control" placeholder="e.g. 7:30-3" value="${data.times[index]}" required>
                            <button type="button" class="btn btn-danger remove-hour ms-2">-</button>
                        </div>
                    `);
                });
                $('#editLocationModal').modal('show');
            },
            error: function(xhr) {
                alert('Failed to fetch location data.');
            }
        });
    });


    $('#editLocationForm').on('submit', function(e) {
        e.preventDefault();
        $('#edit-description').val(editQuill.root.innerHTML);
        const id = $('#edit-location-id').val();
        $.ajax({
            url: `/admin/dashboard/location/${id}`,
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                $('#editLocationModal').modal('hide');
                table.ajax.reload();
                alert(response.success);
            },
            error: function(xhr) {
                alert('Failed to update location.');
            }
        });
    });

    // Delete Location
    $('#locationsTable').on('click', '.delete', function() {
        const id = $(this).data('id');
        $('#delete-location-id').val(id);
        $('#deleteLocationModal').modal('show');
    });

    $('#confirmDelete').on('click', function() {
        const id = $('#delete-location-id').val();
        $.ajax({
            url: `/admin/dashboard/location/${id}`,
            data: {
                _token: '{{ csrf_token() }}'
            },
            method: 'DELETE',
            success: function(response) {
                $('#deleteLocationModal').modal('hide');
                $('.modal-backdrop').remove();
                table.ajax.reload();
                alert(response.success);
            },
            error: function(xhr) {
                alert('Failed to delete location.');
            }
        });
    });

    $('.add-hour').click(function() {
        const newRow = `
            <div class="working-hour-row d-flex align-items-center mb-2">
                <select name="days[]" class="form-control working-hour-select" required>
                    <option value="">Select Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                </select>
                <input type="text" name="times[]" class="form-control" placeholder="e.g. 7:30-3" required>
                <button type="button" class="btn btn-danger remove-hour ms-2">-</button>
            </div>
        `;
        $('#workingHours').append(newRow);
    });

    $('#workingHours').on('click', '.remove-hour', function() {
        $(this).closest('.working-hour-row').remove();
    });
});
</script>
@endsection
</body>
</html>

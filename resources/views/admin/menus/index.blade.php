<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .expand-icon {
            margin-right: 5px;
        }
        .child-row {
            display: none; /* Hide child rows by default */
        }
        .child-row td {
            background-color: #f1f1f1; /* Light background for child rows */
        }
        .button-link {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            text-align: left;
            padding: 0;
            font-size: 16px;
        }
        .button-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @extends('dashboard.index')

    @section('content')
    <div class="container">
        <button id="addMenuButton" class="btn btn-primary mb-3">Add New Menu</button>

        <!-- The Modal for adding menu -->
        <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMenuModalLabel">Add New Menu Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addMenuForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Menu Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Select Parent Menu</label>
                                <select class="form-select" id="parent_id" name="parent_id">
                                    <option value="">None</option>
                                    @foreach ($menus as $menu)
                                        @if (is_null($menu->parent_id))
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Menu Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <table id="menusTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>


        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this menu item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                    </div>
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

            var table = $('#menusTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('menu.index') }}',
                columns: [
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return `<button class="button-link expand-btn" data-id="${row.id}">
                                        <span class="expand-icon">▶</span>${data}
                                    </button>`;
                        }
                    },
                    { data: 'slug' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('#addMenuButton').click(function() {
                $('#addMenuModal').modal('show');
            });

            $('#addMenuForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('menu.store') }}',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addMenuModal').modal('hide');
                        $('#addMenuForm')[0].reset();
                        if (response.id) {

                var newOption = `<option value="${response.id}">${response.name}</option>`
                $('#parent_id').append(newOption); 
            } else {
                console.error("Response does not contain the ID.");
            }
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('#menusTable').on('click', '.expand-btn', function() {
                var parentRow = $(this).closest('tr');
                var parentId = $(this).data('id');
                var childRows = $('#menusTable').find('.child-row[data-parent-id="' + parentId + '"]');

                if (!childRows.length) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/dashboard/menu/' + parentId + '/subcategories',
                        success: function(subcategories) {
                            if (subcategories.length > 0) {
                                subcategories.forEach(function(sub) {
                                    var childHtml = `<tr class="child-row" data-parent-id="${parentId}">
                                        <td>-- ${sub.name}</td>
                                        <td>${sub.slug}</td>
                                        <td>
                                            <button class="edit btn btn-warning btn-sm" data-id="${sub.id}">Edit</button>
                                            <button class="delete btn btn-danger btn-sm" data-id="${sub.id}">Delete</button>
                                        </td>
                                    </tr>`;
                                    parentRow.after(childHtml);
                                });

                                parentRow.nextUntil('tr:not(.child-row[data-parent-id="' + parentId + '"]').toggle();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching subcategories:', status, error);
                        }
                    });
                } else {

                    childRows.toggle();
                }


                var icon = $(this).find('.expand-icon');
                icon.text(icon.text() === '▶' ? '▼' : '▶');
            });

            $(document).on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/admin/dashboard/menu/' + id + '/edit',
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#parent_id').val(response.parent_id);
                        $('#addMenuModal').modal('show');

                        $('#addMenuForm').off('submit').on('submit', function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: 'PUT',
                                url: '/admin/dashboard/menu/' + id,
                                data: $(this).serialize(),
                                success: function() {
                                    $('#addMenuModal').modal('hide');
                                    $('#addMenuForm')[0].reset();
                                    table.ajax.reload();
                                }
                            });
                        });
                    }
                });
            });

            var deleteId;

            $(document).on('click', '.delete', function() {
                deleteId = $(this).data('id');
                $('#deleteConfirmationModal').modal('show');
            });

            $('#confirmDeleteButton').click(function() {
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/dashboard/menu/' + deleteId,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#deleteConfirmationModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    @endsection
</body>
</html>

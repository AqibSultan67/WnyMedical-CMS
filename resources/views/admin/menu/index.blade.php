<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Page Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .child-row {
            display: none; /* Initially hide child rows */
            background-color: #f9f9f9; /* Light background for child rows */
        }
        .expand-btn {
            cursor: pointer;
            color: #4B49AC;
            background: none;
            border: none;
            padding: 0;
            font-size: 16px;
        }
        .expand-btn:hover {
            text-decoration: underline;
        }
        .expand-icon {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    @extends('dashboard.index')

    @section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" id="add-menu-btn" data-bs-toggle="modal" data-bs-target="#menuModal">
            Add Menu Item
        </button>

        <div class="table-wrapper mt-3">
            <div class="table-responsive">
                <table class="table table-striped" id="menu-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Route</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menuItems as $item)
                            <tr class="parent-row" data-id="{{ $item->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <button class="expand-btn">
                                        <span class="expand-icon" aria-hidden="true">▶</span>
                                        {{ $item->title }}
                                    </button>
                                </td>
                                <td>{{ $item->route ?? 'N/A' }}</td>
                                <td>
                                    <button class="edit btn btn-primary btn-sm" data-id="{{ $item->id }}">Edit</button>
                                    <button class="delete btn btn-danger btn-sm" data-id="{{ $item->id }}">Delete</button>
                                </td>
                            </tr>
                            @if ($item->children->isNotEmpty())
                                @foreach ($item->children as $child)
                                    <tr class="child-row" data-parent-id="{{ $item->id }}">
                                        <td>{{ $loop->parent->index + 1 }}.{{ $loop->index + 1 }}</td>
                                        <td>&nbsp;&nbsp;&nbsp; - {{ $child->title }}</td>
                                        <td>{{ $child->route ?? 'N/A' }}</td>
                                        <td>
                                            <button class="edit btn btn-primary btn-sm" data-id="{{ $child->id }}">Edit</button>
                                            <button class="delete btn btn-danger btn-sm" data-id="{{ $child->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Menu Item Modal -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuModalLabel">Add Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="menu-form">
                        @csrf
                        <input type="hidden" name="id" id="menu-id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="route" class="form-label">Route (optional):</label>
                            <input type="text" name="route" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent Item:</label>
                            <select name="parent_id" class="form-select" id="parent-id">
                                <option value="">None</option>
                                @foreach ($menuItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="save-btn">Add Menu Item</button>
                    </form>
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

        $('#menu-table').on('click', '.expand-btn', function() {
            var parentRow = $(this).closest('tr');
            var parentId = parentRow.data('id');
            var childRows = $('#menu-table').find('.child-row[data-parent-id="' + parentId + '"]');

            childRows.toggle();

            var icon = $(this).find('.expand-icon');
            icon.text(icon.text() === '▶' ? '▼' : '▶');
        });

        $('#add-menu-btn').on('click', function() {
            $('#menu-form')[0].reset();
            $('#menu-id').val('');
            $('#parent-id').val('');
            $('#menuModalLabel').text('Add Menu Item');
            $('#save-btn').text('Add Menu Item');
            $('#menuModal').modal('show');
        });


        $('#menu-form').on('submit', function(e) {
            e.preventDefault();
            var id = $('#menu-id').val();
            var url = id ? '{{ url("admin/menu") }}/' + id : '{{ route("menu.store") }}';
            var type = id ? 'PUT' : 'POST';

            $.ajax({
                type: type,
                url: url,
                data: $(this).serialize(),
                success: function(response) {
                    $('#menuModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                }
            });
        });


        $('#menu-table').on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get('{{ route("menu.edit", ":id") }}'.replace(':id', id), function(data) {
                $('input[name="title"]').val(data.title);
                $('input[name="route"]').val(data.route);
                $('#menu-id').val(data.id);
                $('#parent-id').val(data.parent_id);
                $('#menuModalLabel').text('Edit Menu Item');
                $('#save-btn').text('Update Menu Item');
                $('#menuModal').modal('show');
            }).fail(function() {
                alert('Error loading data. Please try again.');
            });
        });


        $('#menu-table').on('click', '.delete', function() {
            var id = $(this).data('id');
            if(confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route("menu.destroy", ":id") }}'.replace(':id', id),
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload(); 
                        alert(response.message);
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
    </script>

    @endsection
</body>
</html>

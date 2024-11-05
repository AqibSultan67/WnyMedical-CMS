<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>New Pateint Document</title>
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
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContentModalLabel">Add New File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addContentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="file">Upload File</label>
                            <input type="file" id="file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        var table = $('#content-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('patient-files.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {  data:'file_path',
                data:'file_path',
                    data: 'file_name',
                    name: 'file_name',

                    render: function(data, type, row) {
                        return type === 'display' ? $('<div/>').html(data).text() : data;
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#addContentForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('patient-files.store') }}",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#addContentModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addContentForm')[0].reset();
                    table.ajax.reload();
                    alert('Content added successfully');
                },
                error: function(response) {
                    alert('Error adding content');
                }
            });
        });

        $(document).on('click', '.deleteContent', function() {
            var id = $(this).data('id');
            $('#deleteId').val(id);
            $('#deleteContentModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            var id = $('#deleteId').val();
            $.ajax({
                type: "DELETE",
                url: "{{ route('patient-files.destroy', '') }}/" + id,
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

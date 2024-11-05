<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Career Jobs Portal</title>
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
            Add New Job
        </button>
        <div class="table-wrapper mt-3">
            <div class="table-responsive">
                <table class="table table-striped" id="content-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Job Title</th>
                            <th>Job Type</th>
                            <th>Expired Date</th>
                            <th>Status</th>
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
                    <h5 class="modal-title" id="addContentModalLabel">Add New Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addContentForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="jobTitle">Job Title</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jobType">Job Type</label>
                            <input type="text" class="form-control" id="jobType" name="jobType" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="expiredDate">Expired Date</label>
                            <input type="datetime-local" class="form-control" id="expiredDate" name="expiredDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContentModalLabel">Edit Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editContentForm">
                        @csrf
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group mb-3">
                            <label for="editJobTitle">Job Title</label>
                            <input type="text" class="form-control" id="editJobTitle" name="jobTitle" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editJobType">Job Type</label>
                            <input type="text" class="form-control" id="editJobType" name="jobType" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="editExpiredDate">Expired Date</label>
                            <input type="datetime-local" class="form-control" id="editExpiredDate" name="expiredDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteContentModal" tabindex="-1" aria-labelledby="deleteContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteContentModalLabel">Delete Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this job?</p>
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
            ajax: "{{ route('career-jobs.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'job_title', name: 'job_title'},
                {data: 'job_type', name: 'job_type'},
                {
                    data: 'expired_date',
                    name: 'expired_date',
                    render: function(data) {
                        const date = new Date(data);
                        return date.toLocaleString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        }).replace(',', ' at');
                    }
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#addContentForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('career-jobs.store') }}",
                data: $(this).serialize(),
                success: function(response) {
                    $('#addContentModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addContentForm')[0].reset();
                    table.ajax.reload();
                    alert('Job added successfully');
                },
                error: function(response) {
                    alert('Error adding job');
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('career-jobs.index') }}" + '/' + id + '/edit', function(data) {
                $('#editId').val(data.id);
                $('#editJobTitle').val(data.job_title);
                $('#editJobType').val(data.job_type);
                $('#editExpiredDate').val(data.expired_date);
                $('#editContentModal').modal('show');
            });
        });

        $('#editContentForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#editId').val();
            $.ajax({
                type: "PUT",
                url: "{{ route('career-jobs.update', '') }}/" + id,
                data: $(this).serialize(),
                success: function(response) {
                    $('#editContentModal').modal('hide');
                    table.ajax.reload();
                    alert('Job updated successfully');
                },
                error: function(response) {
                    alert('Error updating job');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            $('#deleteId').val(id);
            $('#deleteContentModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            var id = $('#deleteId').val();
            $.ajax({
                type: "DELETE",
                url: "{{ route('career-jobs.destroy', '') }}/" + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteContentModal').modal('hide');
                    table.ajax.reload();
                    alert('Job deleted successfully');
                },
                error: function(response) {
                    alert('Error deleting job');
                }
            });
        });
    });
    </script>
    @endsection
</body>
</html>

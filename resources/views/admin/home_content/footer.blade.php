<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Footer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
        .quill-editor {
            height: 100px;
        }
    </style>
</head>
<body>
    @extends('dashboard.index')

    @section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFooterModal">
            Add New Footer
        </button>
        <div class="table-wrapper mt-3">
            <div class="table-responsive">
                <table class="table table-striped" id="footer-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Copyright</th>
                            <th>Powered By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Footer Modal -->
    <div class="modal fade" id="addFooterModal" tabindex="-1" aria-labelledby="addFooterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFooterModalLabel">Add New Footer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addFooterForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="copyright">Copyright</label>
                            <div id="addCopyrightEditor" class="quill-editor"></div>
                            <input type="hidden" id="addCopyright" name="copyright">
                        </div>
                        <div class="form-group mb-3">
                            <label for="powered_by">Powered By</label>
                            <div id="addPoweredByEditor" class="quill-editor"></div>
                            <input type="hidden" id="addPoweredBy" name="powered_by">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Footer Modal -->
    <div class="modal fade" id="editFooterModal" tabindex="-1" aria-labelledby="editFooterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFooterModalLabel">Edit Footer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFooterForm">
                        @csrf
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group mb-3">
                            <label for="editCopyright">Copyright</label>
                            <div id="editCopyrightEditor" class="quill-editor"></div>
                            <input type="hidden" id="editCopyright" name="copyright">
                        </div>
                        <div class="form-group mb-3">
                            <label for="editPoweredBy">Powered By</label>
                            <div id="editPoweredByEditor" class="quill-editor"></div>
                            <input type="hidden" id="editPoweredBy" name="powered_by">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Footer Modal -->
    <div class="modal fade" id="deleteFooterModal" tabindex="-1" aria-labelledby="deleteFooterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFooterModalLabel">Delete Footer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this footer?</p>
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
        var addCopyrightQuill = new Quill('#addCopyrightEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        var addPoweredByQuill = new Quill('#addPoweredByEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        var editCopyrightQuill = new Quill('#editCopyrightEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        var editPoweredByQuill = new Quill('#editPoweredByEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{'color': []}, {'background': []}],
                    ['clean']
                ]
            }
        });

        var table = $('#footer-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('footer.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'copyright',
                    name: 'copyright',
                    render: function(data) {
                        return $('<div/>').html(data).text();
                    }
                },
                {
                    data: 'powered_by',
                    name: 'powered_by',
                    render: function(data) {
                        return $('<div/>').html(data).text();
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#addFooterForm').on('submit', function(e) {
            e.preventDefault();
            $('#addCopyright').val(addCopyrightQuill.root.innerHTML);
            $('#addPoweredBy').val(addPoweredByQuill.root.innerHTML);
            $.ajax({
                type: "POST",
                url: "{{ route('footer.store') }}",
                data: $(this).serialize(),
                success: function(response) {
                    $('#addFooterModal').modal('hide');
                    $('.modal-backdrop').remove();
                    table.ajax.reload();
                    alert('Footer added successfully');
                },
                error: function(response) {
                    alert('Error adding footer');
                }
            });
        });

        $(document).on('click', '.editFooter', function() {
            var id = $(this).data('id');
            $.get("{{ route('footer.index') }}" + '/' + id + '/edit', function(data) {
                $('#editId').val(data.id);
                editCopyrightQuill.root.innerHTML = data.copyright;
                editPoweredByQuill.root.innerHTML = data.powered_by;
                $('#editFooterModal').modal('show');
            });
        });

        $('#editFooterForm').on('submit', function(e) {
            e.preventDefault();
            $('#editCopyright').val(editCopyrightQuill.root.innerHTML);
            $('#editPoweredBy').val(editPoweredByQuill.root.innerHTML);
            var id = $('#editId').val();
            $.ajax({
                type: "PUT",
                url: "{{ route('footer.update', '') }}/" + id,
                data: $(this).serialize(),
                success: function(response) {
                    $('#editFooterModal').modal('hide');
                    table.ajax.reload();
                    alert('Footer updated successfully');
                },
                error: function(response) {
                    alert('Error updating footer');
                }
            });
        });

        $(document).on('click', '.deleteFooter', function() {
            var id = $(this).data('id');
            $('#deleteId').val(id);
            $('#deleteFooterModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            var id = $('#deleteId').val();
            $.ajax({
                type: "DELETE",
                url: "{{ route('footer.destroy', '') }}/" + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteFooterModal').modal('hide');
                    table.ajax.reload();
                    alert('Footer deleted successfully');
                },
                error: function(response) {
                    alert('Error deleting footer');
                }
            });
        });
    });
    </script>
    @endsection
</body>
</html>

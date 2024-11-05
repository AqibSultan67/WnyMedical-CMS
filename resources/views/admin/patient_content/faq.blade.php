<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>FAQ Page Content</title>
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
    </style>
</head>
<body>
    @extends('dashboard.index')

    @section('content')
    <div class="container">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addContentModal">
            Add New FAQ
        </button>
        <div class="table-wrapper mt-3">
            <div class="table-responsive">
                <table class="table table-striped" id="faq-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Question</th>
                            <th>Answer</th>
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
                    <h5 class="modal-title" id="addContentModalLabel">Add New FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addContentForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="question">Question</label>
                            <div id="addTitleEditor"></div>
                            <input type="hidden" id="addQuestion" name="question">
                        </div>
                        <div class="form-group mb-3">
                            <label for="answer">Answer</label>
                            <div id="quillEditor"></div>
                            <input type="hidden" id="answer" name="answer">
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
                    <h5 class="modal-title" id="editContentModalLabel">Edit FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editContentForm">
                        @csrf
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group mb-3">
                            <label for="editQuestion">Question</label>
                            <div id="editTitleEditor"></div>
                            <input type="hidden" id="editQuestion" name="question">
                        </div>
                        <div class="form-group mb-3">
                            <label for="editAnswer">Answer</label>
                            <div id="editQuillEditor"></div>
                            <input type="hidden" id="editAnswer" name="answer">
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
                    <h5 class="modal-title" id="deleteContentModalLabel">Delete FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this FAQ?</p>
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
        var quill = new Quill('#quillEditor', { theme: 'snow' });
        var editQuill = new Quill('#editQuillEditor', { theme: 'snow' });
        var addTitleQuill = new Quill('#addTitleEditor', { theme: 'snow' });
        var editTitleQuill = new Quill('#editTitleEditor', { theme: 'snow' });

        var table = $('#faq-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('faq.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'question',
                    name: 'question',
                    render: function(data, type, row) {
                        return type === 'display' ? $('<div/>').html(data).text() : data;
                    }
                },
                {data: 'answer', name: 'answer', render: function(data, type, row) {
            if (type === 'display') {
                var plainText = $('<div>').html(data).text();
                var maxLength = 260;
                return plainText.length > maxLength ? plainText.substring(0, maxLength) + '...' : plainText;
            }
            return data;
        }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#addContentForm').on('submit', function(e) {
            e.preventDefault();
            $('#addQuestion').val(addTitleQuill.root.innerHTML);
            $('#answer').val(quill.root.innerHTML);
            $.ajax({
                type: "POST",
                url: "{{ route('faq.store') }}",
                data: $('#addContentForm').serialize(),
                success: function(response) {
                    $('#addContentModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#addContentForm')[0].reset();
                    addTitleQuill.root.innerHTML = '';
                    quill.root.innerHTML = '';
                    table.ajax.reload();
                    alert('FAQ added successfully');
                },
                error: function(response) {
                    alert('Error adding FAQ');
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('faq.index') }}" + '/' + id + '/edit', function(data) {
                $('#editId').val(data.id);
                $('#editQuestion').val(data.question);
                editTitleQuill.root.innerHTML = data.question;
                editQuill.root.innerHTML = data.answer;
                $('#editContentModal').modal('show');
            });
        });

        $('#editContentForm').on('submit', function(e) {
            e.preventDefault();
            $('#editQuestion').val(editTitleQuill.root.innerHTML);
            $('#editAnswer').val(editQuill.root.innerHTML);
            var id = $('#editId').val();
            $.ajax({
                type: "PUT",
                url: "{{ route('faq.update', '') }}/" + id,
                data: $('#editContentForm').serialize(),
                success: function(response) {
                    $('#editContentModal').modal('hide');
                    table.ajax.reload();
                    alert('FAQ updated successfully');
                },
                error: function(response) {
                    alert('Error updating FAQ');
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
                url: "{{ route('faq.destroy', '') }}/" + id,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteContentModal').modal('hide');
                    table.ajax.reload();
                    alert('FAQ deleted successfully');
                },
                error: function(response) {
                    alert('Error deleting FAQ');
                }
            });
        });
    });
    </script>
    @endsection
</body>
</html>

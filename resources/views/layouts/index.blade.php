<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Layout Builder</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <style>
        .draggable {
            padding: 10px;
            margin: 5px;
            background: #007bff;
            color: white;
            text-align: center;
            cursor: move;
            border-radius: 5px;
        }
        .content-box {
            border: 1px solid #007bff;
            padding: 10px;
            background-color: #f8f9fa;
            position: absolute; /* Enable absolute positioning */
            cursor: pointer;
            transition: all 0.3s ease;
        }
        #drop-area {
            position: relative; /* Relative positioning for absolute children */
            border: 2px dashed #007bff;
            min-height: 500px;
            padding: 20px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">Advanced Layout Builder</h2>
        <div class="row">
            <div class="col-md-4">
                <h4>Draggable Elements</h4>
                <div class="draggable" data-type="text">Text Block</div>
                <div class="draggable" data-type="image">Image Block</div>
                <div class="draggable" data-type="video">Video Block</div>
                <div class="draggable" data-type="button">Button</div>
            </div>
            <div class="col-md-8">
                <h4>Drop Area</h4>
                <div id="drop-area">
                    <p class="text-center">Drop your elements here</p>
                </div>
                <button id="save-layout" class="btn btn-success mt-3">Save Layout</button>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Content -->
    <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContentModalLabel">Add Content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addContentFields">
                        <div class="form-group">
                            <label for="contentType">Select Content Type:</label>
                            <select class="form-control" id="contentType">
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="form-group" id="textInput">
                            <label for="textContent">Text:</label>
                            <input type="text" class="form-control" id="textContent" placeholder="Enter text">
                        </div>
                        <div class="form-group d-none" id="imageInput">
                            <label for="imageURL">Image URL:</label>
                            <input type="text" class="form-control" id="imageURL" placeholder="Enter image URL">
                        </div>
                        <div class="form-group d-none" id="videoInput">
                            <label for="videoURL">Video URL:</label>
                            <input type="text" class="form-control" id="videoURL" placeholder="Enter video URL">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addContent">Add Content</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Properties -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Element</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="margin">Margin:</label>
                        <input type="text" class="form-control" id="margin" placeholder="e.g., 10px">
                    </div>
                    <div class="form-group">
                        <label for="padding">Padding:</label>
                        <input type="text" class="form-control" id="padding" placeholder="e.g., 10px">
                    </div>
                    <div class="form-group">
                        <label for="top">Top:</label>
                        <input type="text" class="form-control" id="top" placeholder="e.g., 10px">
                    </div>
                    <div class="form-group">
                        <label for="left">Left:</label>
                        <input type="text" class="form-control" id="left" placeholder="e.g., 10px">
                    </div>
                    <div class="form-group">
                        <label for="display">Display:</label>
                        <select class="form-control" id="display">
                            <option value="block">Block</option>
                            <option value="inline">Inline</option>
                            <option value="flex">Flex</option>
                            <option value="grid">Grid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="flexDirection">Flex Direction:</label>
                        <select class="form-control" id="flexDirection">
                            <option value="row">Row</option>
                            <option value="column">Column</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentElement = null;

        $(function() {
            $(".draggable").draggable({
                helper: "clone"
            });

            $("#drop-area").droppable({
                accept: ".draggable",
                drop: function(event, ui) {
                    const contentType = $(ui.helper).data('type');
                    $('#contentType').val(contentType);
                    $('#addContentModal').modal('show');
                }
            });

            $('#contentType').change(function() {
                const type = $(this).val();
                $('#textInput, #imageInput, #videoInput').addClass('d-none');
                if (type === 'text') {
                    $('#textInput').removeClass('d-none');
                } else if (type === 'image') {
                    $('#imageInput').removeClass('d-none');
                } else if (type === 'video') {
                    $('#videoInput').removeClass('d-none');
                }
            });

            $('#addContent').click(function() {
                const type = $('#contentType').val();
                let content = '';

                if (type === 'text') {
                    content = $('#textContent').val();
                } else if (type === 'image') {
                    const imgUrl = $('#imageURL').val();
                    content = `<img src="${imgUrl}" style="max-width: 100%; height: auto;">`;
                } else if (type === 'video') {
                    const videoUrl = $('#videoURL').val();
                    content = `<iframe width="100%" height="200" src="${videoUrl}" frameborder="0" allowfullscreen></iframe>`;
                }

                const addedElement = $('<div class="content-box" contenteditable="true" style="width: 200px; height: auto;">' + content + '</div>');
                $('#drop-area').append(addedElement);
                $('#addContentModal').modal('hide');

                // Make the added element draggable and editable
                addedElement.draggable({
                    containment: "#drop-area",
                    stop: function(event, ui) {
                        // Update position properties
                        const top = ui.position.top - $(this).position().top;
                        const left = ui.position.left - $(this).position().left;
                        $(this).css({ top: top + 'px', left: left + 'px' });
                    }
                });

                // Bind double-click event to edit
                addedElement.dblclick(function() {
                    currentElement = $(this);
                    $('#margin').val(currentElement.css('margin'));
                    $('#padding').val(currentElement.css('padding'));
                    $('#top').val(currentElement.css('top'));
                    $('#left').val(currentElement.css('left'));
                    $('#display').val(currentElement.css('display'));
                    $('#flexDirection').val(currentElement.css('flex-direction'));
                    $('#editModal').modal('show');
                });
            });

            $('#saveChanges').click(function() {
                if (currentElement) {
                    currentElement.css({
                        'margin': $('#margin').val(),
                        'padding': $('#padding').val(),
                        'top': $('#top').val(),
                        'left': $('#left').val(),
                        'display': $('#display').val(),
                        'flex-direction': $('#flexDirection').val(),
                    });
                    $('#editModal').modal('hide');
                }
            });

            $('#save-layout').click(function() {
                const layoutData = [];
                $('#drop-area > .content-box').each(function() {
                    layoutData.push({
                        content: $(this).html(),
                        width: $(this).css('width'),
                        height: $(this).css('height'),
                        margin: $(this).css('margin'),
                        padding: $(this).css('padding'),
                        top: $(this).css('top'),
                        left: $(this).css('left'),
                        display: $(this).css('display'),
                    });
                });

                $.ajax({
                    url: '/save-layout',
                    method: 'POST',
                    data: {
                        layout: layoutData,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Layout saved with ID: ' + response.id);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error saving layout:', xhr);
                    }
                });
            });
        });
    </script>
</body>
</html>

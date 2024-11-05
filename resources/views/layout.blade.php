<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GrapesJS Layout Builder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        #gjs {
            height: 600px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center my-4">GrapesJS Layout Builder</h1>
        <div id="gjs">
            <h1>Hello World Component!</h1>
        </div>
        <button id="save-layout" class="btn btn-success mt-3">Save Layout</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
    <script src="https://unpkg.com/grapesjs-plugin-forms"></script>
    <script src="https://unpkg.com/grapesjs-component-countdown"></script>
    <script src="https://unpkg.com/grapesjs-plugin-export"></script>
    <script src="https://unpkg.com/grapesjs-tabs"></script>
    <script src="https://unpkg.com/grapesjs-custom-code"></script>
    <script src="https://unpkg.com/grapesjs-touch"></script>
    <script src="https://unpkg.com/grapesjs-parser-postcss"></script>
    <script src="https://unpkg.com/grapesjs-tooltip"></script>
    <script src="https://unpkg.com/grapesjs-tui-image-editor"></script>
    <script src="https://unpkg.com/grapesjs-typed"></script>
    <script src="https://unpkg.com/grapesjs-style-bg"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-navbar"></script>

    <script>
        const editor = grapesjs.init({
            height: '600px',
            container: '#gjs',
            fromElement: true,
            storageManager: {
                type: 'local', 
                autoload: true,
            },
            plugins: [
                'gjs-blocks-basic',
                'grapesjs-plugin-forms',
                'grapesjs-component-countdown',
                'grapesjs-plugin-export',
                'grapesjs-tabs',
                'grapesjs-custom-code',
                'grapesjs-touch',
                'grapesjs-parser-postcss',
                'grapesjs-tooltip',
                'grapesjs-tui-image-editor',
                'grapesjs-typed',
                'grapesjs-style-bg',
                'grapesjs-preset-webpage',
                'grapesjs-navbar',
            ],
            pluginsOpts: {
                'gjs-blocks-basic': {
                    flexGrid: true
                },
                'grapesjs-tui-image-editor': {
                    config: {
                        includeUI: {
                            initMenu: 'filter',
                        },
                    },
                },
                'grapesjs-tabs': {
                    tabsBlock: {
                        category: 'Extra'
                    }
                },
                'grapesjs-typed': {
                    block: {
                        category: 'Extra',
                        content: {
                            type: 'typed',
                            'type-speed': 40,
                            strings: [
                                'Text row one',
                                'Text row two',
                                'Text row three',
                            ],
                        }
                    }
                },
            },
        });

        // Save Layout Functionality
        document.getElementById('save-layout').onclick = function() {
            const layoutData = editor.getHtml();
            const cssData = editor.getCss();
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route("save.layout") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ html: layoutData, css: cssData })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Layout saved successfully' );
                    editor.setComponents('');
                } else {
                    alert('Failed to save layout.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred: ' + error.message);
            });
        };
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>


@section('content')
     <!-- Load Tools -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script><!-- Image -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script><!-- Delimiter -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script><!-- List -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script><!-- Checklist -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script><!-- Quote -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script><!-- Code -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script><!-- Embed -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script><!-- Table -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script><!-- Link -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script><!-- Warning -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.9.0/dist/image.umd.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script><!-- Marker -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script><!-- Inline Code -->

 <!-- Load Editor.js's Core -->
 <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
 <link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">


 
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
 <script src="https://cdn.tailwindcss.com"></script>
 <meta name="csrf-token" content="{{ csrf_token() }}">
 
<x-head-navigation />

 <div class="mt-10 pt-10">
    <div id="editorjs"></div>
 </div>


@php
    $blocks = json_decode($service->service_post);
@endphp


<script>
    var data = @json($blocks);

    let image_upload_url = "/record/services/image-handler";
    var editor = new EditorJS({
        readOnly: true,
        holder: 'editorjs',

        tools: {
            header: {
            class: Header,
            inlineToolbar: ['marker', 'link'],
            config: {
                placeholder: 'Header'
            },
            shortcut: 'CMD+SHIFT+H'
            },

            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                    byFile: `${image_upload_url}`, 
                    byUrl:  `${image_upload_url}`,
                    },
                    additionalRequestHeaders: {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"//meta.constant
                    },
                }
            },

            list: {
                class: List,
                inlineToolbar: true,
                shortcut: 'CMD+SHIFT+L'
            },

            checklist: {
                class: Checklist,
                inlineToolbar: true,
            },

            quote: {
                class: Quote,
                inlineToolbar: true,
                config: {
                    quotePlaceholder: 'Enter a quote',
                    captionPlaceholder: 'Quote\'s author',
                },
                shortcut: 'CMD+SHIFT+O'
            },

            warning: Warning,

            marker: {
            class:  Marker,
            shortcut: 'CMD+SHIFT+M'
            },

            code: {
            class:  CodeTool,
            shortcut: 'CMD+SHIFT+C'
            },

            delimiter: Delimiter,

            inlineCode: {
            class: InlineCode,
            shortcut: 'CMD+SHIFT+C'
            },

            linkTool: LinkTool,

            embed: Embed,

            table: {
            class: Table,
            inlineToolbar: true,
            shortcut: 'CMD+ALT+T'
            },

        },

        data: data,

        onChange: function(api, event) {
            const blog_data_input = document.getElementById("service-post-input");
            
            editor.save()
            .then((savedData) => {
                blog_data_input.value = JSON.stringify(savedData);
            }).catch((error) => {
                console.log("Error: " + error)
            });
        }
        
    });

    const saveKnowledge = ()=>{
        editor.save()
        .then((savedData) => {
            console.log(savedData["blocks"])
        })
        .catch((error) => {
            console.error('Saving error', error);
        });
    }
    
</script>

@if(env('APP_ENV') == 'local')
    <script src="{{ asset('bower_components/requirejs/require.js') }}" data-main="{{ asset('public_cms/main_cms.js') }}"></script>
@else
    <script src="{{ asset('public_cms/js/app.min.js?cache=' . str_limit(time(), 6, '')) }}"></script>

@endif
<script src="{{ asset('lib/tinymce/tinymce.min.js') }}"></script>
<script>
    window.onload = function () {
        if (document.getElementById('section-cms-post'))
            // Editor Text Html
            tinymce.init({
                /* replace textarea having class .tinymce with tinymce editor */
                selector: "textarea#editor",

                /* theme of the editor */
                theme: "modern",
                skin: "lightgray",

                /* width and height of the editor */
                width: "100%",
                height: 300,

                /* display statusbar */
                statubar: true,

                /* plugin */
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],

                /* toolbar */
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor",

                /* style */
                style_formats: [
                    {
                        title: "Headers", items: [
                        {title: "Header 1", format: "h1"},
                        {title: "Header 2", format: "h2"},
                        {title: "Header 3", format: "h3"},
                        {title: "Header 4", format: "h4"},
                        {title: "Header 5", format: "h5"},
                        {title: "Header 6", format: "h6"}
                    ]
                    },
                    {
                        title: "Inline", items: [
                        {title: "Bold", icon: "bold", format: "bold"},
                        {title: "Italic", icon: "italic", format: "italic"},
                        {title: "Underline", icon: "underline", format: "underline"},
                        {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
                        {title: "Superscript", icon: "superscript", format: "superscript"},
                        {title: "Subscript", icon: "subscript", format: "subscript"},
                        {title: "Code", icon: "code", format: "code"}
                    ]
                    },
                    {
                        title: "Blocks", items: [
                        {title: "Paragraph", format: "p"},
                        {title: "Blockquote", format: "blockquote"},
                        {title: "Div", format: "div"},
                        {title: "Pre", format: "pre"}
                    ]
                    },
                    {
                        title: "Alignment", items: [
                        {title: "Left", icon: "alignleft", format: "alignleft"},
                        {title: "Center", icon: "aligncenter", format: "aligncenter"},
                        {title: "Right", icon: "alignright", format: "alignright"},
                        {title: "Justify", icon: "alignjustify", format: "alignjustify"}
                    ]
                    }
                ]
            });
    };
</script>
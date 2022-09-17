@push('styles')
    <style>
        .mce-ico {
            font-family: 'tinymce', Arial !important;
        }
    </style>
@endpush

@push('scripts')
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>--}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    {{--    <script src="http://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/jquery.tinymce.min.js"></script>--}}

    <script src="/plugins/tinymce/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: '.tinymce',
            language: 'fa_IR',
            plugins: 'lineheight code print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            theme: 'modern',
            // icons: 'bootstrap',
            // skin: 'bootstrap',
            mobile: {
                theme: 'mobile',
            },
            font_formats: 'Iran Sans= IRANSans; Vazir= Vazir; Aviny= Aviny; Yekan= Yekan; Yekan Fa Num= YekanFa',
            directionality: 'rtl',
            lineheight_formats: '8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt',
            fontsize_formats: '11px 12px 13px 14px 16px 18px 20px 24px 36px 48px 52px 56px 60px',
            content_style: 'body { font-family: IRANSans; }',
            toolbar: 'undo redo | formatselect lineheightselect fontsizeselect fontselect | bold italic backcolor strikethrough forecolor link | rtl ltr  alignleft aligncenter alignright alignjustify | numlist bullist outdent indent removeformat | preview code',
            language_url: '/plugins/tinymce/fa_IR.js',
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr                 = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/panel/files/upload');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader('X-CSRF-Token', token);
                xhr.onload = function () {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData   = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('{{$value}}', editor.getContent());
                });
            },

        });
    </script>

@endpush

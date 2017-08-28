@extends('layouts.admin.app_editor')
@section('content')
    <div class="row">

        <article>
            <div class="form-group">
                <h2>TITULO</h2>
                <span><button class="btn btn-sm btn-success btnEdit hint--rounded hint--top-left" aria-label="Editar"><i class="fa fa-edit fa-fw"></i></button></span>
                <span><button class="btn btn-sm btn-primary btnClose hint--rounded hint--top-left" aria-label="Guardar"><i class="fa fa-check fa-fw"></i></button></span>
            </div>
            <div class="form-group">
                <textarea name="" id="" cols="30" rows="1" class="summernote form-control" autofocus style="resize: none"></textarea>
            </div>
        </article>
        <article>
            <div class="form-group">
                <h2>SUBTITULO</h2>
                <span><button class="btn btn-sm btn-success btnEdit hint--rounded hint--top-left" aria-label="Editar"><i
                                class="fa fa-edit fa-fw"></i></button></span>
                <span><button class="btn btn-sm btn-primary btnClose hint--rounded hint--top-left" aria-label="Guardar"><i
                                class="fa fa-check fa-fw"></i></button></span>
            </div>
            <div class="form-group">
                <textarea name="" id="" cols="30" rows="1" class="summernote form-control" autofocus
                          style="resize: none"></textarea>
            </div>
        </article>
        <article>
            <div class="form-group">
                <h2>CONTENIDO</h2>
                <span><button class="btn btn-sm btn-success btnEdit hint--rounded hint--top-left" aria-label="Editar"><i
                                class="fa fa-edit fa-fw"></i></button></span>
                <span><button class="btn btn-sm btn-primary btnClose hint--rounded hint--top-left" aria-label="Guardar"><i
                                class="fa fa-check fa-fw"></i></button></span>
            </div>
            <div class="form-group">
                <textarea name="" id="" cols="30" rows="10" class="summernote form-control" autofocus
                          style="resize: none" readonly></textarea>
            </div>
        </article>
        <script type="text/javascript">
            $(function ($) {
                var loadOptions = {
//                    height: 50,
//                    tabsize: 2,
                    minHeight: 50,             // set minimum height of editor
                    maxHeight: 500,
                    codemirror: {
                        mode: 'text/html',
                        htmlMode: true,
                        lineNumbers: true,
                        theme: 'monokai'
                    },
                    toolbar: [
                        // [groupName, [list of button]]
                        ['view', ['codeview']]
                    ]
                };

                $('.summernote').summernote(loadOptions);

                $('.btnEdit').on('click', function () {
                    var $this = $(this),
                        article = $this.closest('article'),
                        bloque = article.find('.summernote');
                    $.extend(loadOptions, {focus: true});
                    bloque.summernote(loadOptions);
                });

                $('.btnClose').on('click', function () {
                    var $this = $(this),
                        article = $this.closest('article'),
                        bloque = article.find('.summernote');
                    bloque.summernote('code');
                    bloque.summernote('destroy');
                });
            });
        </script>

    </div>
@endsection
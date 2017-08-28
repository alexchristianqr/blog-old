@extends('layouts.admin.app')
@section('content')

    <article>

    {{--<a href="{!! url('get/html') !!}" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#yourModal">clicked </a>--}}
    {{--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#yourModal">click button</button>--}}

    <!-- Create a tag that we will use as the editable area. -->
        <!-- You can use a div tag as well. -->
        {{--<textarea></textarea>--}}
        {{--<div class="fr-view">--}}
        {{--Here comes the HTML edited with the Froala rich text editor.--}}
        {{--</div>--}}

        {{--<br>--}}
        {{--<br>--}}
        {{--<br>--}}

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 thumbnail" style="border-radius: 0">
                    <div class="text-center">
                        <h1>titulo</h1>
                    </div>
                </div>
                <div class="col-md-4 thumbnail" style="border-radius: 0">
                    <div class="text-center">
                        <h1>usuario</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><br></div>
            <div class="col-md-12">
                <div class="thumbnail" style="border-radius: 0">
                    <img src="{{ asset('images/x600/laravel_x600.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-12"><br></div>
            <div class="col-md-12">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores doloribus ducimus itaque magni
                    perspiciatis quam qui repellendus repudiandae vitae. Ab atque cumque eligendi eum modi nostrum odio
                    ratione recusandae tempora.</p>
                <p>Asperiores doloribus eius fuga laborum sint! Assumenda corporis cupiditate ducimus eligendi
                    exercitationem harum impedit minima nam nesciunt quas quo quod sint, sit totam unde ut vel vero. At,
                    ut velit.</p>
                <p>Alias beatae consectetur ea eligendi excepturi explicabo labore nam soluta suscipit ut. Architecto,
                    dolore id inventore ipsa laborum nulla obcaecati omnis perferendis quibusdam quis ratione rerum
                    veritatis voluptatem voluptatibus voluptatum.</p>
                <p>
                    <span>Ad aspernatur cum ducimus est fugit magnam, maxime nemo nobis odit repellendus saepe, sint voluptas.Aut cupiditate dolore dolorem eligendi excepturi quibusdam sint vero. Cumque hic porro repellat sunttenetur.</span>
                </p>
                <p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, id, sapiente. Adipisci aspernatur, cumque distinctio dolorum ducimus et laudantium praesentium quia quis quod similique soluta tempore, veritatis. Dolore dolores, repellat.</span><span>Accusamus accusantium nostrum praesentium sunt. Amet consequuntur delectus est facilis recusandae? Accusamus corporis cupiditate enim eos exercitationem maxime minus quam quis quisquam, temporibus tenetur unde ut? Porro quaerat quo soluta?</span><span>Cum dicta dolor ea error esse, facere fugiat inventore maiores nemo nostrum, quam quia repellat? Consectetur cumque deserunt error eum facere mollitia, pariatur possimus quasi, quia quidem repellendus, repudiandae suscipit!</span>
                </p>
            </div>
            <div class="col-md-12">
                <div class="thumbnail" style="border-radius: 0">
                    <img src="{{ asset('images/x600/laravel_x600.png') }}" alt="">
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <form action="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6 text-left" style="letter-spacing: 2px;">
                            <h6 class="text-left"><i class="fa fa-thumb-tack fa-fw"></i>TITULO</h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="btn-group" role="group" aria-label="...">
                                {{--<button type="button"--}}
                                {{--class="btn btn-sm btn-success btnEdit hint--rounded hint--top-left"--}}
                                {{--aria-label="Editar"><i class="fa fa-edit fa-fw"></i></button>--}}
                                <a href="{{ url('get/html',['html'=>'<p>esto es un parrafo!</p>']) }}"
                                   class="btn btn-success btnEdit hint--rounded hint--top-left" aria-label="Editar"><i
                                            class="fa fa-edit fa-fw"></i></a>
                                <button type="button" class="btn btn-primary btnClose hint--rounded hint--top-left"
                                        aria-label="Guardar"><i class="fa fa-check fa-fw"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {{--<div class="form-group">--}}
                    <textarea name="" id="textTitulo" cols="30" rows="1" class="summernote form-control"
                              autofocus></textarea>
                    {{--</div>--}}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6 text-left" style="letter-spacing: 2px;">
                            <h6 class="text-left"><i class="fa fa-thumb-tack fa-fw"></i>SUB TITULO</h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-primary btn-sm text-primary"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
<textarea name="" id="" cols="30" rows="1" class="summernote form-control" autofocus
          style="resize: none"></textarea>
                        <input type="text" class="form-control" placeholder="titulo del post">
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6 text-left" style="letter-spacing: 2px;">
                            <h6 class="text-left"><i class="fa fa-thumb-tack fa-fw"></i>CONTENIDO</h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-primary btn-sm text-primary"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
<textarea name="" id="" cols="30" rows="5" class="form-control">

</textarea>
                    </div>
                </div>
            </div>

        </form>
    </article>

@endsection
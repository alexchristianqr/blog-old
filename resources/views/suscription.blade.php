@extends('layouts.web.master',['title'=>'Suscripcion'])
@section('content')
    <div class="container">
        <article style="width: auto;border: 0 solid #ccc">
            <header style="width: auto;border: 0 solid #ccc;padding: 1em 0 0 0">
               <div class="text-center">
                   <h1>SUSCRIPCION</h1>
               </div>
            </header>
            <footer style="width: auto;border: 1px solid #f6f6f6;padding: 0;background-color: #f7f7f7">
                <div class="text-center" style="margin:0 ">
                    <span>Hola, necesitamos la confirmación del correo que te hemos enviado.</span>
                </div>
            </footer>
            <footer style="width: auto;border: 0 solid #ccc;padding: 1em 0 2em 0;">
                <div class="text-center">
                    <a href="{{ url('/') }}" class="button btn-block-error"><i class="fa fa-file-text fa-fw"></i>ver blog</a>
                    <a href="http://aquispe.com/personal/contacto" class="button btn-block-error"><i class="fa fa-phone fa-fw"></i>contácto</a>
                </div>
            </footer>
        </article>
    </div>
@endsection
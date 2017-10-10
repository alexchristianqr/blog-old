<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensaje</title>
    <style>
        p {
            text-align: left;
            margin-top: 0;
            color: #74787E !important;
            font-size: 16px;
            line-height: 1.5em;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: auto;
        }

        small {
            color: #74787E !important;
        }

        button, a {
            outline: 0 !important;
        }

        /* .btn */
        @media screen {
            .btn {
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 0;
            }
        }

        /* .btn-default */
        @media screen {
            .btn-default {
                color: #333;
                background-color: #fff;
                border-color: #ccc;
            }

            .btn-default:focus,
            .btn-default.focus {
                color: #333;
                background-color: #e6e6e6;
                border-color: #8c8c8c;
            }

            .btn-default:hover {
                color: #333;
                background-color: #e6e6e6;
                border-color: #adadad;
            }

            .btn-default:active,
            .btn-default.active,
            .open > .dropdown-toggle.btn-default {
                color: #333;
                background-color: #e6e6e6;
                border-color: #adadad;
            }

            .btn-default:active:hover,
            .btn-default.active:hover,
            .open > .dropdown-toggle.btn-default:hover,
            .btn-default:active:focus,
            .btn-default.active:focus,
            .open > .dropdown-toggle.btn-default:focus,
            .btn-default:active.focus,
            .btn-default.active.focus,
            .open > .dropdown-toggle.btn-default.focus {
                color: #333;
                background-color: #d4d4d4;
                border-color: #8c8c8c;
            }

            .btn-default:active,
            .btn-default.active,
            .open > .dropdown-toggle.btn-default {
                background-image: none;
            }
        }

        @media all {
            html {
                font-size: 10px;

                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                margin: 0;
            }

            body {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;
                line-height: 1.42857143;
                color: #333;
                background-color: #fff;
                margin: 0;
            }

            input,
            button,
            select,
            textarea {
                font-family: inherit;
                font-size: inherit;
                line-height: inherit;
            }

            a {
                color: #337ab7;
                text-decoration: none;
            }

            a:focus {
                outline: 5px auto -webkit-focus-ring-color;
                outline-offset: -2px;
            }

            hr {
                margin-top: 20px;
                margin-bottom: 20px;
                border: 0;
                border-top: 1px solid #eee;
            }

            [role="button"] {
                cursor: pointer;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .h1,
            .h2,
            .h3,
            .h4,
            .h5,
            .h6 {
                font-family: inherit;
                font-weight: 500;
                line-height: 1.1;
                color: inherit;
            }

            h1 small,
            h2 small,
            h3 small,
            h4 small,
            h5 small,
            h6 small,
            .h1 small,
            .h2 small,
            .h3 small,
            .h4 small,
            .h5 small,
            .h6 small,
            h1 .small,
            h2 .small,
            h3 .small,
            h4 .small,
            h5 .small,
            h6 .small,
            .h1 .small,
            .h2 .small,
            .h3 .small,
            .h4 .small,
            .h5 .small,
            .h6 .small {
                font-weight: normal;
                line-height: 1;
                color: #777;
            }

            h1,
            .h1,
            h2,
            .h2,
            h3,
            .h3 {
                margin-top: 20px;
                margin-bottom: 10px;
            }

            h1 small,
            .h1 small,
            h2 small,
            .h2 small,
            h3 small,
            .h3 small,
            h1 .small,
            .h1 .small,
            h2 .small,
            .h2 .small,
            h3 .small,
            .h3 .small {
                font-size: 65%;
            }

            h4,
            .h4,
            h5,
            .h5,
            h6,
            .h6 {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            h4 small,
            .h4 small,
            h5 small,
            .h5 small,
            h6 small,
            .h6 small,
            h4 .small,
            .h4 .small,
            h5 .small,
            .h5 .small,
            h6 .small,
            .h6 .small {
                font-size: 75%;
            }

            h1,
            .h1 {
                font-size: 36px;
            }

            h2,
            .h2 {
                font-size: 30px;
            }

            h3,
            .h3 {
                font-size: 24px;
            }

            h4,
            .h4 {
                font-size: 18px;
            }

            h5,
            .h5 {
                font-size: 14px;
            }

            h6,
            .h6 {
                font-size: 12px;
            }

            p {
                margin: 0 0 10px;
            }

            .lead {
                margin-bottom: 20px;
                font-size: 16px;
                font-weight: 300;
                line-height: 1.4;
            }

            @media (min-width: 768px) {
                .lead {
                    font-size: 21px;
                }
            }
            small,
            .small {
                font-size: 85%;
            }
        }
    </style>
</head>
<body style="background-color: #fff;">
<header style="background-color: #2ebaae;">
    <div style="padding: 2em 5em 2em 5em;">
        <h3 style="color: #fff">Suscripción al Newsletter de AQUISPE.COM</h3>
    </div>
</header>
<section>
    <div style="padding: 3em 5em 2em 5em;">
        <h4>Confirmar Suscripción?</h4>
        <a href="{{ url('subscription/confirm',['remember_token' => $remember_token]) }}" class="btn btn-default">
            <span>Si Acepto</span>
        </a>
        <hr>
        <div class="form-group">
            <small>
                <span>Si recibió este mensaje por error, simplemente elimínelo. No se suscribirá si no hace clic en el vínculo de confirmación.</span>
            </small>
        </div>
    </div>
    <div style="padding: 0 5em 2em 5em;">
        <div class="form-group">
            <small>
                <span>&raquo; Att. Alex Christian</span><br>
                <span>&raquo; aquispe.developer@gmail.com</span><br>
            </small>
        </div>
    </div>
</section>
<footer>
    <div style="padding: 2em 5em 2em 5em; text-align: center;">
        <small>
            <span>&copy;</span>
            <span>{{ (new Datetime)->format('Y') }}</span>
            <a href="http://aquispe.com/" style="color:#2ebaae"> aquispe.com.</a>
            <span>Todos los derechos reservados</span>
        </small>
    </div>
</footer>
</body>
</html>
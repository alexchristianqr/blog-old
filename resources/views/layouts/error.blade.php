<!DOCTYPE html>
<html>
<head>
    <title>{{ $error }}</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
        p ,
        p > *{
            font-weight: 700;
            box-shadow: none;
            letter-spacing: 1px;
        }

    </style>
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>

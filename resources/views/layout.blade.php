<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <style media="screen">
            #page {
                margin-top: 40px;
            }
            ul  {
                list-style: none;
            }
            li {
                padding: 20px;
                border: 1px solid #bdbdbd;
            }
            .table-container {
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        @include('partials.feedback')
        <div class="container" id="page">
            @yield('content')
        </div>

        @yield('scripts')
    </body>
</html>

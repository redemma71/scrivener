<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Scrivener</title>

        <!-- Styles -->
        <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{mix('css/scrivener.css')}}" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div id="logo" class="col-sm"></div>
                <div id="root" class="col"></div>
            </div>
        </div>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>


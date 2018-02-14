<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <form method="post" action="/courses">
                {{csrf_field()}}
                <input name="name">
                <input type="submit" id="add_course">
            </form>
        </div>
    </body>
</html>

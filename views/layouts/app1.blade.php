<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{TITLE}}</title>
    <base href="{{HTML_BASE}}">

    <?php headCss(); ?>
  </head>
  <body>

    <div class="container">

      @yield('content')

    </div>

    <script src="./lib/jquery.js"></script>
    <script src="./lib/bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>
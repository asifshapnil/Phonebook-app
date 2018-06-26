<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Phoneboook</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
      <div id="app">
        <myheader></myheader>
        <div class="container">
            <router-view></router-view>
        </div>
      </div>



      <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>

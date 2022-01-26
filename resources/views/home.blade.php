<!DOCTYPE html>
<html>
<head>
    <title>Single Page Forum</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
  <div id="app">
    <v-app>
      <app-home></app-home>
    </v-app>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags --}}
    <meta name="description" content="uxmodeler">
    <meta name="author" content="uxmodeler">

    {{--prevent browser to cache this page--}}
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <link rel="icon" href="/images/favicon.png">

    {{--Page Title --}}
    <title>@yield('title')</title>

    {{-- Google Fonts , Awsome Fonts --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    {{--Import Google Icon Font--}}
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{--Import materialize.css--}}
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"  media="screen,projection"/>

    {{--Import MDL--}}
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">

    {{--Let browser know website is optimized for mobile--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    {{----}}
    @yield('CSS')
    @yield('js-header')
</head>
<body>
   @yield('content')

   {{--Import jQuery before materialize.js--}}
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

   {{--Import MDL --}}
   <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

   {{--Import MaterializeCSS--}}
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

   @yield('js-footer')
</body>
</html>

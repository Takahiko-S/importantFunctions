<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- SEO 対策用記述 -->
        <meta name="keywords" content="{{$keywords}}">
        <meta name="description" content="{{$description}}">
        <meta property="og:type"content="{{$og_type}}"/>
        <meta property="og:url"content="{{url('')}}"/>
        <meta property="og:image"content="{{url('') . asset('images/site_image.png')}}"/>
        <meta property="og:description"content="{{$og_description}}"/>
         <!-- SEO 対策用記述 -->
         
         
        <title>{{ $title }}</title>
    

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Bootstrap CSS -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- <link href="{{asset('css/theme_custom.css')}}" rel="stylesheet"> -->
        <link href="{{asset('jquery-ui-1.13.2/jquery-ui.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/lightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/custom.css')}}" rel="stylesheet">
        
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('jquery-ui-1.13.2/external/jquery/jquery.js')}}"></script>
        <script src="{{asset('jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
        <script src="{{asset('js/lightbox.min.js')}}"></script>
        
        
      {{$css}}  
    </head>
    <body class="font-sans antialiased">
    {{$main}}
    
    {{$script}}
    </body>
</html>

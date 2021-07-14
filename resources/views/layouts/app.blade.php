<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:locale" content="en_US"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content=""/>
        <meta property="og:site_name" content=""/>
        <meta property="og:description" content=""/>
        <meta property="og:title" content="" />
        <meta name="description" content="" />
        <meta name="keywords" content="">
        <meta name="robots" content="index, follow, noydir">
        <meta name="format-detection" content="telephone=no">
        <link rel="canonical" href="https://www.">
        <style></style>

        <link rel="shortcut icon" href="{{ URL::asset('img/favicon/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ URL::asset('img/favicon/apple-touch-icon.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('img/favicon/apple-touch-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('img/favicon/apple-touch-icon-114x114.png') }}">
        <link rel="stylesheet"  href="{{asset('css/general.css')}}" />

        <title>@yield('title')</title>

        @livewireStyles

    </head>
    <body>
        @yield('header')
        @yield('content')
        @yield('footer')
        @livewireScripts
    </body>
</html>

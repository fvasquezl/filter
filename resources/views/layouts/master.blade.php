<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FilterBooks</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
    @include("layouts.partials.navbar")
    @include("layouts.partials.mainSidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include("layouts.partials.breadcrumb")
        <div class="content">
            <div class="container-fluid">

                <router-view></router-view>

            </div>
        </div>
    </div>

    @include("layouts.partials.hiddenSidebar")
    @include("layouts.partials.footer")

</div>
<!-- ./wrapper -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>


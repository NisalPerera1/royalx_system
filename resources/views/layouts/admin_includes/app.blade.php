<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('./admin/images/favicon.png')}}">
    <!-- Page Title  -->
    <title>RoyalX System</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('./admin/assets/css/dashlite.css?ver=3.2.3')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('./admin/assets/css/theme.css?ver=3.2.3')}}">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        @include('layouts.admin_includes.sidebar')
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            @include('layouts.admin_includes.header')
            <!-- main header @e -->
            <!-- content @s -->
            @yield('content')
            <!-- content @e -->
            <!-- footer @s -->
            @include('layouts.admin_includes.footer')
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->

<script src="{{asset('./admin/assets/js/bundle.js?ver=3.2.3')}}"></script>
<script src="{{asset('./admin/assets/js/scripts.js?ver=3.2.3')}}"></script>
<script src="{{asset('./admin/assets/js/charts/gd-default.js?ver=3.2.3')}}"></script>
@yield('scripts')
</body>

</html>

@extends('adminlte::page')

@section('title', 'Quiz App')

<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quiz App')</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.sidebar') <!-- Include the sidebar here only once -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
</body>
</html>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzes available</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.sidebar') <!-- Include the sidebar here only once -->

        <!-- Main content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- Add AdminLTE and jQuery scripts -->
</body>
</html> --}}

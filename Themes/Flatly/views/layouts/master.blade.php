<!DOCTYPE html>
<html>
<head lang="{{ LaravelLocalization::setLocale() }}">
    <meta charset="UTF-8">

    @section('meta')
        <meta name="description" content="@setting('core::site-description')" />
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @section('title')@setting('core::site-name')@show
    </title>
    <link rel="shortcut icon" href="{{ Theme::url('favicon.ico') }}">

    {!! Theme::style('css/main.css') !!}
</head>
<body>

@include('partials.navigation')

<div class="container">
<center>    <a href="{{ route('login') }}" class="btn btn-default btn-lg">Ingresar al login</a></center>
</div>
@include('partials.footer')

{!! Theme::script('js/all.js') !!}
@yield('scripts')

<?php if (Setting::has('core::analytics-script')): ?>
    {!! Setting::get('core::analytics-script') !!}
<?php endif; ?>
</body>
</html>
 
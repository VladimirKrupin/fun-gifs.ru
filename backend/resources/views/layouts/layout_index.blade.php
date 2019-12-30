<!DOCTYPE html>
<html lang="ru">

@include('includes/head')

<body class="index-page sidebar-collapse">
<div>

    @include('includes/header')

    @yield('content')

</div>

@include('includes/scripts')

@include('includes/footer')

</body>

</html>

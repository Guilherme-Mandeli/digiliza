<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>@yield('page_title')</title>

    @include('site.components.meta')

    @include('site.components.header')

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="58" class="scrollspy-example">

    <!--Navbar Start-->
    @include('site.components.topbar')
    <!-- Navbar End -->

    @yield('site-content')

    <!-- footer start -->
    @include('site.components.footer')
    <!-- footer end -->

    <!-- Back to top -->
    <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

    <script>
        $(function() {
            $("#basic-datepicker").datepicker();
        });
    </script>
    <script>
        $(function() {
            $("#basic-datepicker").datepicker({
                dateFormat: "dd/mm/yy",
                minDate: 0,
                maxDate: "+1m",
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2030"
            });
        });
    </script>

    @include('site.components.bottom')

</body>

</html>

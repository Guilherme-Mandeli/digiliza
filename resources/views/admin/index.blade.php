<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>@yield('page_title') | Gourmet Night</title>

    @include('components.meta')

    @include('components.header')

</head>

<!-- body start -->

<body class="loading"
    data-layout='{
        "mode": "light",
        "width": "fluid",
        "menuPosition": "fixed",
        "sidebar": { 
            "color": "light",
            "size": "default",
            "showuser": true
        },
        "topbar": {
            "color":
            "light"
        },
        "showRightSidebarOnPageLoad": true
    }'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Topbar Start ========== -->
        @include('components.topbar')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('components.leftbar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div id="content_container" class="content-page">
            <div class="content d-flex flex-wrap">

                <!-- Start Content-->
                <div class="container-fluid col-12 col-lg-9" id="post_content">

                    <!-- Configuração do menu -->
                    @yield('menucfg')
                    <!-- Fim de configuração do menu -->

                    {{-- @include('components.titlebar') --}}

                    <div class="card mt-lg-4" id="content">
                        <div class="card-body">
                            <div class="row">

                                @yield('content')

                            </div>
                        </div>
                    </div>

                </div> <!-- container -->

                <!-- Right Sidebar-->
                <div class="container-fluid col-12 col-lg-3">

                    @include('admin.components.rightbar')

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('components.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    @include('components.bottom')

</body>

</html>

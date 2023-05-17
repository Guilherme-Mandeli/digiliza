<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark" id="nav-sticky">
    <div class="container-fluid">
        <!-- LOGO -->
        <a class="logo text-uppercase" href="/">
            <img src="{{ asset('landing/images/logo-light.png') }}" alt="" class="logo-light" height="32" />
            <img src="{{ asset('landing/images/logo-dark.png') }}" alt="" class="logo-dark" height="32" />
        </a>
        <button id="menuToggle" type="button" class="navbar-toggler d-lg-none" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <ul class="navbar-nav ms-auto col-12 mt-2" id="mySidenav">
            <li class="nav-item">
                <a href="#home" class="nav-link active">Inicio</a>
            </li>
            <li class="nav-item">
                <a href="#schedule" class="nav-link">Agendar</a>
            </li>
            <li class="nav-item">
                <a href="#menu" class="nav-link">Cardápio</a>
            </li>
            <li class="nav-item">
                <a href="#contact" class="nav-link">Contato</a>
            </li>
        </ul>
    </div>
</nav>

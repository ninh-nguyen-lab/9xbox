<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/">
                        <img class="logo-default" src="{{ asset($setting['company_logo']) }}" alt="logo">
                        <img class="logo-scroll" src="{{ asset('frontend/img/logo_white.png') }}" alt="logo">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>
                    @include('frontend.partials.navbar')
                </nav>
            </div>
        </div>
    </div>
</header>
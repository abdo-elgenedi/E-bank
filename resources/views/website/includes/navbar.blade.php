<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>


<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-xl-2">
                <h1 class="mb-0 site-logo"><a href="{{route('welcome')}}" class="h2 mb-0">E-Bank<span class="text-primary">.</span> </a></h1>
            </div>

            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li><a href="{{route('welcome')}}" class="nav-link">Home</a></li>
                        <li><a href="{{route('aboutus')}}" class="nav-link">About Us</a></li>
                        <li><a href="{{route('gallery')}}" class="nav-link">Gallery</a></li>
                        <li><a href="{{route('services')}}" class="nav-link">Services</a></li>
                        <li><a href="{{route('testimonials')}}" class="nav-link">Testimonials</a></li>
                        <li><a href="{{route('contact')}}" class="nav-link">Contact</a></li>
                    @guest()
                        <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
                    @else
                        <li class="has-children">
                            <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                            <ul class="dropdown">
                                <li><a class=nav-link" style="cursor: auto">Balance: {{Auth::user()->balance}}$</a></li>
                                <li><a class=nav-link" href="{{route('customer.rate.index')}}">Rate us</a></li>
                                <li><a class="nav-link" href="{{route('customer.accounts.index')}}">Accounts</a></li>
                                <li><a class="nav-link" href="{{route('customer.transfer.index')}}">Send money</a></li>
                                <li><a class="nav-link" href="{{route('customer.transactions.index')}}">Transactions</a></li>
                                <li><a class="nav-link" href="{{route('customer.profile.index')}}">Profile</a></li>
                                <li >
                                    <a class=nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    </ul>
                </nav>
            </div>


            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>

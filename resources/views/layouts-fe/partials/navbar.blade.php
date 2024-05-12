<header id="header" class="header d-flex align-items-center fixed-top" style="background: rgba(14, 29, 52, 0.9)">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('assets/img/logo-doc.png')}}" alt="">
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          @if (Auth::check())
          <li><a class="get-a-quote" href="{{ url('dashboard') }}" style="background: blue;border: 1px solid blue;border-radius: 6px;">Dashboard</a></li>
          <li><a class="get-a-quote bg-danger" href="{{ url('/logout')}}" style="background: red!important;border: 1px solid red;border-radius: 6px;">Logout</a></li>
          @else
          <li><a class="get-a-quote" href="{{ url('login') }}" style="background: blue;border: 1px solid blue;border-radius: 6px;">Login</a></li>
          @endif
        </ul>
      </nav><!-- .navbar -->

    </div>
</header>
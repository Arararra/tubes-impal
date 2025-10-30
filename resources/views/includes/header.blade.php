{{-- desktop header --}}
<header class="header header--default" data-sticky="true">
  {{-- open hour --}}
  <div class="header__left">
    <p><i class="fa fa-clock-o"></i> 07:00 am - 09:00 pm</p>
  </div>

  {{-- desktop top nav --}}
  <div class="header__center">
    <nav class="header__navigation left">
      <ul class="menu">
        <li class="current-menu-item">
          <a href="{{ url('/') }}">Home</a>
        </li>
        <li>
          <a href="{{ url('catalog') }}">Katalog</a>
        </li>
      </ul>
    </nav>
    <div class="header__logo">
      <a class="ps-logo" href="{{ url('/') }}">
        <img src="{{ asset('themes/img/logo.png') }}" alt="Brand Logo">
      </a>
    </div>
    <nav class="header__navigation right">
      <ul class="menu">
        <li class="current-menu-item">
          <a href="{{ url('about') }}">About</a>
        </li>
        <li>
          <a href="{{ url('faq') }}">FAQ</a>
        </li>
      </ul>
    </nav>
  </div>
  
  {{-- desktop shopping cart --}}
  <div class="header__right">
    <div class="header__actions">
      <div class="ps-cart--mini">
        <a class="ps-cart__toggle" href="#">
          <i class="fa fa-shopping-basket"></i>
          <span><i>1</i></span>
        </a>
        @include('includes.cart-content')
      </div>
    </div>
  </div>
</header>

{{-- mobile header --}}
<header class="header header--mobile" data-sticky="false">
  <div class="header__content">
    <div class="header__center">
      <a class="ps-logo" href="#">
        <img src="{{ asset('themes/img/logo.png') }}" alt="">
      </a>
    </div>
  </div>
</header>

{{-- mobile shopping cart --}}
<div class="ps-panel--sidebar" id="cart-mobile">
  <div class="ps-panel__header">
    <h3>Shopping Cart</h3>
  </div>
  <div class="navigation__content">
    <div class="ps-cart--mobile">
      @include('includes.cart-content')
    </div>
  </div>
</div>

{{-- mobile side nav --}}
<div class="ps-panel--sidebar" id="navigation-mobile">
  <div class="ps-panel__header">
    <h3>Menu</h3>
  </div>
  <div class="ps-panel__content">
    <ul class="menu--mobile">
      <li class="current-menu-item">
        <a href="{{ url('/') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('catalog') }}">Katalog</a>
      </li>
      <li class="current-menu-item">
        <a href="{{ url('about') }}">About</a>
      </li>
      <li>
        <a href="{{ url('faq') }}">FAQ</a>
      </li>
    </ul>
  </div>
</div>

{{-- mobile bottom menu --}}
<div class="navigation--list">
  <div class="navigation__content">
    <a class="navigation__item" href="{{ url('/') }}">
      <i class="fa fa-home"></i>
    </a>
    <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile">
      <i class="fa fa-bars"></i>
    </a>
    <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile">
      <i class="fa fa-shopping-basket"></i>
    </a>
  </div>
</div>
<header class="header header--default" data-sticky="true">
  <div class="header__left">
    <p><i class="fa fa-clock-o"></i> 09:00 - 21:00</p>
  </div>
  <div class="header__center">
    <nav class="header__navigation left">
      <ul class="menu">
        <li class="current-menu-item">
          <a href="{{ url('/') }}">Home</a>
        </li>
        <li>
          <a href="{{ url('katalog') }}">Katalog</a>
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
          <a href="{{ url('faq') }}">faq</a>
        </li>
      </ul>
    </nav>
  </div>
  
  <div class="header__right">
    <div class="header__actions">
      <div class="ps-cart--mini">
        <a class="ps-cart__toggle" href="#">
          <i class="fa fa-shopping-basket"></i>
          <span><i>1</i></span>
        </a>
        
        <div class="ps-cart__content">
          <div class="ps-cart__items">
            <div class="ps-product--mini-cart">
              <div class="ps-product__thumbnail">
                <a href="#"><img src="img/product/12.png" alt=""></a>
              </div>
              <div class="ps-product__content">
                <span class="ps-btn--close"></span>
                <a class="ps-product__title" href="product-default.html">Jean Woman Summer</a>
                <p><strong>Quantity: 1</strong></p><small>$12.00</small>
              </div>
            </div>
          </div>
          <div class="ps-cart__footer">
            <h3>Sub Total:<strong>$48.00</strong></h3>
            <figure>
              <a class="ps-btn ps-btn--dark" href="checkout.html">Checkout</a>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
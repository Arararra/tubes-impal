<div class="ps-hero bg--cover" data-background="{{ asset('themes/img/shop-hero.png') }}">
  <div class="ps-hero__container">
    <div class="ps-breadcrumb">
      <ul class="breadcrumb">
        <li>
          <a href="{{ url('/') }}">Home</a>
        </li>
        @foreach ($breadcrumb as $item)  
          <li>{{ $item }}</li>
        @endforeach
      </ul>
    </div>
    <h1 class="ps-hero__heading">{{ last($breadcrumb) }}</h1>
  </div>
</div>
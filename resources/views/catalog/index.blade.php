@extends('layouts.base')

@section('title', 'Katalog')
@section('customStyles')
@endsection

@section('content')
  <div class="ps-hero bg--cover" data-background="{{ asset('themes/img/shop-hero.png') }}">
    <div class="ps-hero__container">
      <div class="ps-breadcrumb">
        <ul class="breadcrumb">
          <li>
            <a href="{{ url('/') }}">Home</a>
          </li>
          <li>Katalog</li>
        </ul>
      </div>
      <h1 class="ps-hero__heading">Katalog</h1>
    </div>
  </div>

  <div class="ps-page--shop">
    <div class="container-fluid">
      <div class="ps-shopping ps-shopping--fullwidth">
        <div class="ps-shopping__left">
          <aside class="widget widget_shop widget_categories">
            <h3 class="widget-title">Categories</h3>
            <ul>
              @foreach ($categories as $item)
                <li><a href="{{ url("catalog?category=${item['id']}") }}">{{ $item['title'] }}</a></li>
              @endforeach
            </ul>
          </aside>
          <aside class="widget widget_shop widget_shop-filter">
            <h3 class="widget-title">Filter price</h3>
            <div class="ps-slider" data-default-min="0" data-default-max="100" data-max="100" data-step="5" data-unit="$"></div>
            <p class="ps-slider__meta">Price:<span class="ps-slider__value ps-slider__min"></span>-<span class="ps-slider__value ps-slider__max"></span></p>
          </aside>
        </div>
        
        <div class="ps-shopping__right">
          <div class="ps-shopping__top">
            <p>Show 1-12 of 35 result</p>
            <figure>
              <select class="ps-select" title="Default Sorting">
                <option value="1">Default Sorting 1</option>
                <option value="2">Default Sorting 2</option>
                <option value="3">Default Sorting 3</option>
              </select>
            </figure>
          </div>
          <div class="ps-product-box">
            <div class="row">
              @foreach ($products as $item)
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                  <div class="ps-product border rounded overflow-hidden" style="background: #fff4e9;">
                    <div class="ps-product__thumbnail">
                      <img src="{{ env('API_HOST')."/storage/".$item['image'] }}" alt="" class="h-100 object-fit-cover" />
                      <a class="ps-product__overlay" href="{{ url("catalog/${item['id']}") }}"></a>
                    </div>
                    <div class="ps-product__content p-4">
                      <div class="ps-product__desc h-100 d-flex flex-column align-items-center justify-content-center">
                        <a class="ps-product__title" href="{{ url("catalog/${item['id']}") }}">{{ $item['title'] }}</a>
                        <span class="ps-product__price">Rp. {{ number_format($item['price'], 0, ',', '.') }}</span>
                      </div>
                      <div class="ps-product__shopping h-100 d-flex align-items-center justify-content-center">
                        <a class="ps-btn ps-product__add-to-cart" href="#">Add to cart</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="ps-pagination">
            <ul class="pagination">
              <li><a href="#"><i class="fa fa-caret-left"></i></a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#"><i class="fa fa-caret-right"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('customScripts')
  <script>
    $(function() {
      $('.ps-product .ps-product__thumbnail').matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
      });
      $('.ps-product .ps-product__content').matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
      });
    });
  </script>   
@endsection
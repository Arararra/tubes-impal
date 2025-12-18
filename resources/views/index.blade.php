@extends('layouts.base')

@section('title', 'Home')
@section('customStyles')
  <style>
    .header--default .header__actions .ps-cart--mini > .ps-cart__toggle {
      color: #ffffff;
    }
    .header--default .header__left p {
      color: #ffffff;
    }
  </style>
@endsection

@section('content')
  <div id="homepage-3">
    <div class="ps-home-banner">
      <div class="ps-banner ps-banner--1 bg--cover" data-background="{{ asset('themes/img/banner.jpg') }}">
        <div class="ps-banner__content">
          <h3>Amba Bakery</h3>
          <p>100% Natural, FRESH baked goods</p>
          <a href="{{ url('products') }}" class="ps-btn">Jelajah Produk</a>
          <br>
          <a href="{{ url('/admin') }}" class="ps-btn mt-3">ADMIN PAGE</a>
        </div>
      </div>
    </div>

    {{-- <div class="ps-section ps-home-about">
      <div class="container">
        <div style="height: 100vh" class="d-flex justify-content-center align-items-center">
          <h1>TEST LONG PAGE</h1>

          @dump($categories)
          @dump($products)
          @dump($reviews)
        </div>
      </div>
    </div> --}}
  </div>
@endsection
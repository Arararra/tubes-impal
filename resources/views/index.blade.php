@extends('layouts.base')

@section('title', 'Home')

@section('content')
  <div id="homepage-3">
    <div class="ps-home-banner">
      <div class="ps-banner ps-banner--1 bg--cover" data-background="{{ asset('themes/img/banner.jpg') }}">
        <div class="ps-banner__content">
          <h3>Mr. Amba's Bakery</h3>
          <p>100% Natural, FRESH baked goods</p>
          <a class="ps-btn" href="{{ url('catalog') }}">Jelajah katalog</a>
        </div>
      </div>
    </div>

    <div class="ps-section ps-home-about">
      <div class="container">
        
      </div>
    </div>
  </div>

  <div style="padding: 10rem 4.5rem; background-color: #f4f4f4;">
    <h1>Ini Adalah the Home Page</h1>
    
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. 
      Illum eaque corrupti aperiam mollitia sint possimus odio, numquam nesciunt neque fuga corporis et consequatur? 
      Impedit inventore commodi pariatur reprehenderit odio repellendus?
    </p>

    <a href="{{ url('/admin') }}">
      <h1>TEKAN LINK INI UNTUK AKSES ADMIN PAGE</h1>
    </a>

    <div style="height: 100vh" class="d-flex justify-content-center align-items-center">
      <h1>TEST LONG PAGE</h1>
    </div>

    {{-- @dump($categories)
    @dump($products)
    @dump($reviews) --}}
  </div>
@endsection
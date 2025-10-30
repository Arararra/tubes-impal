@extends('layouts.base')

@section('title', 'Home')

@section('content')
  <div style="padding: 4.5rem; padding-top: 10rem; background-color: #f4f4f4;">
    <h1>Ini Adalah the Home Page</h1>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. 
      Illum eaque corrupti aperiam mollitia sint possimus odio, numquam nesciunt neque fuga corporis et consequatur? 
      Impedit inventore commodi pariatur reprehenderit odio repellendus?
    </p>
    <a href="{{ url('/admin') }}">
      <h1>TEKAN LINK INI UNTUK AKSES ADMIN PAGE</h1>
    </a>

    @dump($categories)
    @dump($products)
    @dump($reviews)
  </div>
@endsection
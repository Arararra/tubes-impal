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

  {{-- TBA Product Cards, Filter, Sort --}}
@endsection
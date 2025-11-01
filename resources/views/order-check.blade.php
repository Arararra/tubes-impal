@extends('layouts.base')

@section('title', 'Order Check')
@section('customStyles')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
@endsection

@section('content')
  @include('includes.breadcrumb', [
    'breadcrumb' => ['Order Check']
  ])
  
  <div class="ps-section ps-home-about">
    <div class="container">
      @dump($order)
    </div>
  </div>
@endsection
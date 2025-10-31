@extends('layouts.base')

@section('title', $pageTitle)
@section('customStyles')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
  <style>
    .attachment__caption {
      display: none !important;
    }
    [class*="rounded-"] {
      transition: border-radius 0.3s ease;
    }
    .rounded-pill-bottom {
      transition: max-height 0.4s ease, opacity 0.4s ease, padding 0.4s ease;
      overflow: hidden;
      opacity: 0;
      padding: 0;
      max-height: 0;
    }
    .rounded-pill-bottom.show {
      opacity: 1;
      max-height: none;
    }
  </style>
@endsection

@section('content')
  <div class="ps-hero bg--cover" data-background="{{ asset('themes/img/shop-hero.png') }}">
    <div class="ps-hero__container">
      <div class="ps-breadcrumb">
        <ul class="breadcrumb">
          <li>
            <a href="{{ url('/') }}">Home</a>
          </li>
          <li>{{ $pageTitle }}</li>
        </ul>
      </div>
      <h1 class="ps-hero__heading">{{ $pageTitle }}</h1>
    </div>
  </div>
  
  <div class="ps-section ps-home-about">
    <div class="container">
      <div class="ps-section__content text-left">
        @if ($body != '')
          <div class="text-center text-white">
            {!! $body !!}
          </div>
        @endif
        
        @if ($accordions != [])
          <div x-data="{ openIndex: 0, accordions: {{ json_encode($accordions) }} }" class="mt-65">
            <template x-for="(item, index) in accordions" :key="index">
              <div class="mb-3">
                <div class="card card-header p-4 d-flex flex-row justify-content-between align-items-center" 
                  style="background: #e1d0be; cursor: pointer;" :class="openIndex === index ? 'rounded-pill-top' : 'rounded-pill'"
                  @click="openIndex = openIndex === index ? null : index">
                  <p class="font-weight-bold mb-0" x-text="item.title"></p>
                  <i class="fa fa-chevron-down transition-transform" :class="{ 'rotate-n180': openIndex === index }"
                    style="transition: transform 0.3s ease;"></i>
                </div>

                <div class="card card-body rounded-pill-bottom" 
                  style="background: #fff4e9;" :class="{ 'p-4 show': openIndex == index }">
                  <p class="mb-0" x-html="item.body"></p>
                </div>
              </div>
            </template>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
@extends('layouts.base')

@section('title', 'Katalog')

@php
  $start = ($currentPage - 1) * $perPage + 1;
  $end = min($currentPage * $perPage, $total);
  $lastPage = ceil($total / $perPage);   
@endphp

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
          <div class="sticky-lg-top">
            <aside class="widget widget_shop widget_categories">
              <h3 class="widget-title">Kategori</h3>
              <ul>
                <li>
                  <a href="{{ url()->current().'?'.http_build_query(request()->except('category', 'page')) }}"
                    @class(['active' => !$selectedCategory])>
                    Semua Kategori
                  </a>
                </li>

                @foreach ($categories as $item)
                  <li>
                    <a href="{{ url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['category' => $item['id']])) }}"
                      @class(['active' => $selectedCategory == $item['id']])>
                      {{ $item['title'] }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </aside>
            {{-- <aside class="widget widget_shop widget_shop-filter">
              <h3 class="widget-title">Filter harga</h3>
              <div class="ps-slider mr-4" data-default-min="0" data-default-max="100" data-max="100" data-step="5" data-unit="$"></div>
              <p class="ps-slider__meta">
                Price:<span class="ps-slider__value ps-slider__min"></span>-<span class="ps-slider__value ps-slider__max"></span>
              </p>
            </aside> --}}
          </div>
        </div>
        
        <div class="ps-shopping__right">
          <div class="ps-shopping__top">
            <p>Menampilkan {{ $start }}-{{ $end }} dari {{ $total }} hasil</p>
            <figure>
              <select class="ps-select mr-0" title="Sort" onchange="location = this.value;">
                <option value="{{ url()->current().'?'.http_build_query(array_merge(request()->except('sort'), ['sort' => 1])) }}" 
                  @if($selectedSort == 1) selected @endif>
                  Nama A-Z
                </option>
                <option value="{{ url()->current().'?'.http_build_query(array_merge(request()->except('sort'), ['sort' => 2])) }}" 
                  @if($selectedSort == 2) selected @endif>
                  Nama Z-A
                </option>
                <option value="{{ url()->current().'?'.http_build_query(array_merge(request()->except('sort'), ['sort' => 3])) }}" 
                  @if($selectedSort == 3) selected @endif>
                  Harga Terendah
                </option>
                <option value="{{ url()->current().'?'.http_build_query(array_merge(request()->except('sort'), ['sort' => 4])) }}" 
                  @if($selectedSort == 4) selected @endif>
                  Harga Tertinggi
                </option>
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
                        <div class="d-flex flex-wrap justify-content-center">
                          @foreach ($item['categories'] as $cat)
                            <span class="badge badge-pill text-white m-1" style="background: #7f462c; font-size: 90%">
                              {{ $cat['title'] }}
                            </span>                              
                          @endforeach
                        </div>
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
              <li class="{{ $currentPage == 1 ? 'disabled' : '' }}">
                <a href="{{ $currentPage == 1 ? 'javascript:void(0)' : url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['page' => $currentPage-1])) }}">
                  <i class="fa fa-caret-left"></i>
                </a>
              </li>

              @for ($i = 1; $i <= $lastPage; $i++)
                <li class="{{ $currentPage == $i ? 'active' : '' }}">
                  <a href="{{ $currentPage == $i ? 'javascript:void(0)' : url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['page' => $i])) }}">
                    {{ $i }}
                  </a>
                </li>
              @endfor

              <li class="{{ $currentPage == $lastPage ? 'disabled' : '' }}">
                <a href="{{ $currentPage == $lastPage ? 'javascript:void(0)' : url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['page' => $currentPage+1])) }}">
                  <i class="fa fa-caret-right"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('customScripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
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
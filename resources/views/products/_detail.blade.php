@extends('layouts.base')

@section('title', $product['title'])

@section('customStyles')
  <style>
    .ps-product__shopping input::-webkit-outer-spin-button,
    .ps-product__shopping input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .ps-product__shopping input[type=number] {
      -moz-appearance:textfield;
    }
  </style>
@endsection

@section('content')
  @include('includes.breadcrumb', [
    'breadcrumb' => ['Produk', $product['title']]
  ])

  <div class="ps-page--shop">
    <div class="container">
      <div class="ps-shopping ps-shopping--fullwidth">
        <div class="ps-product--detail">
          <div class="ps-product__header">
            <div class="ps-product__thumbnail">
              <figure>
                <div class="ps-product__gallery">
                  <div class="item">
                    <img src="{{ env('API_HOST')."/storage/".$product['image'] }}" alt="Foto produk">
                  </div>
                </div>
              </figure>
              <div class="ps-product__variants" data-item="5" data-md="4" data-sm="4" data-arrow="false">
                <div class="item"><img src="img/product/25.png" alt=""></div>
                <div class="item"><img src="img/product/26.png" alt=""></div>
                <div class="item"><img src="img/product/37.png" alt=""></div>
              </div>
            </div>
            <div class="ps-product__info">
              <h1>{{ $product['title'] }}</h1>

              <div class="ps-product__meta">
                <div class="ps-product__rating">
                  <select class="ps-rating" data-read-only="true">
                    @for ($i = 0; $i <= 5; $i++)
                      <option value="{{ $i }}" {{ $i <= $productRating ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>

              <h4 class="ps-product__price sale">
                Rp. {{ number_format($product['price'], 0, ',', '.') }}
              </h4>

              <div class="ps-product__desc">
                {{ $product['body'] }}
              </div>

              <div class="ps-product__specification p-0 mb-4">
                <p>STOCK: {{ $product['stock'] }}</p>
                <p>
                  CATEGORIES: 
                  {!! implode(', ', array_map(function ($category) {
                    return '<a href="'.url('/products?category='.$category['id']).'">'.$category['title'].'</a>';
                  }, $product['categories'])) !!}
                </p>
              </div>
              
              <div class="ps-product__shopping">
                <div class="form-group--number">
                  <button class="up"></button>
                  <button class="down"></button>
                  <input class="form-control" type="number" placeholder="1">
                </div>
                <a class="ps-btn" href="javascript:;">ADD TO CART</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('customScripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const quantityInput = document.querySelector('.ps-product__shopping .form-control');
      const incrementButton = document.querySelector('.ps-product__shopping .up');
      const decrementButton = document.querySelector('.ps-product__shopping .down');
      const addToCartButton = document.querySelector('.ps-product__shopping .ps-btn');

      incrementButton.addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value || 1) + 1;
      });

      decrementButton.addEventListener('click', () => {
        const currentValue = parseInt(quantityInput.value || 1);
        quantityInput.value = currentValue > 1 ? currentValue - 1 : 1;
      });

      addToCartButton.addEventListener('click', () => {
        const product = {
          id: {{ $product['id'] }},
          name: '{{ $product['title'] }}',
          image: '{{ env('API_HOST').'/storage/'.$product['image'] }}',
          price: {{ $product['price'] }},
        };
        const quantity = parseInt(quantityInput.value || 1);
        for (let i = 0; i < quantity; i++) {
          addToCart(product);
        }
      });
    });
  </script>
@endsection

@extends('layouts.base')

@section('title', 'Checkout')

@section('content')
  @include('includes.breadcrumb', [
    'breadcrumb' => ['Checkout']
  ])

  <div class="container">
    <form action="{{ route('checkout-payment') }}" method="post" class="ps-checkout">
      <div class="ps-checkout__left">
        <div class="ps-form--checkout">
          <h4>Data Pelanggan</h4>
          <div class="form-group">
            <label>Nama</label>
            <input class="form-control border rounded-pill" type="text">
          </div>
          <div class="form-group">
            <label>Nomor Whatsapp</label>
            <input class="form-control border rounded-pill" type="text">
          </div>
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
              <div class="form-group">
                <label>Kota/Kecamatan</label>
                <input class="form-control border rounded-pill" type="text">
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
              <div class="form-group">
                <label>Kode Pos</label>
                <input class="form-control border rounded-pill" type="text">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea class="form-control border rounded-pill" rows="4"></textarea>
          </div>
        </div>
      </div>

      <div class="ps-checkout__right">
        <div class="ps-block--your-order">
          <div class="ps-block__header">
            <h3>Pesanan Anda</h3>
          </div>
          <div class="ps-block__divider"></div>
          <div class="ps-block__detail">
            <div class="order-preview"></div>
            <div class="ps-block__divider"></div>
            <p class="total">
              Total <strong class="cart-total">Rp. 0</strong>
            </p>
          </div>
          <div class="ps-block__footer mt-5">
            <button type="submit" class="ps-btn ps-btn--fullwidth">Place Order</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
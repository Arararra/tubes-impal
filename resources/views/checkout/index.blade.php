@extends('layouts.base')

@section('title', 'Checkout')

@section('content')
  @include('includes.breadcrumb', [
    'breadcrumb' => ['Checkout']
  ])

  <div class="container">
    <form method="POST" action="api/orders/checkout" class="ps-checkout">
      @csrf
      <div class="ps-checkout__left">
        <div class="ps-form--checkout">
          <h4>Data Pelanggan</h4>
          <div class="form-group">
            <label>Nama <i class="text-danger">*</i></label>
            <input name="customer_name" type="text" required class="form-control border rounded-pill">
          </div>
          <div class="form-group">
            <label>Nomor Whatsapp <i class="text-danger">*</i></label>
            <input name="customer_whatsapp" type="text" required class="form-control border rounded-pill">
          </div>
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
              <div class="form-group">
                <label>Kota/Kecamatan <i class="text-danger">*</i></label>
                <input name="customer_city" type="text" required class="form-control border rounded-pill">
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
              <div class="form-group">
                <label>Kode Pos <i class="text-danger">*</i></label>
                <input name="customer_postcode" type="text" required class="form-control border rounded-pill">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Alamat Lengkap <i class="text-danger">*</i></label>
            <textarea name="customer_address" rows="4" required class="form-control border rounded-pill"></textarea>
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
@extends('layouts.base')

@section('title', 'Checkout')

@section('content')
  @include('includes.breadcrumb', [
    'breadcrumb' => ['Checkout']
  ])

  <div class="container">
    <div class="ps-checkout">
      <div class="ps-checkout__left">
        <form class="ps-form--checkout" action="#" method="post">
          <h4>Data Pelanggan</h4>
          <div class="form-group">
            <label>Nama</label>
            <input class="form-control border rounded-pill" type="text">
          </div>
          <div class="form-group">
            <label>Nomor Whatsapp</label>
            <input class="form-control border rounded-pill" type="text">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control border rounded-pill" rows="4"></textarea>
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
        </form>
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
              Total <strong class="cart-subtotal">$48.00</strong>
            </p>
          </div>
          <div class="ps-block__payment-methond">
            <div class="ps-radio">
              <input class="form-control" type="radio" id="order-1" name="order"/>
              <label for="order-1">Direct bank transfer</label>
            </div>
            <div class="ps-radio">
              <input class="form-control" type="radio" id="order-2" name="order"/>
              <label for="order-2">Cheque Payment</label>
            </div>
            <div class="ps-radio">
              <input class="form-control" type="radio" id="order-3" name="order"/>
              <label for="order-3">Paypal <i class='fa fa-cc-mastercard'></i><i class='fa fa-cc-paypal'></i><i class='fa fa-cc-visa'></i><i class='fa fa-cc-discover'></i></label>
            </div>
          </div>
          <div class="ps-block__footer">
            <button class="ps-btn ps-btn--fullwidth">Place Order</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
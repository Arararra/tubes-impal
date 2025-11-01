@extends('layouts.base')

@section('title', 'Status Pesanan')
@section('customStyles')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
@endsection

@section('content')
  @include('includes.breadcrumb', [
    'breadcrumb' => ['Status Pesanan']
  ])
  
  <div class="ps-section ps-home-about">
    <div class="container">
      <form method="GET" action="{{ url()->current() }}" class="row align-items-center mb-3">
        <div class="col-12 col-md-6 col-lg-5">
          <label for="whatsapp" class="h3 mb-10">Nomor Whatsapp <i class="text-danger">*</i></label>
          <div class="form-group position-relative">
            <input class="border form-control rounded-pill ps-4 pe-5" type="text" name="whatsapp" placeholder="Masukkan nomor whatsapp..."
              value="{{ request('whatsapp') }}" required>
            <i class="fa fa-whatsapp position-absolute" style="right: 3rem; top: 50%; transform: translate(0, -50%);"></i>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
          <label for="invoice" class="h3 mb-10">Invoice <i class="text-danger">*</i></label>
          <div class="form-group position-relative">
            <input class="border form-control rounded-pill ps-4 pe-5" type="text" name="invoice" placeholder="Masukkan resi..."
              value="{{ request('invoice') }}" required>
            <i class="fa fa-file-text-o position-absolute" style="right: 3rem; top: 50%; transform: translate(0, -50%);"></i>
          </div>
        </div>
        <div class="col-12 col-lg-2">
          <button type="submit" class="ps-btn ps-btn--dark w-100">Cari</button>
        </div>
      </form>
    </div>
  </div>

  <div class="ps-section ps-home-about pt-0">
    <div class="container">
      <div class="card card-body border mb-25 p-5 rounded-pill">
        @if ($order != [] && Request::get('whatsapp') == $whatsapp)
          <div class="ps-form--checkout">
            <h4 class="mb-4 text-uppercase text-center">Data Pelanggan</h4>
            <div class="row text-left">
              <div class="col-md-4 mb-3">
                <label>Nama</label>
                <div class="border rounded p-3 bg-light">{{ $order['customer_name'] }}</div>
              </div>
              <div class="col-md-4 mb-3">
                <label>Nomor Whatsapp</label>
                <div class="border rounded p-3 bg-light">{{ $order['customer_whatsapp'] }}</div>
              </div>
              <div class="col-md-4 mb-3">
                <label>Alamat Lengkap</label>
                <div class="border rounded p-3 bg-light">{{ $order['customer_address'] }}</div>
              </div>
            </div>

            <hr class="my-4">

            <h4 class="mb-3 text-uppercase text-center">Detail Pesanan</h4>
            <div class="table-responsive text-left">
              <table class="table table-bordered align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order['products'] as $product)
                    <tr>
                      <td>{{ $product['name'] }}</td>
                      <td class="text-center">{{ $product['quantity'] }}</td>
                      <td class="text-end">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                      <td class="text-end">Rp {{ number_format($product['subtotal'], 0, ',', '.') }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot class="table-light">
                  <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th class="text-end">Rp {{ number_format($order['total'], 0, ',', '.') }}</th>
                  </tr>
                </tfoot>
              </table>
            </div>

            <hr class="my-4">

            <div class="row text-md-left">
              <div class="order-0 order-md-0 col-6 col-md-3"><strong>Resi:</strong></div>
              <div class="order-2 order-md-0 col-6 col-md-9 mb-10 mb-md-0">{{ $order['receipt'] }}</div>

              <div class="order-1 order-md-0 col-6 col-md-3"><strong>Resi Kurir:</strong></div>
              <div class="order-3 order-md-0 col-6 col-md-9 mb-10 mb-md-0">{{ $order['shipping_receipt'] ?? '-' }}</div>

              <div class="order-4 order-md-0 col-6 col-md-3"><strong>Status:</strong></div>
              <div class="order-6 order-md-0 col-6 col-md-9">
                <span class="badge rounded-pill 
                  {{ $order['status'] === 'Processing' ? 'bg-warning text-dark' : 
                    ($order['status'] === 'Shipped' ? 'bg-info text-white' : 
                    ($order['status'] === 'Delivered' ? 'bg-success' : 'bg-secondary')) }}" style="font-size: 90%">
                  {{ $order['status'] }}
                </span>
              </div>

              <div class="order-5 order-md-0 col-6 col-md-3"><strong>Tanggal Pembayaran:</strong></div>
              <div class="order-7 order-md-0 col-6 col-md-9">{{ $order['paid_date'] ?? '-' }}</div>
            </div>
          </div>
        @elseif ($order != [] || Request::get('whatsapp') != $whatsapp)
          <h4 class="text-center mb-0">Pesanan tidak ditemukan untuk resi {{ Request::get('invoice') }}</h4>
        @else
          <h4 class="text-center mb-0">Masukkan nomor whatsaap dan resi untuk menampilkan status pesanan</h4>
        @endif
      </div>
    </div>
  </div>
@endsection

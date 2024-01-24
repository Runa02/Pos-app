@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Order History</h4>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <p>Belum memiliki order, silahkan checkout barang terlebih dahulu.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->produk->nama_produk }}</td>
                                        <td>
                                            <span class="badge {{ $order->status === 'Menunggu' ? 'bg-warning' : ($order->status === 'Terkirim' ? 'bg-success' : '') }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

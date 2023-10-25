@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role_id == 'bank')
        <div class="col md-14">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                          <h3 class="fw-bold">Saldo Total</h3>
                            Rp. {{number_format($saldo)}}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header dw-bold">
                            Jumlah Nasabah
                        </div>
                        <div class="card-body d-flex justify-content-between">
                            {{ $nasabah }}
                            <a href="" class="bi bi-person-fill-up" ></a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header dw-bold">
                            Jumlah Transaksi
                        </div>
                        <div class="card-body">
                            {{ $transactions }}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <table class="table table-bordered table-striped mt-5 ">
                    <thead>
                        <tr>
                            <th class="col-3">No</th>
                            <th class="col-3">Nama Nasabah</th>
                            <th class="col-4">Permintaan Saldo</th>
                            <th class="col-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($request_topup as $request)
                        <tr>
                            <td>1</td>
                            <td>{{$request->user->username}}</td>
                            <td>{{$request->credit}}</td>
                            <td>
                                <form action="{{ route('request_topup') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $request->id}}">
                                    <button type="submit" class="btn p-0" style="font-size: 23px">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @if (Auth::user()->role_id == 'siswa')
        <div class="container">
            <span style="font-size: 20px">
                Saldo anda: 
                <span class="fw-bold" >
                    {{number_format($saldo,2)}}
                </span>
                <!-- Button trigger modal -->
                <button type="button" class="btn bi bi-plus-circle p-0" style="font-size: 20px; color:blue" data-bs-toggle="modal" data-bs-target="#exampleModal">
                </button>
                    <!-- Modal -->
                    <form method="POST" action="{{route('topUpNow')}}">
                        @csrf
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Nominal Top Up</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="number" name="credit" min="10000" value="10000" id="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Top Up Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </span>
        </div>
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success mt-2" role="alert">
                    {{session('status')}}
                </div>
            @endif
            <div class="row mt-4">
             @foreach ($products as $key => $product )
                <div class="col-4 mb-4">
                    <form method="POST" action="{{route('addToCart')}}">
                     @csrf
                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                        <input type="hidden" value="{{$product->price}}" name="price">
                          <div class="card">
                              <img src="{{$product->photo}}" style="width: 100%; height: 200px"/>      
                            <div class="card-body">
                                <div class="fw-bold "  >{{$product->name}}</div>
                                <div>{{$product->desc}}</div>
                                <div class=" d-flex justify-content-start" style="color:crimson">Rp: {{number_format($product->price)}}</div>
                                <div class=" row d-flex justify-content-between mt-3">
                                    <div class="col-5">
                                        <input class="form-control" type="number" name="quantity" value="1" min="0">
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <button  type="submit" class="btn btn-primary btn-sm">+ AddToCart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>    
            @endforeach
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Mata keranjang
            </div>
            <div class="card-body">
                <ul>
                    @foreach($carts as $key => $cart)
                        <li>{{$cart->product->name}} | {{$cart->price}} x {{$cart->quantity}}</li>
                    @endforeach
                </ul>
                Total Biaya: {{number_format($total_biaya)}}
            </div>
            <div class="card-footer">
                <form action="{{route('payNow')}}" method="POST">
                    <div class="d-grid gap-2">
                        @csrf
                        <button class="btn btn-success" type="submit">Bayar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-3 mt-3">
            <div class="card-header">
                Riwayat Transaksi
            </div>
            <div class="card-body">
            @foreach ($transactions as $key => $transaction )    
                <div class="row mb-3">
                    <div class="col">
                        <div class="row">
                            <div class="col fw-bold">
                                {{$transaction[0]->order_id}}
                            </div>
                            <div class="row">
                                <div class="col text-secondary" style="font-size: 12px">
                                      {{$transaction[0]->created_at}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <a class="btn btn-success" 
                        href="{{route('download', ['order_id' => $transaction[0]->order_id])}}"
                        target="_blank"
                        >Download</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card md-3 mt-3">
            <div class="card-header">
                Mutasi Dompet
            </div>
            <div class="card-body">
                <ul>
                    @foreach ( $mutasi as $data )
                        <li>{{$data->credit ? $data->credit: 'Debit'}} | {{$data->debit ? $data->debit : 'kredit'}}
                        | {{$data->description}}<span class="badge text-bg-warning">{{$data->status == 'proses' ? 'PROSES' : ''}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endif
@endsection

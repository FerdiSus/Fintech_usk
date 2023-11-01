@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role_id == 'kantin') 
        <div class="col-8">
            @if (session('status'))
                <div class="alert alert-success mt-2" role="alert">
                    {{session('status')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-start align-items-center">
                            Welcome, {{Auth::user()->name}}
                        </div>
                        <div class="col d-flex justify-content-end align-items-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProduct">
                                Tambah Produk
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="tambahProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="">Price</label>
                                                        <input type="number" name="price" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label for="">Stock</label>
                                                        <input type="number" name="stock" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="mb-3">
                                                        <label for="">Stand</label>
                                                        <input type="number" name="stand" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="">Category</label>
                                                        <select name="category_id" class="form-select">
                                                            <option value="">-- Pilih Opsi --</option>
                                                            @foreach ($categories as $category )
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Description</label>
                                                <textarea name="desc" class="form-control"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Photo</label>
                                                <input type="file" name="photo" class="form-control">
                                            </div>
                                            {{-- <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Tambah Product</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($products as $key => $product )
                            <div class="col-4 mb-4">
                                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <input type="hidden" value="{{$product->price}}" name="price">
                                      <div class="card">
                                          <img src="{{$product->photo}}" style="width: 100%; height: 200px"/>      
                                        <div class="card-body">
                                            <div class="fw-bold "  >{{$product->name}}</div>
                                            <div>{{$product->desc}}</div>
                                            <div class=" d-flex justify-content-start" style="color:crimson">Rp: {{number_format($product->price)}}</div>
                                            <div class=" d-flex justify-content-start">Katgori: {{($product->category->name)}}</div>
                                        </div>
                                        <div class="row mt-2 mx-1 mb-2">
                                            <div class="col">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProduk-{{ $product->id}}">
                                                    Edit
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="editProduk-{{ $product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('product.update',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="">Name</label>
                                                                            <input type="text" name="name" class="form-control" value="{{$product->name}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="">Price</label>
                                                                            <input type="number" name="price" class="form-control" value="{{$product->price}}" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <div class="mb-3">
                                                                            <label for="">Stock</label>
                                                                            <input type="number" name="stock" class="form-control" value="{{$product->stock}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <div class="mb-3">
                                                                            <label for="">Stand</label>
                                                                            <input type="number" name="stand" class="form-control" value="{{$product->stand}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="">Category</label>
                                                                            <select name="category_id" class="form-select">
                                                                                <option value="">-- Pilih Opsi --</option>
                                                                                @foreach ($categories as $category ) 
                                                                                    <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>
                                                                                        {{$category->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="">Description</label>
                                                                    <textarea name="desc" class="form-control">{{$product->desc}}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="">Photo</label>
                                                                    <input type="file" name="photo" class="form-control" value="{{$product->photo}}">
                                                                </div>
                                                                {{-- <div class="d-grid gap-2">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div> --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col text-end">                                            
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusProduct-{{$product->id}}">
                                                    Hapus
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="hapusProduct-{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Product</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('product.destroy',['id'=>$product->id])}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        <div class="modal-body">
                                                            Apakah Anda yakin menghapus Produk ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>    
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-header">
                    Request Pengambilan Pesanan
                </div>
                <div class="card-body">
                        @foreach($transactions as $key => $transaction)
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{$transaction->user->name}}
                                </div>
                                <div class="card-body">
                                    {{$transaction->product->name}} x {{$transaction->quantity}} | Stand {{$transaction->product->stand}}
                                </div>
                                <div class="card-footer">
                                    <form action="{{route('transaction.take',['id'=>$transaction->id])}}" method="POST">
                                        <div class="d-grid gap-2">
                                            @csrf
                                            <button class="btn btn-success" type="submit">Sudah Diambil</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
        @endif
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
                            {{$nasabah}}
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
                                <div>Stok: {{$product->stock}}</div>
                                <div class=" row d-flex justify-content-between mt-3">
                                    <div class="col-5">
                                        <input class="form-control" type="number" name="quantity" value="1" min="1">
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
                    @foreach($carts as $key => $cart)
                    <form action="{{route('DeleteCart',['id'=>$cart->id])}}" method="POST">
                        @csrf
                        @method('delete')
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    @if ($cart->product->stock <= 0)
                                     <s>   
                                    @endif
                                    {{$cart->product->name}} | {{number_format($cart->price)}} x {{$cart->quantity}}
                                    @if ($cart->product->stock <= 0)
                                     </s>
                                    @endif
                                </div>
                                <div class="col text-end">
                                        <button class="btn btn-danger btn-sm p-1 "><i  class="bi bi-trash3"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endforeach
                    <span style="color:crimson">
                        Total Biaya: {{number_format($total_biaya)}}
                    </span>    
                </div>
                <div class="card-footer">
                    <form action="{{route('payNow')}}" method="POST">
                        <div class="d-grid gap-2">
                            @csrf
                            <button class="btn {{$saldo < $total_biaya  ? 'btn-secondary' : 'btn-success'}}" type="submit">Bayar Sekarang</button>
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
@endif
@endsection

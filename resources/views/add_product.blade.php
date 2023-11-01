@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role_id == 'kantin') 
        @if (session('status'))
            <div class="alert alert-success mt-2" role="alert">
                 {{session('status')}}
            </div>
         @endif
        <div class="col-2">
            <div class="card">
                <div class="card-header">
                    menu
                </div>
                <div class="card-body">
                
                </div>
            </div>
        </div>
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    AddProduct
                </div>
                <div class="card-body">
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
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                 </form>
                </div>
            </div>
        </div>
        @endif
@endsection

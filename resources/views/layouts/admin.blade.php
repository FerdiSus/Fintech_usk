@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role_id == 'admin')
        @if (session('status'))
        <div class="alert alert-success mt-2" role="alert">
            {{session('status')}}
        </div>
         @endif
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    @include('components.sideBar_add')
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                <div class="row">
                    <div class="col d-flex justify-content-between align-items-center">
                            @yield('admin-title')

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUser">
                                Tambah
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('user.store')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                     </div>
                                     <div class="mb-3">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username" required>
                                     </div>
                                     <div class="mb-3">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                     </div>
                                     <div class="mb-3">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" required>
                                     </div>
                                     <div class="mb-3">
                                        <label for="">Role</label>
                                        <select name="role" class="form-select" required>
                                            <option value="">--pilih opsi--</option>                                            
                                                <option value="admin">Admin</option>
                                                <option value="kantin">Kantin</option>
                                                <option value="bank">Bank</option>
                                                <option value="siswa">Siswa</option>
                                        </select>
                                     </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                 </form>
                                </div>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    @yield('admin-content')
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
@endsection
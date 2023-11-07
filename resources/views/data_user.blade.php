@extends('layouts.admin')

@section('admin-title')
    Data User
@endsection()
@section('admin-content')
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role_id }}</td>
                    <td>
                        <a href="" class="btn btn-warning">Edit</a>
                         <!-- Button trigger modal -->
                         <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusUser-{{$user->id}}">
                            Hapus
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="hapusUser-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus user</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus Akun ini?    
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('user.destroy',['user' => $user->id])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
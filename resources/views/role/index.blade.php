@extends('layouts.master')

@section('web-content')
    <div class="container my-4">
        <h2 class="mb-4">Data Role</h2>

        <!-- Search Bar -->
        <div class="d-flex justify-content-between">
           <div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input id="searchInput" type="text" class="form-control" placeholder="Pencarian">
                </div>
           </div>
            <a href="{{ route('role.create') }}" class="button"><button type="button" class="btn btn-primary">Tambah Role</button></a> 
        </div>
        
        
        <div class="card p-2">
            <table class="table table-bordered table-striped text-center align-items-center" id="myTable">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nama Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($roles->isEmpty())
                        <tr>
                            <td colspan="3"><h3>Tidak Ada Data</h3></td>
                        </tr>
                    @else
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id_role}}</td>
                            <td>{{ $role->nama_role}}</td>
                            <td>
                                <a href="{{ route('role.edit', ['role' => $role->id_role]) }}" class="button"><button type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                <a href="{{ route('role.delete', ['role' => $role->id_role]) }}" class="button button-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                    <button type="button" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

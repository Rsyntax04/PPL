@extends('layouts.master')

@section('web-content')
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h1>Edit Golongan</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                </div>
            @endif
            <div class="card-body">
                <form method="post" action="{{ route('role.update', ['role' => $roles->id_role]) }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_role">ID</label>
                        <input type="text" class="form-control" id="id_role" name="id_role" value="{{$roles->id_role }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_role">Nama role</label>
                        <input type="text" class="form-control" id="nama_role" name="nama_role" value="{{$roles->nama_role }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('role.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

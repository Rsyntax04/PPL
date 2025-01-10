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
                <form method="post" action="{{ route('jabatan.update', ['jabatan' => $jabatans->id_jabatan]) }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_jabatan">ID</label>
                        <input type="text" class="form-control" id="id_jabatan" name="id_jabatan" value="{{$jabatans->id_jabatan }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{$jabatans->nama_jabatan }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('jabatan.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

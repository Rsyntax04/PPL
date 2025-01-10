@extends('layouts.master')

@section('web-content')
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h1>Edit Departemen</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                </div>
            @endif
            <div class="card-body">
                <form method="post" action="{{ route('departemen.update', ['departemen' => $departemens->id_departemen]) }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_departemen">ID</label>
                        <input type="text" class="form-control" id="id_departemen" name="id_departemen" value="{{$departemens->id_departemen }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_departemen">Nama departemen</label>
                        <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" value="{{$departemens->nama_departemen }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('departemen.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('web-content')
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h1>Edit Golongan</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('golongan.update', ['golongan' => $golongans->id_golongan])}}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_golongan">ID</label>
                        <input type="text" class="form-control" id="id_golongan" name="id_golongan" value="{{ $golongans->id_golongan }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_golongan">Nama Golongan</label>
                        <input type="text" class="form-control" id="nama_golongan" name="nama_golongan" value="{{ $golongans->nama_golongan }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('golongan.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

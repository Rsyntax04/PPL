@extends('layouts.master')

@section('web-content')
    <div class="container my-4">
        <h2 class="mb-4">Data Golongan</h2>

        <!-- Search Bar -->
        <div class="d-flex justify-content-between">
           <div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input id="searchInput" type="text" class="form-control" placeholder="Pencarian">
                </div>
           </div>
            <a href="{{ route('golongan.create') }}" class="button"><button type="button" class="btn btn-primary">Tambah Golongan</button></a> 
        </div>
        
        
        <div class="card p-2">
            <table class="table table-bordered table-striped text-center align-items-center" id="myTable">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nama Golongan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($golongans->isEmpty())
                        <tr>
                            <td colspan="10"><h3>Tidak Ada Data</h3></td>
                        </tr>
                    @else
                        @foreach ($golongans as $golongan)
                        <tr>
                            <td>{{ $golongan->id_golongan }}</td>
                            <td>{{ $golongan->nama_golongan }}</td>
                            <td>
                                <a href="{{ route('golongan.edit', ['golongan'=>$golongan->id_golongan]) }}" class="button"><button type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                <a href="{{ route('golongan.delete', ['golongan'=>$golongan->id_golongan]) }}" class="button button-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
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

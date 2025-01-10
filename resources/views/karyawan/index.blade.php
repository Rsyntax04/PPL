@extends('layouts.master')

@section('web-content')
    <div class="container my-4">
        <h2 class="mb-4">Data Karyawan</h2>

        <!-- Search Bar -->
        <div class="d-flex justify-content-between">
           <div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input id="searchInput" type="text" class="form-control" placeholder="Pencarian">
                </div>
           </div>
            <a href="{{ route('karyawan.create') }}" class="button"><button type="button" class="btn btn-primary">Tambah Karyawan</button></a> 
        </div>
        
        
        <div class="card p-2">
            <table class="table table-bordered table-striped text-center align-items-center" id="myTable">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>Departemen</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($karyawans->isEmpty())
                        <tr>
                            <td colspan="10"><h3>Tidak Ada Data</h3></td>
                        </tr>
                    @else
                        @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->id_karyawan}}</td>
                            <td>{{ $karyawan->nama }}</td>
                            <td>{{ $karyawan->cariJabatan->nama_jabatan }}</td>
                            <td>{{ $karyawan->cariGolongan->nama_golongan }}</td>
                            <td>{{ $karyawan->cariDepartemen->nama_departemen }}</td>
                            <td>{{ $karyawan->alamat }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->no_telepon }}</td>
                            <td>{{ $karyawan->cariRole->nama_role }}</td>
                            <td>
                                <a href="{{ route('karyawan.edit', ['karyawan'=>$karyawan->id_karyawan]) }}" class="button"><button type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                <a href="{{ route('karyawan.delete', ['karyawan'=>$karyawan->id_karyawan]) }}" class="button button-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
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

@section('spc-js')
    <script src="{{URL::asset('js/searchBar.js')}}"></script>
@endsection

@extends('layouts.master')

@section('web-content')
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h1>Edit Karyawan</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ implode('', $errors->all(':message')) }}
                </div>
            @endif
            <div class="card-body">
                <form method="post" action="{{ route('karyawan.update', ['karyawan' => $karyawans->id_karyawan]) }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_karyawan">ID</label>
                        <input type="text" class="form-control" id="id_karyawan" name="id_karyawan"
                            value="{{ $karyawans->id_karyawan }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="departemen">Departemen :</label>
                        <select id="departemen" name="departemen" class="form-control" required>
                            <option class="text-secondary">Masukan Departemen</option>
                            @foreach ($departemens as $departemen)
                                @if ($departemen->id_departemen == $karyawans->departemen)
                                    <option selected value="{{ $departemen->id_departemen }}">
                                        {{ $departemen->id_departemen }}
                                        - {{ $departemen->nama_departemen }}</option>
                                @else
                                    <option value="{{ $departemen->id_departemen }}">{{ $departemen->id_departemen }}
                                        - {{ $departemen->nama_departemen }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jabatan">Jabatan :</label>
                        <select id="jabatan" name="jabatan" class="form-control" required>
                            <option class="text-secondary">Masukan Jabatan</option>
                            @foreach ($jabatans as $jabatan)
                                @if ($jabatan->id_jabatan == $karyawans->jabatan)
                                    <option selected value="{{ $jabatan->id_jabatan }}">{{ $jabatan->id_jabatan }}
                                        - {{ $jabatan->nama_jabatan }}</option>
                                @else
                                    <option value="{{ $jabatan->id_jabatan }}">{{ $jabatan->id_jabatan }}
                                        - {{ $jabatan->nama_jabatan }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="role">Role :</label>
                        <select id="role" name="role" class="form-control" required>
                            <option class="text-secondary">Masukan Role</option>
                            @foreach ($roles as $role)
                                @if ($role->id_role == $karyawans->role)
                                    <option selected value="{{ $role->id_role }}">{{ $role->id_role }}
                                        - {{ $role->nama_role }}</option>
                                @else
                                    <option value="{{ $role->id_role }}">{{ $role->id_role }}
                                        - {{ $role->nama_role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="golongan">Golongan :</label>
                        <select id="golongan" name="golongan" class="form-control" required>
                            <option class="text-secondary">Masukan Golongan</option>
                            @foreach ($golongans as $golongan)
                                @if ($golongan->id_golongan == $karyawans->golongan)
                                    <option selected value="{{ $golongan->id_golongan }}">
                                        {{ $golongan->id_golongan }}-{{ $golongan->nama_golongan }}</option>
                                @else
                                    <option value="{{ $golongan->id_golongan }}">
                                        {{ $golongan->id_golongan }}-{{ $golongan->nama_golongan }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ $karyawans->nama }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat :</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            value="{{ $karyawans->alamat }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $karyawans->email }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password :</label>
                        <input type="text" class="form-control" id="password" name="password"
                            value="{{ $karyawans->password }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_telepon">No Telepon :</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                            value="{{ $karyawans->no_telepon }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('web-content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h1>Tambah Karyawan</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('karyawan.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="departemen">Departemen :</label>
                        <select id="departemen" name="departemen" class="form-control" required>
                            <option class="text-secondary">Masukan Departemen</option>
                            @foreach ($departemens as $departemen)
                                <option value="{{$departemen->id_departemen}}">{{$departemen->id_departemen}}-{{$departemen->nama_departemen}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jabatan">Jabatan :</label>
                        <select id="jabatan" name="jabatan" class="form-control" required>
                            <option class="text-secondary">Masukan Jabatan</option>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{$jabatan->id_jabatan}}">{{$jabatan->id_jabatan}}-{{$jabatan->nama_jabatan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="role">Role :</label>
                        <select id="role" name="role" class="form-control" required>
                            <option class="text-secondary">Masukan Role</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id_role}}">{{$role->id_role}}-{{$role->nama_role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="golongan">Golongan :</label>
                        <select id="golongan" name="golongan" class="form-control" required>
                            <option class="text-secondary">Masukan Golongan</option>
                            @foreach ($golongans as $golongan)
                                <option value="{{$golongan->id_golongan}}">{{$golongan->id_golongan}}-{{$golongan->nama_golongan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat :</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password :</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_telepon">No Telepon :</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                    </div>
                    <input type="hidden" id="unique_face_id" name="unique_face_id">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </form>

                <hr class="my-4">

                <!-- Enroll Unique Face ID -->
                <button onclick="enrollNewUser()" class="btn btn-success">Enroll New User</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.faceio.net/fio.js"></script>
    <script type="text/javascript">
        const faceio = new faceIO("fioa2994");

        function enrollNewUser() {
            faceio.enroll({
                "locale": "auto",
                "payload": {
                    "whoami": 123456,
                    "email": document.getElementById('email').value
                }
            }).then(userInfo => {
                alert(`Enroll berhasil! Details:\nUnique Facial ID: ${userInfo.facialId}`);
                document.getElementById('unique_face_id').value = userInfo.facialId;
            }).catch(error => {
                console.error(error);
                alert("Enroll gagal.");
            });
        }
    </script>
@endsection

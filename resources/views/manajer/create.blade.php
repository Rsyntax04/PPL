@extends('layouts.master')

@section('web-content')
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title">List Pegawai</h5>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ implode('', $errors->all(':message')) }}
            </div>
        @endif
        <form action="{{ route('pencatatan.store') }}" method="POST">
            @csrf
            <!-- Absen semua -->
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <div class="m-2">
                        <h4>Tandai Semua Pegawai</h4>
                    </div>
                    <div class="d-flex m-2">
                        <button type="button" class="btn btn-outline-primary mx-1"
                            onclick="toggleButton('Hadir')">Hadir</button>
                        <button type="button" class="btn btn-outline-warning mx-1"
                            onclick="toggleButton('Telat')">Telat</button>
                        <button type="button" class="btn btn-outline-danger mx-1"
                            onclick="toggleButton('Absen')">Absen</button>
                    </div>
                </div>
                <div class="m-2">
                    <input class="btn btn-primary" type="submit" value="Kirim">
                </div>
            </div>
            <!-- Perhitungan kehadiran -->
            <div class="d-flex justify-content-center m-3">
                <div class="m-1 mt-3">
                    <h4>Total</h4>
                </div>
                <div class="d-flex m-3">
                    <span class="border border-primary mx-1 p-2 rounded" id="totalHadir">0 Hadir</span>
                    <span class="border border-warning mx-1 p-2 rounded" id="totalTelat">0 Telat</span>
                    <span class="border border-danger mx-1 p-2 rounded" id="totalAbsen">0 Absen</span>
                </div>
            </div>
            <!-- Tabel absensi -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $karyawan)
                            <tr>
                                <td>
                                    <strong>{{ $karyawan->id_karyawan }}</strong><br>
                                    <span class="grey-text">Nama : {{ $karyawan->nama }}</span>
                                    <br>
                                    <span class="grey-text">Email : {{ $karyawan->email }}</span>
                                    <!-- Tambahkan input hidden untuk mengirim id_karyawan -->
                                    <input type="hidden" name="attendance[{{ $karyawan->id_karyawan }}][id_karyawan]"
                                        value="{{ $karyawan->id_karyawan }}">
                                </td>
                                <td>
                                    <input type="radio" class="btn-check"
                                        name="attendance[{{ $karyawan->id_karyawan }}][status]"
                                        id="hadir{{ $karyawan->id_karyawan }}" value="Hadir" autocomplete="off"
                                        onclick="countTotals()">
                                    <label class="btn btn-outline-primary mx-1"
                                        for="hadir{{ $karyawan->id_karyawan }}">Hadir</label>

                                    <input type="radio" class="btn-check"
                                        name="attendance[{{ $karyawan->id_karyawan }}][status]"
                                        id="telat{{ $karyawan->id_karyawan }}" value="Telat" autocomplete="off"
                                        onclick="countTotals()">
                                    <label class="btn btn-outline-warning mx-1"
                                        for="telat{{ $karyawan->id_karyawan }}">Telat</label>

                                    <input type="radio" class="btn-check"
                                        name="attendance[{{ $karyawan->id_karyawan }}][status]"
                                        id="absen{{ $karyawan->id_karyawan }}" value="Absen" autocomplete="off"
                                        onclick="countTotals()">
                                    <label class="btn btn-outline-danger mx-1"
                                        for="absen{{ $karyawan->id_karyawan }}">Absen</label>
                                </td>
                                <td>
                                    <i class="bi bi-envelope notes-icon"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection



@section('spc-js')
    <script>
        function toggleButton(value) {
            // Mencari semua radio button dengan value yang sesuai
            const radioButtons = document.querySelectorAll(`input[type="radio"][value="${value}"]`);

            // Memilih semua radio button dengan value yang sesuai
            radioButtons.forEach(radio => {
                radio.checked = true;
            });

            // Menghitung total setelah memilih
            countTotals();
        }

        function countTotals() {
            const totalHadir = document.querySelectorAll(`input[type="radio"][value="Hadir"]:checked`).length;
            const totalTelat = document.querySelectorAll(`input[type="radio"][value="Telat"]:checked`).length;
            const totalAbsen = document.querySelectorAll(`input[type="radio"][value="Absen"]:checked`).length;

            // Menampilkan total di bagian Total
            document.getElementById('totalHadir').textContent = `${totalHadir} Hadir`;
            document.getElementById('totalTelat').textContent = `${totalTelat} Telat`;
            document.getElementById('totalAbsen').textContent = `${totalAbsen} Absen`;

            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', countTotals);
            });
        }
    </script>
@endsection

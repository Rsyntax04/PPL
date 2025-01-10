@extends('layouts.master')

@section('web-content')
<div class="container my-4">
    <h2 class="mb-4">Catatan Kehadiran</h2>

    <!-- Search Bar -->
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input id="searchInput" type="text" class="form-control" placeholder="Cari Karyawan">
    </div>

    <!-- Attendance Table -->
    <div class="table-responsive">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <div class="card p-2">
            <table class="table table-bordered tabel-striped text-center align-items-center" id="myTable">
                <thead class="table-primary">
                    <tr>
                        <th>Karyawan</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Jenis Presensi</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($absensiAll->isEmpty())
                    <tr>
                        <td colspan="10"><h3>Tidak Ada Data</h3></td>
                    </tr>
                    @else
                        @foreach($absensiAll as $absen)
                        <tr>
                            <td>{{$absen->id_karyawan}}</td>
                            <td>{{$absen->waktu_masuk}}</td>
                            <td>{{$absen->waktu_keluar}}</td>
                            <td>{{$absen->jenis_presensi}}</td>
                            @if($absen->status == 'Hadir')
                                <td class="bg-success text-white">
                                        {{$absen->status}}
                                </td>
                            @elseif($absen->status == 'Telat')
                            <td class="bg-warning text-white">
                                {{$absen->status}}
                            </td>
                            @elseif($absen->status == 'Absen')
                            <td class="bg-danger text-white">
                                {{$absen->status}}
                            </td>
                            @else
                                <td>{{$absen->status}}</td>
                            @endif
                            @if($absen->approval == 1)
                                <td class="bg-success text-white">Disetujui</td>
                            @elseif($absen->approval == 0)
                                <td class="bg-danger text-white">Tidak Disetujui</td>
                            @else
                                <td>{{$absen->approval}}</td>
                            @endif          
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('spc-js')
    <script src="{{ asset('js/searchBar.js') }}"></script>
@endsection
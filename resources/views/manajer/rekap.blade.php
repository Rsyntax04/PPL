@extends('layouts.master')

@section('web-content')
  <!-- Main Content -->
  <div class="container-fluid">
    <div class="col dashboard p-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <h4>Laporan Kehadiran Tim</h4>
          <button class="btn btn-primary"><a href="{{route('laporanAbsensi')}}" class="text-decoration-none text-white"><i class="bi bi-arrow-left"></i>&nbsp;Back</a></button>
        </div>
      <div class="card">
        <div class="card-body">
          <!-- Grafik -->
          <div class="d-flex mb-3">
            <div class="chart d-flex">
              <div class="progress-ring-container d-flex align-items-center justify-content-center">
                <svg class="progress-ring" viewBox="0 0 100 100">
                  <!-- Background Circle -->
                  <circle cx="50" cy="50" r="45" fill="transparent" stroke="#e9ecef" stroke-width="10"></circle>
                  <!-- Absen Section -->
                  <circle class="absen-ring" cx="50" cy="50" r="45" fill="transparent" stroke="#dc3545" stroke-width="10" stroke-dasharray="0 283"></circle>
                  <!-- Telat Section -->
                  <circle class="telat-ring" cx="50" cy="50" r="45" fill="transparent" stroke="#ffc107" stroke-width="10" stroke-dasharray="0 283"></circle>
                  <!-- Hadir Section -->
                  <circle class="hadir-ring" cx="50" cy="50" r="45" fill="transparent" stroke="#28a745" stroke-width="10" stroke-dasharray="0 283"></circle>
                </svg>
                <h5 class="mt-2">{{$totalEmployees}} Data</h5>
              </div>
            </div>
            <!-- Kehadiran Ringkasan -->
            <div class="m-4 mt-5">
              <div class="d-flex align-items-center">
                <i class="bi bi-circle-fill text-danger"></i>
                <span class="ms-2">{{$absenCount}} Absen</span>
              </div>
              <div class="d-flex align-items-center">
                <i class="bi bi-circle-fill text-warning"></i>
                <span class="ms-2">{{$telatCount}} Terlambat</span>
              </div>
              <div class="d-flex align-items-center">
                <i class="bi bi-circle-fill text-success"></i>
                <span class="ms-2">{{$hadirCount}} Hadir</span>
              </div>
            </div>
            <!-- Persenan kehadiran -->
            <div class="m-4 ms-3">
              <h1 class="display-3 text-primary" id="persentaseKehadiran">0 %</h1>
              <p class="text-muted">Persentase Kehadiran Total</p>
            </div>
          </div>
          
          <!-- search bar -->
          <div class="input-group mb-3">
            <div class="col-12 col-md-8"> 
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input id="searchInput" type="text" class="form-control" placeholder="Cari Karyawan">
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            {{-- Input Tanggal --}}
            <div class="col-12 col-md-8 d-flex flex-wrap align-items-center gap-3"> 
              <div class="flex-grow-1">
                <label for="startDate" class="form-label">Tanggal Awal</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                  <input id="startDate" name="start_date" type="date" class="form-control" 
                         value="{{ request('startDate') }}" placeholder="Filter Tanggal">
                </div>
              </div>
              <div class="flex-grow-1">
                <label for="endDate" class="form-label">Tanggal Akhir</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                  <input id="endDate" name="end_date" type="date" class="form-control" 
                         value="{{ request('endDate') }}" placeholder="Filter Tanggal">
                </div>
              </div>
            </div>

            <div class="d-flex align-items-end mt-3 ms-2">
              <button class="btn btn-primary me-2 rounded" onclick="applyFilter()">
                <i class="bi bi-funnel-fill"></i> Filter
              </button>
              <button class="btn btn-secondary rounded" onclick="resetFilter()">
                <i class="bi bi-arrow-repeat"></i> Reset
              </button>
            </div>
          </div>          
          
          <!-- Attendance Table -->
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mt-4" id="myTable">
              <thead class="bg-light">
                  <tr>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Total Kehadiran</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($absensis as $absensi)
                  <tr>
                    <td>
                      {{ date('l, j F', strtotime($absensi->waktu_masuk)) }}
                    </td>
                    <td>
                      <a class="text-decoration-none text-dark" href="{{route('laporanAbsensi',['id'=>$absensi->id_karyawan])}}">
                         {{$absensi->karyawan->nama}} 
                      </a>
                    </td>
                    <td>
                      @if ($absensi->status === 'Hadir')
                          <i class="bi bi-circle-fill text-success"></i>
                      @elseif ($absensi->status === 'Telat')
                          <i class="bi bi-circle-fill text-warning"></i>
                      @else
                          <i class="bi bi-circle-fill text-danger"></i>
                      @endif
                      {{ $absensi->status }}</td>
                      <td>
                        @php
                          $rekap = $rekapKaryawan[$absensi->id_karyawan] ?? ['Hadir' => 0, 'Telat' => 0, 'Absen' => 0, 'Total' => 0];
                        @endphp
                        Hadir: {{ $rekap['Hadir'] }}
                      </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="attendanceData" 
  data-hadir="{{ $hadirCount }}" 
  data-telat="{{ $telatCount }}" 
  data-absen="{{ $absenCount }}" 
  data-total="{{ $totalEmployees }}">
@endsection

@section('spc-js')
  <script src="{{ asset('js/searchBar.js') }}"></script>
  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Ambil data dari HTML
      const attendanceData = document.getElementById("attendanceData");
      const hadirCount = parseInt(attendanceData.dataset.hadir);
      const telatCount = parseInt(attendanceData.dataset.telat);
      const absenCount = parseInt(attendanceData.dataset.absen);
      const totalEmployees = parseInt(attendanceData.dataset.total);
      // Perimeter lingkaran
      const radius = 45;
      const circumference = 2 * Math.PI * radius;
      // Hitung persentase
      const hadirPercent = totalEmployees > 0 ? (hadirCount / totalEmployees) * 100 : 0;
      const telatPercent = totalEmployees > 0 ? (telatCount / totalEmployees) * 100 : 0;
      const absenPercent = totalEmployees > 0 ? (absenCount / totalEmployees) * 100 : 0;
      // Hitung dasharray untuk masing-masing kategori
      const hadirDash = (hadirPercent / 100) * circumference;
      const telatDash = (telatPercent / 100) * circumference;
      const absenDash = (absenPercent / 100) * circumference;
      // Update SVG
      const hadirRing = document.querySelector(".hadir-ring");
      const telatRing = document.querySelector(".telat-ring");
      const absenRing = document.querySelector(".absen-ring");
      hadirRing.setAttribute("stroke-dasharray", `${hadirDash} ${circumference - hadirDash}`);
      telatRing.setAttribute("stroke-dasharray", `${telatDash} ${circumference - telatDash}`);
      absenRing.setAttribute("stroke-dasharray", `${absenDash} ${circumference - absenDash}`);
      // Atur posisi masing-masing bagian
      hadirRing.setAttribute("stroke-dashoffset", `0`);
      telatRing.setAttribute("stroke-dashoffset", `-${hadirDash}`);
      absenRing.setAttribute("stroke-dashoffset", `-${hadirDash + telatDash}`);

      // Tampilkan di HTML
      const percentageElement = document.getElementById('persentaseKehadiran');
      percentageElement.textContent = `${hadirPercent.toFixed(2)} %`;
    });

    function applyFilter() {
      const startDate = document.getElementById('startDate').value;
      const endDate = document.getElementById('endDate').value;
      const urlParams = new URLSearchParams(window.location.search);

      if (startDate) urlParams.set('start_date', startDate);
      if (endDate) urlParams.set('end_date', endDate);

      window.location.search = urlParams.toString();
    }

    function resetFilter() {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.delete('start_date');
      urlParams.delete('end_date');
      
      window.location.search = urlParams.toString();
    }

  </script>
@endsection

@section('spc-css')
  <style>
    /* Pastikan SVG menyesuaikan dengan ukuran kontainer */
    .progress-ring-container {
      flex-direction: column;
      transform-origin: center; /* Menjaga agar transformasi terjadi dari tengah */
      transition: transform 0.3s ease-in-out; /* Animasi saat berubah ukuran */
    }

    .progress-ring {
      width: 100%; 
      height: auto; 
      max-width: 200px; 
      max-height: 200px; 
    }

  </style>
@endsection

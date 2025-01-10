@extends('layouts.master')

@section('web-content')
<div class="container my-4">
    <h2 class="mb-4">Catatan Kehadiran</h2>

    <!-- Search Bar -->
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control" placeholder="Cari Karyawan" aria-label="Cari Karyawan" aria-describedby="basic-addon1">
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
        <table class="table table-bordered text-center align-items-center">
            <thead class="table-primary">
                <tr>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Email</th>
                    <th colspan="3">Sessions</th>
                </tr>
                <tr>
                    <th>Sep 19</th>
                    <th>Sep 22</th>
                    <th>Sep 27</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nguyen Thai Uyen</td>
                    <td>21uyen.tt@vinuni.edu.vn</td>
                    <td class="bg-warning"><i class="bi bi-alarm-fill text-white"></i></td>
                    <td class="bg-danger"><b><i class="bi bi-x-lg text-white"></i></b></td>
                    <td class="bg-success"><i class="bi bi-check-lg text-white"></i></td>
                </tr>
                <tr>
                    <td>Nguyen Thai Uyen</td>
                    <td>21uyen.tt@vinuni.edu.vn</td>
                    <td class="bg-danger"><b><i class="bi bi-x-lg text-white"></i></b></td>
                    <td class="bg-warning"><i class="bi bi-alarm-fill text-white"></i></td>
                    <td class="bg-danger"><b><i class="bi bi-x-lg text-white"></i></b></td>
                </tr>
                <tr>
                    <td>Nguyen Thai Uyen</td>
                    <td>21uyen.tt@vinuni.edu.vn</td>
                    <td class="bg-success"><i class="bi bi-check-lg text-white"></i></td>
                    <td class="bg-success"><i class="bi bi-check-lg text-white"></i></td>
                    <td class="bg-success"><i class="bi bi-check-lg text-white"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
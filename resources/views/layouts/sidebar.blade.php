<div id="sidebar" class="sidebar p-0 d-flex flex-column">
    <div class="sidebar-toggler d-flex align-items-center justify-content-between p-3 pb-2 pt-2" id="toggle-btn">
        <a href="" class="text-white text-decoration-none">
            <h3>Logo</h3>
        </a>
        <i class="bi bi-list text-white"></i>
    </div>
    <ul class="nav flex-column px-3">
        @if(Auth::user()->role == 'r1')
        <li class="nav-item mb-3">
            <a class="nav-link text-white text-decoration-none" onclick="toggleDropdown()"><i class="bi bi-clipboard"></i>
                <span class="dropdown-toggle">Kategori</span></a>
            <div class="dropdown-content">
                <a href="{{ route('departemen.index') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-bank2"></i></i>
                    <span>Departemen</span></a>
                <a href="{{ route('golongan.index') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-border-all"></i>
                    <span>Golongan</span></a>
                <a href="{{ route('jabatan.index') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-diagram-2-fill"></i>
                    <span>Jabatan</span></a>
                <a href="{{ route('role.index') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-briefcase-fill"></i>
                    <span>Role</span></a>
            </div>
        </li>
        <li class="nav-item mb-3">
            <a href="{{ route('karyawan.index') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-person-fill"></i>
                <span>Karyawan</span></a>
        </li>
        @endif
        
        @if(Auth::user()->role == 'r2')
        <li class="nav-item mb-3">
            <a class="nav-link text-white text-decoration-none" onclick="toggleDropdown()"><i class="bi bi-check-circle"></i>
                <span class="dropdown-toggle">Absensi</span></a>
            <div class="dropdown-content">
                <a href="{{ route('rekapAll') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-people"></i>
                    <span>Data Absensi</span></a>
                <a href="{{ route('pencatatan.absensi') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-calendar2-check"></i>
                    <span>Kehadiran</span></a>
                <a href="{{ route('laporanAbsensi') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-calendar2-check"></i>
                    <span>Laporan Absensi</span></a>
                <a href="{{ route('qr.form') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-calendar2-check"></i>
                    <span>Generate QR</span></a>
            </div>
        </li>
        @endif
        @if(Auth::user()->role == 'r3')
        <li class="nav-item mb-3">
            <a class="nav-link text-white text-decoration-none" onclick="toggleDropdown()"><i class="bi bi-check-circle"></i>
                <span class="dropdown-toggle">Absensi</span></a>
            <div class="dropdown-content">
                <a href="{{ route('on-premise.create') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-people"></i>
                    <span>Absen Face Recognition</span></a>
                <a href="{{ route('qr.scanner') }}" class="nav-link text-white text-decoration-none"><i class="bi bi-people"></i>
                    <span>Absen Scan QR </span></a>
            </div>
        </li>
        @endif
        {{-- <li class="nav-item mb-3">
            <a href="#" class="nav-link text-white text-decoration-none"><i class="bi bi-check-circle"></i>
                <span>Kehadiran</span></a>
        </li>
        <li class="nav-item mb-3">
            <a href="#" class="nav-link text-white text-decoration-none"><i class="bi bi-journal-text"></i>
                <span>Catatan</span></a>
        </li>
        <li class="nav-item mb-3">
            <a href="#" class="nav-link text-white text-decoration-none"><i class="bi bi-gear"></i>
                <span>Pengaturan</span></a>
        </li> --}}
    </ul>
    <a href="/logout"
        class="logout nav-item mt-auto m-3 p-2 pl-3d-flex align-items-center text-danger text-decoration-none">
        <i class="bi bi-box-arrow-right"></i> <span class="ms-2">Logout</span>
    </a>
</div>

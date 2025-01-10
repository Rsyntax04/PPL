<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Izin Cuti</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #003366;
            position: fixed;
            color: white;
        }

        .sidebar h3 {
            margin: 20px;
        }

        .sidebar .nav-link {
            color: white;
            margin: 10px 0;
        }

        .sidebar .nav-link:hover {
            background-color: #004080;
        }

        .sidebar .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
        }

        .content {
            margin-left: 230px;
            padding: 20px;
        }

        .header-bar {
            background-color: #003366;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: left;
            font-size: 18px;
            font-weight: bold;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-primary {
            display: block;
            margin: 15px auto 0 auto;
            width: fit-content;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: aliceblue;
            color: #004080;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Nama Perusahaan</h3>
    <nav class="nav flex-column">
        <a href="#" class="nav-link">Pengaturan</a>
    </nav>
    <div class="logout">
        <a href="#" class="nav-link text-center">Logout</a>
    </div>
</div>

<!-- Main Content -->
<div class="content">
    <div class="header-bar">
        Pengajuan Izin Cuti
    </div>

    <div class="form-container">
        <!-- Tampilkan pesan berhasil jika ada -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('izin_cuti.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Cth: Nathanael" required>

            <label for="department">Departemen:</label>
            <input type="text" class="form-control" id="department" name="department" placeholder="Cth: Keuangan" required>

            <label for="position">Jabatan:</label>
            <input type="text" class="form-control" id="position" name="position" placeholder="Cth: Manajer" required>

            <label for="alasan_izin">Alasan Izin:</label>
            <input type="text" class="form-control" id="alasan_izin" name="alasan_izin" placeholder="Cth: Sakit" required>

            <label for="tanggal_awal">Tanggal Awal:</label>
            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>

            <label for="tanggal_akhir">Tanggal Akhir:</label>
            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>

            <label for="berkas">Masukkan Berkas:</label>
            <input type="file" class="form-control" id="berkas" name="berkas">

            <button type="submit" class="btn btn-primary mt-3">Ajukan</button>
        </form>
    </div>
</div>

</body>
</html>

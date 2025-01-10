<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Karyawan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background: #dc3545; /* Merah untuk peringatan */
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .button {
            background: #dc3545; /* Merah untuk tombol konfirmasi */
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }
        .button-cancel {
            background: #007bff; /* Biru untuk membatalkan */
        }
    </style>
</head>
<body>

<header>
    <h1>Hapus Karyawan</h1>
</header>

<div class="container">
    <h2>Apakah Anda yakin ingin menghapus karyawan berikut?</h2>
    <p><strong>Nama:</strong> {{ $karyawan->nama }}</p>
    <p><strong>Departemen:</strong> {{ $karyawan->id_departemen }}</p>
    <p><strong>Jabatan:</strong> {{ $karyawan->id_jabatan }}</p>
    <p><strong>Golongan:</strong> {{ $karyawan->id_golongan }}</p>
    <p><strong>Alamat:</strong> {{ $karyawan->alamat }}</p>
    <p><strong>No HP:</strong> {{ $karyawan->no_telepon }}</p>

    <form method="post" action="{{ route('karyawan.delete', $karyawan->karyawan_id) }}">
        @csrf
        <button type="submit" class="button">Hapus</button>
        <a href="{{ route('karyawan.index') }}" class="button button-cancel">Batal</a>
    </form>
</div>

</body>
</html>

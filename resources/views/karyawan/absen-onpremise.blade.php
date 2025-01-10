@extends('layouts.master')

@section('web-content')

<!-- Main Content -->
<div class="content">
    <div class="header-bar">
        Absensi On-Premise
    </div>

    <div class="button-container">
        <button onclick="authenticateUser()" class="btn btn-primary">Authenticate User</button>
    </div>

    <div id="faceio-modal"></div>
</div>

<script src="https://cdn.faceio.net/fio.js"></script>
<script type="text/javascript">
    const faceio = new faceIO("fioa2994");

    function authenticateUser() {
        faceio.authenticate().then(userInfo => {
            // Proses autentikasi berhasil
            fetch('/absensi/authenticate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ unique_face_id: userInfo.facialId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Presensi berhasil! Selamat datang, ${data.karyawan.nama}.`);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error(error);
                alert("Terjadi kesalahan saat proses autentikasi.");
            });
        }).catch(error => {
            console.error(error);
            alert("Presensi gagal");
        });
    } 

</script>

@endsection

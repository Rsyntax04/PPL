<?php

namespace App\Http\Controllers;

use App\Models\departemen;
use App\Models\golongan;
use App\Models\jabatan;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\role;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all(); // Ambil semua data karyawan dari database
        return view('karyawan.index', ['karyawans' => $karyawans]);
    }

    public function create()
    {
        return view('karyawan.create',[
            'departemens'=> departemen::all(),
            'jabatans'=> jabatan::all(),
            'roles'=>role::all(),
            'golongans'=>golongan::all(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'departemen' => 'required|string|max:10',
            'jabatan' => 'required|string|max:10',
            'role' => 'required|string|max:10',
            'golongan' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:karyawan,email',
            'password' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ],[
            'departemen.required'=>'Departemen belum terisi',
            'jabatan.required'=>'Jabatan belum terisi',
            'role.required'=>'Role belum terisi',
            'golongan.required'=>'Golongan belum terisi',
            'nama.required'=>'Nama belum terisi',
            'alamat.required'=>'Alamat belum terisi',
            'email.required'=>'Email belum terisi',
            'email.unique'=>'Email sudah pernah didaftarkan',
            'password.required'=>'Password belum terisi',
            'no_telepon.required'=>'Nomor Telepon belum terisi',
        ]);

        $id = IdGenerator::generate(['table'=>'karyawan','field'=>'id_karyawan','length'=>'10', 'prefix'=>'KAR-']);

        $karyawan = new karyawan();
        $karyawan->id_karyawan = $id;
        $karyawan->departemen = $request->get('departemen');
        $karyawan->jabatan = $request->get('jabatan');
        $karyawan->role = $request->get('role');
        $karyawan->golongan = $request->get('golongan');
        $karyawan->nama = $request->get('nama');
        $karyawan->alamat = $request->get('alamat');
        $karyawan->email = $request->get('email');
        $karyawan->password = Hash::make($request->get('password'));
        $karyawan->no_telepon = $request->get('no_telepon');
        $karyawan->unique_face_id = $request->get('unique_face_id');

        $karyawan->save();
        return redirect()->route('karyawan.index');
    }

    public function edit(karyawan $karyawan){
    return view('karyawan.edit', [
        'karyawans' => $karyawan,
        'departemens'=> departemen::all(),
        'jabatans'=> jabatan::all(),
        'roles'=>role::all(),
        'golongans'=>golongan::all(),
        ]); // Kirim karyawan ke view
    }

    public function update(Request $request, karyawan $karyawan)
    {
        // Validasi input
        $validateData = validator($request->all(), [
            'departemen' => 'required|string|max:10',
            'jabatan' => 'required|string|max:10',
            'role' => 'required|string|max:10',
            'golongan' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => ['required', 'string', 'max:255', Rule::unique('karyawan', 'email')->ignore($karyawan->id_karyawan, 'id_karyawan')],
            'password' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ],[
            'departemen.required'=>'Departemen belum terisi',
            'jabatan.required'=>'Jabatan belum terisi',
            'role.required'=>'Role belum terisi',
            'golongan.required'=>'Golongan belum terisi',
            'nama.required'=>'Nama belum terisi',
            'alamat.required'=>'Alamat belum terisi',
            'email.required'=>'Email belum terisi',
            'email.unique'=>'Email sudah terisi',
            'password.required'=>'Password belum terisi',
            'no_telepon.required'=>'Nomor Telepon belum terisi',
        ])-> validate();;

        $karyawan->departemen = $validateData['departemen'];
        $karyawan->jabatan = $validateData['jabatan'];
        $karyawan->role = $validateData['role'];
        $karyawan->golongan = $validateData['golongan'];
        $karyawan->nama = $validateData['nama'];
        $karyawan->alamat = $validateData['alamat'];
        $karyawan->email = $validateData['email'];
        if($karyawan->password != $request->pasword){
            $karyawan->password = Hash::make($validateData['password']);
        }
        $karyawan->no_telepon = $validateData['no_telepon'];
        $karyawan->save();
        return redirect()->route('karyawan.index');
    }

    public function delete(karyawan $karyawan)
    {
        $karyawan->delete(); // Hapus karyawan
        return redirect()->route('karyawan.index');
    }
}

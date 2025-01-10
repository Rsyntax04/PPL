<?php

namespace App\Http\Controllers;

use App\Models\golongan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GolonganController extends Controller
{
    public function index(){
        $golongans = golongan::all();
        return view('golongan.index', ['golongans' => $golongans]);
    }

    public function create(){
        return view('golongan.create');
    }

    public function store(Request $request){
        
        $request->validate([
            'nama_golongan' => 'required|string|max:255|unique:golongan,nama_golongan',
        ],[
            'nama_golongan.required'=>'Nama Golongan belum terisi',
            'nama_golongan.unique'=>'Nama Golongan sudah pernah ditambahkan '
        ]);

        $id = IdGenerator::generate(['table'=>'golongan','field'=>'id_golongan','length'=>'10', 'prefix'=>'GOL-']);

        $golongan = new golongan();
        $golongan->id_golongan = $id;
        $golongan->nama_golongan = $request->get('nama_golongan');
        $golongan->save();

        return redirect()->route('golongan.index');
    }

    public function edit(golongan $golongan){
        return view('golongan.edit', ['golongans' => $golongan]);
    }

    public function update(Request $request, golongan $golongan){
        $validateData = validator($request->all(), [
            'nama_golongan' => ['required', 'string', 'max:255', Rule::unique('golongan', 'nama_golongan')->ignore($golongan->id_golongan, 'id_golongan')],
        ],[
            'nama_golongan.required'=>'Nama Golongan belum terisi',
            'nama_golongan.unique'=>'Nama Golongan sudah pernah ditambahkan '
        ])-> validate();

        $golongan->nama_golongan = $validateData['nama_golongan'];
        $golongan->save();
        return redirect(route('golongan.index'));
    }

    public function destroy(golongan $golongan)
    {
        $golongan->delete();
        return redirect()->route('golongan.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatans = jabatan::all();
        return view('jabatan.index', ['jabatans' => $jabatans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatan,nama_jabatan',
        ],[
            'nama_jabatan.required'=>'Nama Jabatan belum terisi',
            'nama_jabatan.unique'=>'Nama Jabatan sudah pernah ditambahkan '
        ]);

        $id = IdGenerator::generate(['table'=>'jabatan','field'=>'id_jabatan','length'=>'10', 'prefix'=>'JBTN-']);

        $jabatan = new jabatan();
        $jabatan->id_jabatan = $id;
        $jabatan->nama_jabatan = $request->get('nama_jabatan');
        $jabatan->save();

        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(jabatan $jabatan)
    {
        return view('jabatan.edit', ['jabatans' => $jabatan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jabatan $jabatan)
    {
        $validateData = validator($request->all(), [
            'nama_jabatan' => ['required', 'string', 'max:255', Rule::unique('jabatan', 'nama_jabatan')->ignore($jabatan->id_jabatan, 'id_jabatan')],
        ],[
            'nama_jabatan.required'=>'Nama Jabatan belum terisi',
            'nama_jabatan.unique'=>'Nama Jabatan sudah pernah ditambahkan '
        ])-> validate();

        $jabatan->nama_jabatan = $validateData['nama_jabatan'];
        $jabatan->save();
        return redirect(route('jabatan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect(route('jabatan.index'));
    }
}

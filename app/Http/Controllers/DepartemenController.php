<?php

namespace App\Http\Controllers;

use App\Models\departemen;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departemen = departemen::all();
        return view('departemen.index', ['departemens' => $departemen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departemen.create');
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
            'nama_departemen' => 'required|string|max:255|unique:departemen,nama_departemen',
        ],[
            'nama_departemen.required'=>'Nama Departemen belum terisi',
            'nama_departemen.unique'=>'Nama Departemen sudah pernah ditambahkan '
        ]);

        $id = IdGenerator::generate(['table'=>'departemen','field'=>'id_departemen','length'=>'10', 'prefix'=>'DEPT-']);

        $departemen = new departemen();
        $departemen->id_departemen = $id;
        $departemen->nama_departemen = $request->get('nama_departemen');
        $departemen->save();

        return redirect()->route('departemen.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function show(departemen $departemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function edit(departemen $departemen)
    {
        return view('departemen.edit', ['departemens' => $departemen]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, departemen $departemen)
    {
        $validateData = validator($request->all(), [
            'nama_departemen' => ['required', 'string', 'max:255', Rule::unique('departemen', 'nama_departemen')->ignore($departemen->id_departemen, 'id_departemen')],
        ],[
            'nama_departemen.required'=>'Nama Departemen belum terisi',
            'nama_departemen.unique'=>'Nama Departemen sudah pernah ditambahkan '
        ])-> validate();

        $departemen->nama_departemen = $validateData['nama_departemen'];
        $departemen->save();
        return redirect(route('departemen.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function destroy(departemen $departemen)
    {
        $departemen->delete();
        return redirect()->route('departemen.index');
    }
}

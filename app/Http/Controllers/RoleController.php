<?php

namespace App\Http\Controllers;

use App\Models\role;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = role::all();
        return view('role.index', ['roles' => $role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
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
            'nama_role' => 'required|string|max:255|unique:role,nama_role',
        ],[
            'nama_role.required'=>'Nama role belum terisi',
            'nama_role.unique'=>'Nama role sudah pernah ditambahkan '
        ]);

        $id = IdGenerator::generate(['table'=>'role','field'=>'id_role','length'=>'10', 'prefix'=>'ROLE-']);

        $role = new role();
        $role->id_role = $id;
        $role->nama_role = $request->get('nama_role');
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        return view('role.edit', ['roles' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $role)
    {
        $validateData = validator($request->all(), [
            'nama_role' => ['required', 'string', 'max:255', Rule::unique('role', 'nama_role')->ignore($role->id_role, 'id_role')],
        ],[
            'nama_role.required'=>'Nama role belum terisi',
            'nama_role.unique'=>'Nama role sudah pernah ditambahkan '
        ])-> validate();

        $role->nama_role = $validateData['nama_role'];
        $role->save();
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
        $role->delete();
        return redirect()->route('role.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function show()
    {
        $petugas = Petugas::all();

        return view ('contents.admin.officer.show',compact('petugas'));
    }

    public function add()
    {
        return view ('contents.admin.officer.add');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => 'required|string|max:255',
            'username' => 'required|string|unique:petugas',
            'password' => 'required|string|min:6',
            'telp' => 'required',
            'level' => 'required|in:admin,petugas'
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $username = Petugas::where('username', $data['username'])->first();

        if ($username) {
            return back()->with(['username' => 'Username sudah digunakan !']);
        }

        Petugas::create([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],

        ]);

        return redirect('/admin/petugas')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id_petugas)
    {
        $petugas = Petugas::where('id_petugas', $id_petugas)->first();

        return view ('contents.admin.officer.edit',compact('petugas'));
    }

    public function update(Request $request, $id_petugas)
    {
        $data = $request->all();

        $petugas = Petugas::find($id_petugas);

        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        return redirect('/admin/petugas')->with('success','Data Petugas Berhasil Diubah');
    }

    public function destroy($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);

        $petugas->delete();

        return redirect('/admin/petugas')->with('success','Petugas berhasil dihapus');
    }

    public function detail($id_petugas)
    {
        $petugas = Petugas::where('id_petugas',$id_petugas)->first();

        return view('contents.admin.officer.detail',compact('petugas'));
    }
}

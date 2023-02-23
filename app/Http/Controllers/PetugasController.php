<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function show()
    {
        $petugas = Petugas::latest()->get();

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
            'alamat' => 'required',
            'email'=> 'required',
            'password' => 'required|min:8|confirmed',
            'telp' => 'required',
            'level' => 'required|in:admin,petugas'
        ],[
            'nama_petugas.required' => 'Field ini dibutuhkan',
            'username.required' => 'Field ini dibutuhkan',
            'username.unique' => 'Username sudah digunakan',
            'alamat.required' => 'Field ini dibutuhkan',
            'email.required' => 'Field ini dibutuhkan',
            'password.required' => 'Password dibutuhkan',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.min' => 'Password minimal 8 karakter',
            'telp.required' => 'No telp dibutuhkan',
            'level.required' => 'Field ini dibutuhkan',
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
            'alamat' => $data['alamat'],
            'email' => $data['email'], 
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

        $validate = Validator::make($data, [
            'nama_petugas' => 'required|string|max:255',
            'alamat' => 'required',
            'email'=> 'required',
            'telp' => 'required',
            'level' => 'required|in:admin,petugas'
        ],[
            'nama_petugas.required' => 'Field ini dibutuhkan',
            'alamat.required' => 'Field ini dibutuhkan',
            'email.required' => 'Field ini dibutuhkan',
            'telp.required' => 'No telp dibutuhkan',
            'level.required' => 'Field ini dibutuhkan',
        ]);

        Petugas::where('id_petugas',$id_petugas)->update([
            'nama_petugas' => $data['nama_petugas'],
            'alamat' => $data['alamat'],
            'email' => $data['email'],
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

    public function printpdf()
    {
        $officers = Petugas::all();
        
        $pdf = PDF::loadview('contents.admin.officer.reportpdf',[
            'officers'=> $officers,
            ])->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('Laporan-petugas.pdf');
            return redirect('/admin/petugas');
    }

}

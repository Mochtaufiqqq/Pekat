<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function formLogin()
    {
        return view ('contents.admin.auth.login');
    }

    public function login(Request $request)
    {
        $username = Petugas::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar!']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai!']);
        }

        $auth = Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ]);

        if ($auth) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.formLogin');
    }

    public function pengaduan() 
    {
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();

        return view('contents.admin.report.show',compact('pengaduan'));
    }

    public function detailpengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan',$id_pengaduan)->first();

        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        return view('contents.admin.report.detail',compact('pengaduan','tanggapan'));
    }

    // tanggapan
    public function createOrUpdate(Request $request)
    {
        $pengaduan = Pengaduan::where('id_pengaduan',$request->id_pengaduan)->first();

        $tanggapan = Tanggapan::where('id_pengaduan',$request->id_pengaduan)->first();

        if ($tanggapan) {
            $pengaduan->update(['status' => $request->status]);

            $tanggapan->update([
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan ?? '',
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);
            // dd($request);

            return redirect('/admin/pengaduan/detail/'. $pengaduan->id_pengaduan)->with('success','Tanggapan berhasil diubah');

        } else {
            $pengaduan->update(['status' => $request->status]);

            $tanggapan = Tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan ?? '',
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);
            
            return redirect('/admin/pengaduan/detail/'. $pengaduan->id_pengaduan)->with('success','Tanggapan berhasil dikirim');
        }
        
    }

    public function destroypengaduan($id_pengaduan){
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pengaduan->delete();

        return redirect('/admin/pengaduan')->with('success','Laporan berhasil dihapus');       
    }

    public function pengaduantrash()
    {
        $pengaduan = Pengaduan::onlyTrashed()->get();
        return view('contents.admin.report.trash', compact('pengaduan'));
    }
    public function restorepengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::onlyTrashed()->findOrFail($id_pengaduan);
        $pengaduan->restore();
        return redirect('/admin/pengaduan')->with('success', 'Berhasil mengembalikan laporan.');
    }


    // Society EDIT,DETAIL,DELETE
    public function showsociety()
    {
        $society = Masyarakat::latest()->get(); 

        return view('contents.admin.society.show',compact('society'));
    }
    
    public function editsociety($nik)
    {
        $society = Masyarakat::where('nik', $nik)->first();

        return view('contents.admin.society.edit',compact('society'));
    }

    public function updatesociety(Request $request, $nik)
    {
        // $username = Masyarakat::where('username'. $request->username);
        // if ($username) {
        //     return redirect()->back()->with(['pesan' => 'Username sudah ada!']);
        // }
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            // 'username' => 'required',
            'email'  => 'required',
            // 'confirmation' => 'required|same:password',
        ]);

        if($request['nik'] === $nik) {
            Masyarakat::where('nik',$nik)->update([
                'nama' => $request['nama'],
                'email' => $request['email'] ?? '',
                'password' => Hash::make($request['password']),
    
            ]);
        
        } else {
            Masyarakat::where('nik',$nik)->update($validatedData);
        }
       
        return redirect('/admin/masyarakat')->with('success','Data berhasil di update');

    }

    public function detailsociety($nik)
    {
        
        $society = Masyarakat::where('nik',$nik)->first();

        return view('contents.admin.society.detail',compact('society'));
    }

    public function destroysociety($nik)
    {
        $society = Masyarakat::findOrFail($nik);

        $society->delete();

        return redirect('/admin/masyarakat')->with('success','Masyarakat berhasil dihapus');
    }

    public function profile()
    {
        return view('contents.admin.profile.detail');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use PDF;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->back()->with(['pesan' => 'Username / Password anda salah!']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Username / Password anda salahi!']);
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

      

            date_default_timezone_set('Asia/Jakarta');

            $tanggapan = Tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d h:i:s'),
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
    
    public function forcedeletepengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::onlyTrashed()->findOrFail($id_pengaduan);
        $pengaduan->forceDelete();
        return redirect('/admin/sampah')->with('success', 'Laporan berhasil dihapus secara permanen.');
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
        $petugas = Petugas::where('id_petugas',Auth::guard('admin')->user()->id_petugas)->first();
        return view('contents.admin.profile.detail',compact('petugas'));
    }

    public function updateprofile(Request $request, $id_petugas)
    {
        $petugas = Petugas::where('id_petugas',$request->id_petugas)->first();

        $validatedData = $request->validate([
            'nama_petugas' => 'required',
            'email' => 'required',
            'telp' => 'required',
            'alamat' => 'required'
        ]);

        Petugas::where('id_petugas', $id_petugas)->update($validatedData);

        return redirect('/admin/profile/me')->with('success','Profil berhasil diperbarui');
    }

    public function changePwPost(Request $request, $id_petugas)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'old_password.required' => 'Field ini harus diisi', 
            'new_password.required' => 'Field ini harus diisi',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
            'new_password.min' => 'Password minimal 8 karakter'
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $officer = Auth::guard('admin')->user();

        if (!Hash::check($request->old_password, $officer->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah']);
        }

        Petugas::where('id_petugas', $id_petugas)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success','Password berhasil diubah');
    }

    public function report()
    {
        return view('contents.admin.showreport');
    }

    public function getReport(Request $request)
    {
        $from = $request->from . ' ' . '00:00:00';
        $to = $request->to . ' ' . '23:59:59';

        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan',[$from, $to])->get();

        return view('contents.admin.showreport',compact('pengaduan','from','to'));
        
    }

    public function reportPdf($from, $to){
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from,$to])->get();

        $pdf = PDF::loadview('contents.admin.reportpdf', ['pengaduan' => $pengaduan ]);
        return $pdf->download('Laporan-pengaduan.pdf');
    }
}

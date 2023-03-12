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
        $user = Petugas::where('username', $request->username)
        ->orWhere('email', $request->username)
        ->first();

        if (!$user) {
        return redirect()->back()->with(['pesan' => 'Username / Email / Password anda salah !']);
        }

        $password = Hash::check($request->password, $user->password);

        if (!$password) {
        return redirect()->back()->with(['pesan' => 'Username / Email / Password anda salah !']);
        }

        if (Auth::guard('admin')->attempt(['username' => $user->username, 'password' => $request->password])
        || Auth::guard('admin')->attempt(['email' => $user->email, 'password' => $request->password])) {
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
        $pengaduan = Pengaduan::latest()->get();

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
        $pengaduan = Pengaduan::onlyTrashed()->latest()->get();
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
    
    // public function editsociety($id)
    // {
    //     $society = Masyarakat::where('id', $id)->first();

    //     return view('contents.admin.society.edit',compact('society'));
    // }

    // public function updatesociety(Request $request, $id)
    // {
    //     // $username = Masyarakat::where('username'. $request->username);
    //     // if ($username) {
    //     //     return redirect()->back()->with(['pesan' => 'Username sudah ada!']);
    //     // }
    //     $validatedData = $request->validate([
    //         'nik' => 'required',
    //         'nama' => 'required',
    //         // 'username' => 'required',
    //         'email'  => 'required',
    //         // 'confirmation' => 'required|same:password',
    //     ]);

    //     if($request['nik'] === $id) {
    //         Masyarakat::where('nik',$nik)->update([
    //             'nama' => $request['nama'],
    //             'email' => $request['email'] ?? '',
    //             'password' => Hash::make($request['password']),
    
    //         ]);
        
    //     } else {
    //         Masyarakat::where('nik',$nik)->update($validatedData);
    //     }
       
    //     return redirect('/admin/masyarakat')->with('success','Data berhasil di update');

    // }

    public function detailsociety($id)
    {
        
        $society = Masyarakat::where('id',$id)->first();
        $complaint = Pengaduan::where('id_masyarakat',$id)->first();

        return view('contents.admin.society.detail',compact('society','complaint'));
    }

    public function destroysociety($id)
    {
        $society = Masyarakat::findOrFail($id);

        $has_verif_complaints = Pengaduan::where('id_masyarakat',$id)->where('status','!=','0')->first();

         // If society has verif complaints, return error message
        if ($has_verif_complaints) {
        return redirect()->back()->with('error', 'Masyarakat tidak dapat dihapus karena memiliki pengaduan yang sudah diverifikasi');
        } else{
            // Delete the related complaints
            Pengaduan::where('id_masyarakat', $id)->forceDelete();
            $society->delete();
        }
         
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

   public function reportpdf()
   {
    $complaint = Pengaduan::latest()->get();
        
    $pdf = PDF::loadview('contents.admin.report.export-pdf',[
        'complaint'=> $complaint,
        ])
        ->setOptions(['defaultFont' => 'sans-serif'])
        ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan-pengaduan.pdf');
        return redirect('/admin/pengaduan');
   }

   public function printTrashPdf()
   {
    $complaint = Pengaduan::onlyTrashed()->latest()->get();
        
    $pdf = PDF::loadview('contents.admin.report.printTrash',[
        'complaint'=> $complaint,
        ])
        ->setOptions(['defaultFont' => 'sans-serif'])
        ->setPaper('a4', 'landscape');
        return $pdf->download('Trash-pengaduan.pdf');
        return redirect('/admin/sampah');
   }
}

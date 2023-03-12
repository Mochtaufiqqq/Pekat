<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Kategori;
use App\Models\Location;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use App\Models\FotoLaporan;
use Illuminate\Http\Request;
use App\Models\TemporaryImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {  
        $pengaduan = Pengaduan::where('status', '!=', '0')->where('hide_identitas','!=','0')->where('hide_laporan','=','1')->latest()->get();
        $verif = Masyarakat::whereNotNull('foto_ktp')->whereNotNull('tgl_lahir')->whereNotNull('alamat')->whereNotNull('telp')->count();
        $nonverif = Masyarakat::whereNull('foto_ktp')->orwhereNull('tgl_lahir')->count();
        $cp = Pengaduan::all();
        $categories = Kategori::get();
        $ditanggapi = Tanggapan::get()->count();
        

        return view('contents.user.index',compact('pengaduan','verif','nonverif','cp','ditanggapi','categories'));
        
    }

    public function dashboard()
    {
        $categories = Kategori::get();
        if (Session::has('folder')) {
            Session::remove('folder');
            Session::remove('filename');
        }
        return view('contents.user.dashboard',compact('categories'));
    }

    public function updateinfopribadi(Request $request ,$id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => ['required','min:16','max:16'],
            'telp' => ['required'],
            'tgl_lahir' => ['required'],
            'foto_ktp' => ['mimes:jpg,jpeg,png','max:5000']
        ],[
            'nik.required' => 'Field ini tidak boleh kosong',
            'nik.min' => 'NIK minimal 16 angka',
            'nik.max' => 'NIK maksimal 16 angka',
            'nik.unique' => 'NIK sudah terdaftar !',
            'foto_ktp.mimes' => 'Field ini harus berupa foto'
        ]);

        if ($validator->fails()) {
        return back()->withErrors($validator);
        }

        if($request->has('foto_ktp')){
            $fileName = time() . $request->file('foto_ktp')->getClientOriginalName();
            $path = $request->file('foto_ktp')->storeAs('ktp-society', $fileName);
            $foto = '/storage/' .$path;
        

            Masyarakat::where('id',$id)->update([
                'foto_ktp' => $foto,
                'telp' => $request['telp'],
                'tgl_Lahir' => $request['tgl_lahir'],
            ]);
        }

        Masyarakat::where('id',$id)->update([
            'nik' => $request['nik'],
            'telp' => $request['telp'],
            'tgl_Lahir' => $request['tgl_lahir'],
        ]);
        
        return redirect()->back()->with('success','Profil berhasil diperbarui');


    }

    public function updateInfoPublic(Request $request , $id)
    {
        $username = Masyarakat::where('username'. $request->username);

        $validatedData = $request->validate([
            // 'username' => 'required',
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',

        ]);
        

        if($request->has('foto_profil')){
            $fileName = time() . $request->file('foto_profil')->getClientOriginalName();
            $path = $request->file('foto_profil')->storeAs('profil-society', $fileName);
            $foto_profil = '/storage/' .$path;
        

            Masyarakat::where('id',$id)->update([
                'username' => $request['username'],
                'foto_profil' => $foto_profil,
                'nama' => $request['nama'],
                'email' => $request['email'] ?? '',
            ]);
        }

        if($request['username'] === $username) {
            Masyarakat::where('id',$id)->update([
                'nama' => $request['nama'],
                'email' => $request['email'] ?? '',
                // 'foto_profil' => $request['foto_profil'] ?? '',
    
            ]);
        } else {
            Masyarakat::where('id',$id)->update($validatedData);
        }

    
        return redirect()->back()->with('success','Profil berhasil diperbarui');
           
    }

    public function login()
    {
        return view('contents.user.auth.login');
    }

    public function loginPost(Request $request)
    {
        $user = Masyarakat::where('username', $request->username)
        ->orWhere('email', $request->username)
        ->first();

        if (!$user) {
        return redirect()->back()->with(['pesan' => 'Username / Email / Password anda salah !']);
        }

        $password = Hash::check($request->password, $user->password);

        if (!$password) {
        return redirect()->back()->with(['pesan' => 'Username / Email / Password anda salah !']);
        }

        if (Auth::guard('masyarakat')->attempt(['username' => $user->username, 'password' => $request->password])
        || Auth::guard('masyarakat')->attempt(['email' => $user->email, 'password' => $request->password])) {
        return redirect('/home');
        } else {
        return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function formRegister()
    {
        return view('contents.user.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required','min:16','max:16','unique:masyarakats'],
            'nama' => ['required'],
            'username' => ['required','min:3'],
            'email' => ['required'],
            'password' => ['required','min:8'],
            'confirmation' => ['required','min:8','same:password'],

            ],[
                'nik.required' => 'NIK dibutuhkan !',
                'nik.unique' => 'NIK sudah terdaftar !',
                'nik.min' => 'NIK minimal 16 angka !',
                'nik.max' => 'NIK tidak boleh lebih dari 16 angka !',
                'nama.required' => 'Nama lengkap dibutuhkan !',
                'username.required' => 'Username dibutuhkan !',
                'username.min' => 'Username minimal 3 karakter !',
                'email.required' => 'Email harus diisi !',
                'password.min' => 'Password minimal 8 karakter !',
                'confirmation' => 'Konfirmasi password tidak sama !',
            ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->with(['error' => $validate->errors()]);
        }

        $username = Masyarakat::where('username', $request->username)->first();
        $nik = Masyarakat::where('nik', $request->nik)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah digunakan! mohon gunakan username lain']);
        }
         

        Masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/login')->with('success','Registrasi Berhasil');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect()->route('pekat.index');
    }

    public function storePengaduan(Request $request)
    {

        // $data = $request;

        $validate = Validator::make($request->all(), [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'lokasi_kejadian' => ['required'],
            'tgl_pengaduan'=> ['required'],
            'image.*' => ['image','mimes:jpg,png,jpeg'],
            // 'images.*' => 'image|mimes:jpg,png,jpeg|max:5000',
        ],[
            'judul_laporan.required' => 'Judul laporan harus diisi',
            'isi_laporan.required' => 'Isi laporan dibutuhkan',
            'lokasi_kejadian.required' => 'Lokasi kejadian dibutuhkan',
            'tgl_pengaduan.required' => 'Tanggal laporan dibutuhkan',
            'image.image' => 'Lampiran harus berupa foto',
            
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }


        date_default_timezone_set('Asia/Bangkok');

       // Begin a transaction
        DB::transaction(function () use ($request) {
            // Create the pengaduan record and associate it with the location
            $pengaduan = Pengaduan::create([
                'tgl_pengaduan' => date('Y-m-d h:i:s'),
                'id_masyarakat' => Auth::guard('masyarakat')->user()->id,
                'id_kategori' => $request['id_kategori'] ?? '',
                'judul_laporan' => $request['judul_laporan'],
                'isi_laporan' => $request['isi_laporan'],
                'hide_identitas' => $request['hide_identitas'] ?? '1',
                'hide_laporan' => $request['hide_laporan'] ?? '1',
                'status' => '0',
                // 'location_id' => $location->id,
            ]);

            $temporaryFolder = Session::get('folder');
            $namefile = Session::get('filename');

            if(!is_null($temporaryFolder) && !is_null($namefile)){
            for ($i = 0; $i < count($temporaryFolder); $i++) {
            $tmp_file = TemporaryImages::where('folder', $temporaryFolder[$i])->where('file', $namefile[$i])->first();
            if ($tmp_file) {
              Storage::copy('complaint-images/tmp/' . $tmp_file->folder . '/' .$tmp_file->file, '/complaint-images/' .$tmp_file->folder . '/' . $tmp_file->file);

                FotoLaporan::create([
                    'pengaduan_id' => $pengaduan->id_pengaduan,
                    'folder' => $temporaryFolder[$i],
                    'image' => $namefile[$i],
                ]);
                Storage::deleteDirectory('complaint-images/tmp/' . $tmp_file->folder);
                $tmp_file->delete();

                }
            }
        }
            // Create the location record
           Location::create([
                'id_pengaduan' =>  $pengaduan->id_pengaduan,
                'location' => $request['lokasi_kejadian'],
                'latitude' => $request['latitude'] ?? '',
                'longitude' => $request['longitude'] ?? '',
            ]);

        });

        return redirect('/pengaduan/me')->with('success','Pengaduan berhasil terkirim');
        
    }


    public function profile($siapa = '')
    {
        $photo = Auth::guard('masyarakat')->user()->foto_ktp;
        return view('contents.user.profile.profile',compact('siapa','photo'));
    }

    public function pengaduan($active = '')
    {
        $pengaduan = Pengaduan::where('id_masyarakat', Auth::guard('masyarakat')->user()->id)->latest()->get();
        $pending = Pengaduan::where('id_masyarakat', Auth::guard('masyarakat')->user()->id)->where('status','=','0')->latest()->get();
        $proses = Pengaduan::where('id_masyarakat', Auth::guard('masyarakat')->user()->id)->where('status','=','proses')->latest()->get();
        $selesai = Pengaduan::where('id_masyarakat', Auth::guard('masyarakat')->user()->id)->where('status','=','selesai')->latest()->get();
        $report = Pengaduan::where('id_masyarakat', Auth::guard('masyarakat')->user()->id)->first();
        // card
        $verif = Pengaduan::where('id_masyarakat', Auth::guard('masyarakat')->user()->id)->where('status','=','proses')->orWhere('status','=','selesai')->count();
        
        // $data = FotoLaporan::all();

        return view('contents.user.report.pengaduan',compact('pengaduan','active','verif','selesai','report','proses'));
        // dd($pengaduan);
    }

    public function editpengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan',$id_pengaduan)->first();
        $categories = Kategori::get();
        return view('contents.user.report.edit',compact('pengaduan','categories'));
    }

    public function updatepengaduan(Request $request, $id_pengaduan)
    {
        // $data = $request;

        $validate = Validator::make($request->all(), [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'lokasi_kejadian' => ['required'],
            'tgl_pengaduan'=> ['required'],
            'image.*' => ['image','mimes:jpg,png,jpeg'],
            // 'images.*' => 'image|mimes:jpg,png,jpeg|max:5000',
        ],[
            'judul_laporan.required' => 'Judul laporan harus diisi',
            'isi_laporan.required' => 'Isi laporan dibutuhkan',
            'lokasi_kejadian.required' => 'Lokasi kejadian dibutuhkan',
            'tgl_pengaduan.required' => 'Tanggal laporan dibutuhkan',
            'image.image' => 'Lampiran harus berupa foto',
            
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }


        date_default_timezone_set('Asia/Bangkok');

      
            $pengaduan = Pengaduan::where('id_pengaduan',$id_pengaduan)->update([
                'tgl_pengaduan' => date('Y-m-d h:i:s'),
                'id_masyarakat' => Auth::guard('masyarakat')->user()->id,
                'id_kategori' => $request['id_kategori'] ?? '',
                'judul_laporan' => $request['judul_laporan'],
                'isi_laporan' => $request['isi_laporan'],
                'hide_identitas' => $request['hide_identitas'] ?? '1',
                'hide_laporan' => $request['hide_laporan'] ?? '1',
                // 'report_main_image' => implode('|', $image) ??'',
                'status' => '0',
                // 'location_id' => $location->id,
            ]);

            $temporaryFolder = Session::get('folder');
            $namefile = Session::get('filename');

            if(!is_null($temporaryFolder) && !is_null($namefile)){
            for ($i = 0; $i < count($temporaryFolder); $i++) {
            $tmp_file = TemporaryImages::where('folder', $temporaryFolder[$i])->where('file', $namefile[$i])->first();
            if ($tmp_file) {
              Storage::copy('complaint-images/tmp/' . $tmp_file->folder . '/' .$tmp_file->file, '/complaint-images/' .$tmp_file->folder . '/' . $tmp_file->file);

                FotoLaporan::create([
                    'pengaduan_id' => $id_pengaduan,
                    'folder' => $temporaryFolder[$i],
                    'image' => $namefile[$i],
                ]);
                Storage::deleteDirectory('complaint-images/tmp/' . $tmp_file->folder);
                $tmp_file->delete();

                }
            }
        }
         
          // Update the location record
          Location::where('id_pengaduan', $id_pengaduan)->update([
            'location' => $request['lokasi_kejadian'],
            'latitude' => $request['latitude'] ?? '',
            'longitude' => $request['longitude'] ?? '',
        ]);


        return redirect('/pengaduan/me')->with('success','Pengaduan berhasil diubah');

    }

    
    public function destroypengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pengaduan->delete();
    
        return redirect('/pengaduan/me')->with('success','Pengaduan berhasil dihapus');

    }

    public function detailpengaduan($id_pengaduan){
        $pengaduan = Pengaduan::where('id_pengaduan',$id_pengaduan)->first();

        return view('contents.user.report.detail',compact('pengaduan'));
    }
    
    public function changepassword($active = ''){
        
        return view('contents.user.changepassword',compact('active'));
    }

    public function changePwPost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'old_password.required' => 'Field harus diisi', 
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
            'new_password.min' => 'Password minimal 8 karakter'
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $society = Auth::guard('masyarakat')->user();

        if (!Hash::check($request->old_password, $society->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah']);
        }

        Masyarakat::where('id', $id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success','Password berhasil diubah');

    }

    public function printpdf()
    {
        $socities = Masyarakat::all();
        
        $pdf = PDF::loadview('contents.admin.society.report-pdf',[
            'socities'=> $socities,
            ])->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('laporan-masyarakat.pdf');
            return redirect('/admin/masyarakat');
        
    }

}
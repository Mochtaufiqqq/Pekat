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
        $pengaduan = Pengaduan::where('status', '!=', '0')->where('hide_identitas','!=','0')->where('hide_laporan','=','1')->orderBy('tgl_pengaduan','desc')->get();
        $verif = Masyarakat::whereNotNull('foto_ktp')->whereNotNull('tgl_lahir')->whereNotNull('alamat')->whereNotNull('telp')->count();
        $nonverif = Masyarakat::whereNull('foto_ktp')->orwhereNull('tgl_lahir')->count();
        $cp = Pengaduan::all();
        $ditanggapi = Tanggapan::get()->count();

        return view('contents.user.index',compact('pengaduan','verif','nonverif','cp','ditanggapi'));
        
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

    public function updateinfopribadi(Request $request ,$nik)
    {
        $validatedData = $request->validate([
            'alamat' => 'required',
            'telp' => 'required',
            'tgl_lahir' => 'required',
            'foto_ktp' => 'image|mimes:jpg,png,jpeg|max:5000',
            
        ]);

        if ($request->file()) {
            $fileName = time().$request->file('foto_ktp')->getClientOriginalName();
            $path = $request->file('foto_ktp')->storeAs('ktp-society', $fileName);
            $validatedData['foto_ktp'] = '/storage/' .$path;
        }

        Masyarakat::where('nik',$nik)->update($validatedData);
        

        $options = [
            'text' => 'Profil Berhasil diperbarui',
            'duration' => 1560,
            'newestOnTop' => true,
            'gravity' => 'top',
            'position' => 'right',
            'backgroundColor' => 'linear-gradient(to right, rgb(0, 176, 155), rgb(150, 201, 61))',
        ];
    
        return redirect()->back()->with('success','Profil berhasil diperbarui');


    }

    public function updateInfoPublic(Request $request , $nik)
    {
        $username = Masyarakat::where('username'. $request->username);

        $validatedData = $request->validate([
            // 'username' => 'required',
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',

        ]);
        

        if($request['username'] === $username) {
            Masyarakat::where('nik',$nik)->update([
                'nama' => $request['nama'],
                'email' => $request['email'] ?? '',
                // 'foto_profil' => $request['foto_profil'] ?? '',
    
            ]);
        } else {
            Masyarakat::where('nik',$nik)->update($validatedData);
        }

        // $options = [
        //     'text' => 'Profil Berhasil diperbarui',
        //     'duration' => 1560,
        //     'newestOnTop' => true,
        //     'gravity' => 'top',
        //     'position' => 'right',
        //     'backgroundColor' => 'linear-gradient(to right, rgb(0, 176, 155), rgb(150, 201, 61))',
        // ];
    
        // $toast = new \stdClass();
        // $toast->options = $options;
        // $toast->message = 'Profil berhasil diperbarui';
    
        return redirect()->back()->with('success','Profil berhasil diperbarui');
           
    }

    public function login()
    {
        return view('contents.user.auth.login');
    }

    public function loginPost(Request $request)
    {
        $username = Masyarakat::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username / Password anda salah !']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Username / Password anda salah !']);
        }

        if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
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
            return redirect()->back()->with(['pesan' => $validate->errors()]);
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
                'nik' => Auth::guard('masyarakat')->user()->nik,
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

            for ($i = 0; $i < count($temporaryFolder); $i++) {
            $tmp_file = TemporaryImages::where('folder', $temporaryFolder[$i])->where('file', $namefile[$i])->first();
            if ($tmp_file) {
              Storage::copy('posts/tmp/' . $tmp_file->folder . '/' .$tmp_file->file, '/posts/' .$tmp_file->folder . '/' . $tmp_file->file);

                FotoLaporan::create([
                    'pengaduan_id' => $pengaduan->id_pengaduan,
                    'folder' => $temporaryFolder[$i],
                    'image' => $namefile[$i],
                ]);
                Storage::deleteDirectory('posts/tmp/' . $tmp_file->folder);
                $tmp_file->delete();
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
        $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->latest()->get();
        $pending = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','0')->orderBy('tgl_pengaduan', 'desc')->get();
        $proses = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','proses')->orderBy('tgl_pengaduan', 'desc')->get();
        $selesai = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','selesai')->orderBy('tgl_pengaduan', 'desc')->get();
        $report = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->first();
        // card
        $verif = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','proses')->orWhere('status','=','selesai')->count();
        
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
                'nik' => Auth::guard('masyarakat')->user()->nik,
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
              Storage::copy('posts/tmp/' . $tmp_file->folder . '/' .$tmp_file->file, '/posts/' .$tmp_file->folder . '/' . $tmp_file->file);

                FotoLaporan::create([
                    'pengaduan_id' => $id_pengaduan,
                    'folder' => $temporaryFolder[$i],
                    'image' => $namefile[$i],
                ]);
                Storage::deleteDirectory('posts/tmp/' . $tmp_file->folder);
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

        $options = [
            'text' => 'Pengaduan anda berhasil dihapus',
            'duration' => 1560,
            'newestOnTop' => true,
            'gravity' => 'top',
            'position' => 'right',
            'backgroundColor' => 'linear-gradient(to right, rgb(0, 176, 155), rgb(150, 201, 61))',
        ];
    
        return redirect('/pengaduan/me')->with('success','Pengaduan berhasil dihapus');


    }
    
    public function changepassword($active = ''){
        
        return view('contents.user.changepassword',compact('active'));
    }

    public function changePwPost(Request $request, $nik)
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

        Masyarakat::where('nik', $nik)->update([
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
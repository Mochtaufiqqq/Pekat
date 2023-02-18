<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {  
        $pengaduan = Pengaduan::where('status', '!=', '0')->where('hide_identitas','!=','0')->where('hide_laporan','=','1')->orderBy('tgl_pengaduan','desc')->get();

        return view('contents.user.index', ['pengaduan' => $pengaduan, ]);
        
    }

    public function dashboard()
    {
        return view('contents.user.dashboard');
    }

    public function updateinfopribadi(Request $request ,$nik)
    {
        $validatedData = $request->validate([
            // 'username' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'tgl_lahir' => 'required',
            'foto_ktp' => 'image|mimes:jpg,png,jpeg|max:5000',
            
        ],[
            'alamat.required' => 'Alamat dibutuhkan',
            'telp.required' => 'No Telp dibutuhkan',
            'tgl_lahir.required' => 'Tanggal lahir dibutuhkan',
            'foto_ktp.required' => 'Foto KTP diperlukan'
        ]);

        if ($request->file()) {
            $fileName = time().$request->file('foto_ktp')->getClientOriginalName();
            $path = $request->file('foto_ktp')->storeAs('ktp-society', $fileName);
            $validatedData['foto_ktp'] = '/storage/' .$path;
        }
        

        Masyarakat::where('nik',$nik)->update($validatedData);

        return redirect()->back()->with('success','Profile berhasil di perbarui');

    }

    public function updateInfoPublic(Request $request , $nik)
    {
        $username = Masyarakat::where('username'. $request->username);

        $validatedData = $request->validate([
            // 'username' => 'required',
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'foto_profil' => 'image|mimes:jpg,png,jpeg'

        ]);
        
        if ($request->file()) {
            $fileName = time().$request->file('foto_profil')->getClientOriginalName();
            $path = $request->file('foto_profil')->storeAs('profile-user', $fileName);
            $validatedData['foto_profil'] = '/storage/' .$path;
        }

        if($request['username'] === $username) {
            Masyarakat::where('nik',$nik)->update([
                'nama' => $request['nama'],
                'email' => $request['email'] ?? '',
                // 'foto_profil' => $request['foto_profil'] ?? '',
    
            ]);
        } else {
            Masyarakat::where('nik',$nik)->update($validatedData);
        }

        return redirect('/profile')->with('success','Profil Berhasil Diperbarui');             
    }

    public function login()
    {
        return view('contents.user.auth.login');
    }

    public function loginPost(Request $request)
    {
        $username = Masyarakat::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
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
            'nik' => ['required','min:16','max:16'],
            'nama' => ['required'],
            'username' => ['required','min:3'],
            'email' => ['required'],
            'password' => ['required','min:8'],
            'confirmation' => ['required','min:8','same:password'],

            ],[
                'nik.required' => 'NIK dibutuhkan',
                'nik.min' => 'NIK minimal 16 angka',
                'nik.max' => 'NIK tidak boleh lebih dari 16 angka',
                'nama.required' => 'Nama lengkap dibutuhkan',
                'username.required' => 'Username dibutuhkan',
                'username.min' => 'Username minimal 3 karakter',
                'email.required' => 'Email harus diisi',
                'password.min' => 'Password minimal 8 karakter'
            ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $username = Masyarakat::where('username', $request->username)->first();
        $nik = Masyarakat::where('nik', $request->nik)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar!']);
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
        if (!Auth::guard('masyarakat')->user()) {
            return redirect()->back()->with(['pesan' => 'Login dibutuhkan!'])->withInput();
        }

        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'lokasi_kejadian' => ['required'],
            'tgl_pengaduan'=> ['required']
            // 'images.*' => 'image|mimes:jpg,png,jpeg|max:5000',
        ],[
            'judul_laporan.required' => 'Judul laporan harus diisi',
            'isi_laporan.required' => 'Isi laporan dibutuhkan',
            'lokasi_kejadian.required' => 'Lokasi kejadian dibutuhkan',
            'tgl_pengaduan.required' => 'Tanggal laporan dibutuhkan'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $image = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('foto-laporan');
                $image[] = $path;
            }
        }

        date_default_timezone_set('Asia/Bangkok');

        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'longitude' => $data['longitude'] ?? '',
            'latitude' => $data['latitude'] ?? '',
            'hide_identitas' => $data['hide_identitas'] ?? '1',
            'hide_laporan' => $data['hide_laporan'] ?? '1',
            'foto' => implode('|', $image) ??'',
            'status' => '0',
        ]);

        if ($pengaduan) {
            return redirect('/pengaduan/me')->with('success','Pengaduan berhasil terkirim');
        } else {
            return redirect()->back();
        }
    }

    public function profile($siapa = '')
    {
        $terverifikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($siapa == 'me') {
            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();

            return view('contents.user.profile.profile', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else {
            $pengaduan = Pengaduan::where([['nik', '!=', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->where('hide_identitas' ,'=', '2')->where('hide_laporan','=','1')->orderBy('tgl_pengaduan', 'desc')->get();

            return view('contents.user.profile.profile', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        }
    }

    public function pengaduan($active = '')
    {
        $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();
        $pending = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','0')->orderBy('tgl_pengaduan', 'desc')->get();
        $proses = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','proses')->orderBy('tgl_pengaduan', 'desc')->get();
        $selesai = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','selesai')->orderBy('tgl_pengaduan', 'desc')->get();
        $report = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->first();
        // card
        $verif = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->where('status','=','selesai')->orwhere('status','=','proses')->get();

        return view('contents.user.report.pengaduan',compact('pengaduan','active','verif','selesai','report'));
        // dd($pengaduan);
    }

    public function editpengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan',$id_pengaduan)->first();
        return view('contents.user.report.edit',compact('pengaduan'));
    }

    public function updatepengaduan(Request $request, $id_pengaduan)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'lokasi_kejadian' => ['required'],
            'tgl_pengaduan'=> ['required']
            // 'images.*' => 'image|mimes:jpg,png,jpeg|max:5000',
        ],[
            'judul_laporan.required' => 'Judul laporan harus diisi',
            'isi_laporan.required' => 'Isi laporan dibutuhkan',
            'lokasi_kejadian.required' => 'Lokasi kejadian dibutuhkan',
            'tgl_pengaduan.required' => 'Tanggal laporan dibutuhkan'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $image = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('foto-laporan');
                $image[] = $path;
            }
        }

        date_default_timezone_set('Asia/Bangkok');

        Pengaduan::where('id_pengaduan',$id_pengaduan)->update([
            'tgl_pengaduan' => date('Y-m-d h:i:s'),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'longitude' => $data['longitude'] ?? '',
            'latitude' => $data['latitude'] ?? '',
            'hide_identitas' => $data['hide_identitas'] ?? '1',
            'hide_laporan' => $data['hide_laporan'] ?? '1',
            'foto' => implode('|', $image) ??'',
            'status' => '0',
        ]);

        return redirect('/pengaduan/me')->with('success','Pengaduan berhasil di update');
    }

    
    public function destroypengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pengaduan->delete();

        return redirect('/pengaduan/me')->with('success','Laporan berhasil dihapus'); 
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
            'old_password.required' => 'Field ini harus diisi', 
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

        return back()->with('success','Password berhasil diubah');
    }
}

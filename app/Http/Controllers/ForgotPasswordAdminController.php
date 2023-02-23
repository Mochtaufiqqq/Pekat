<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Petugas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordAdminController extends Controller
{

    public function forgotPassword()
    {
        return view('contents.admin.auth.forgot.forgotPassword');
    }

    public function mailReset(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
        ]);  
        
        $officer = Petugas::where('email', $request->email)->first();

        $getData = Petugas::where('email', $request->email)->get();

        if(!$officer)
        {
            return redirect()->back()->with('error', 'Email Petugas tidak terdaftar !');
        }
        else
        {
            foreach($getData as $data){            
            $generateToken = PasswordReset::create([
                'petugas_id'   =>  $data->id_petugas,
                'token'     =>  Str::random(16),
            ]);
    
            $token = $generateToken->token;
            Mail::send('contents.admin.auth.forgot.resetPassword', ['token' => $token, 'nama' => $data->nama], function($message) use($request){
                $message->to($request->email)->subject('Atur Ulang Kata Sandi');
            });
    
            return redirect('/admin/login')->with('success', 'Link berhasil dikirim
                                            silahkan cek email anda!');
        }
        }
    }

    public function resetPassword($token)
    {
        $mytoken = $token;
        $getData = PasswordReset::where('token', $mytoken)->get();
        foreach($getData as $data)
        if($data->token == $mytoken)
        {
            return view('contents.admin.auth.forgot.reset', compact('mytoken'));
        }

        else
        {
            return abort(401);
        }
    }


    public function changePassword(Request $request)
    {
        $password = Hash::make($request->password);
        // dd($password);
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Field ini harus diisi',
            'password.min' => 'Password minimal 8 karakter !' ,
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        $getOfficers  = PasswordReset::where('token', $request->token)->get();
        foreach($getOfficers as $officer)
            // $validatedData['password'] = Hash::make($validatedData['password']);
           Petugas::where('id_petugas', $officer->petugas_id)->update([
                'password' => Hash::make($request->password)
            ]);
        

        $officers = Petugas::where('id_petugas',$officer->petugas_id)->get();

        foreach($officers as $officer )

        PasswordReset::where('petugas_id', $officer->id_petugas)->delete();
        return redirect('/admin/login')->with('success', 'Kata sandi berhasil diatur ulang silahkan login!');
    }
    
}

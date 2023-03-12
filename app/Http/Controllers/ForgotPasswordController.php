<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Masyarakat;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{

    public function forgotPassword()
    {
        return view('contents.user.auth.forgot.forgotPassword');
    }

    public function mailReset(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
        ]);  
        
        $society = Masyarakat::where('email', $request->email)->first();

        $getData = Masyarakat::where('email', $request->email)->get();
        if(!$society)
        {
           return redirect()->back()->with('error','Maaf email masyarakat tidak terdaftar !');
        }
        else
        {
            foreach($getData as $data){            
            $generateToken = PasswordReset::create([
                'id_masyarakat'   =>  $data->id,
                'token'     =>  Str::random(16),
            ]);
    
            $token = $generateToken->token;
            Mail::send('contents.user.auth.forgot.resetPassword', ['token' => $token, 'nama' => $data->nama], function($message) use($request){
                $message->to($request->email)->subject('Atur Ulang Kata Sandi');
            });
    
            return redirect('/login')->with('success', 'Atur ulang kata sandi berhasil
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
            return view('contents.user.auth.forgot.reset', compact('mytoken'));
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

        $getUsers  = PasswordReset::where('token', $request->token)->get();
        foreach($getUsers as $user)
            // $validatedData['password'] = Hash::make($validatedData['password']);
           Masyarakat::where('id', $user->id_masyarakat)->update([
                'password' => Hash::make($request->password)
            ]);
        

        $societies = Masyarakat::where('id',$user->id_masyarakat)->get();

        foreach($societies as $society )


        PasswordReset::where('id_masyarakat', $society->id)->delete();
        return redirect('/login')->with('success', 'Kata sandi berhasil diatur ulang silahkan login!');
    }
   
}

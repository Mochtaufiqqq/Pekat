<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Petugas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordControllerAdmin extends Controller
{

    public function showLinkRequestForm()
    {
        return view('contents.admin.auth.forgot.forgotPassword');
    }

    public function sendEmail(Request $request)
    {
        $officer = Petugas::where('email', $request->email)->first();

        if (!$officer) {
            return redirect()->back()->with('error','Maaf email yang anda masukan tidak terdaftar');
        }

    $token = Str::random(60);
    DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => Hash::make($token),
        'created_at' => Carbon::now(),
    ]);

    $data = [
        'token' => $token,
        'user' => $officer,
    ];

    Mail::send('contents.user.auth.forgot.resetPassword', $data, function ($message) use ($officer) {
        $message->to($officer->email);
        $message->subject('Reset Password');
    });

    return redirect('/password/reset')->with('success','Berhasil mengirim link password reset');

    }

    
    public function showResetForm(Request $request ,$token)
    {

        return view('contents.user.auth.forgot.reset', ['token' => $token, 'email' => $request->email]);
    }


    public function reset(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
        'token' => 'required'
    ]);


    $officer = Petugas::where('email', $request->email)->first();

    if (!$officer) {
        return response()->json(['message' => 'We can\'t find a user with that e-mail address.'], 404);
    }

    $passwordReset = DB::table('password_resets')
        ->where('email', $officer->email)
        ->where('token', $request->token)
        ->first();

    if (!$officer) {
        return response()->json(['message' => 'token salah.'], 404);
    }

    $officer->password = Hash::make($request->password);
    $officer->save();

    DB::table('password_resets')->where('email', $officer->email)->delete();

    return redirect('/loginadmin')->with('pesan', 'Password berhasil diperbarui');
}
    
   
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Masyarakat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('contents.user.auth.forgot.forgotPassword');
    }

    public function sendEmail(Request $request)
    {
        $society = Masyarakat::where('email', $request->email)->first();

        if (!$society) {
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
            'user' => $society,
        ];

        Mail::send('contents.user.auth.forgot.resetPassword', $data, function ($message) use ($society) {
            $message->to($society->email);
            $message->subject('Reset Password');
        });

        return redirect('/password/reset')->with('success','Link berhasil dikirim,mohon periksa email anda');

    }

    
    public function showResetForm(Request $request ,$token)
    {
        return view('contents.user.auth.forgot.reset', [
            'token' => $token, 
            'email' => $request->email
        ]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);


        $society = Masyarakat::where('email', $request->email)->first();

        if (!$society) {
            return response()->json(['message' => 'We can\'t find a user with that e-mail address.'], 404);
        }

        $passwordReset = DB::table('password_resets')
            ->where('email', $society->email)
            ->where('token', $request->token)
            ->first();

        if (!$society) {
            return response()->json(['message' => 'token salah.'], 404);
        }

        $society->password = Hash::make($request->password);
        $society->save();

        DB::table('password_resets')->where('email', $society->email)->delete();

        return redirect('/login')->with('pesan', 'Password berhasil diperbarui');
        
    }
    
   
}

<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Mail\ContactFormEmail;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class OthersController extends Controller
{
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Statistik Semua User',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\masyarakat',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];

        $society = Masyarakat::get()->count();
        $complaint = Pengaduan::get()->count();
        $tanggapan = Tanggapan::get()->count();
        $officer = Petugas::get()->count();
        $chart1 = new LaravelChart($chart_options);

        return view('contents.admin.index',compact('chart1','society','complaint','tanggapan','officer'));
    }

    public function help()
    {
        return view('contents.other.help');
    }

    public function showForm()
    {
        return view('contents.other.contact');
    }

    public function sendEmail(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        $data = array(
            'name' => $name,
            'email' => $email,
            'message' => $message,
        );

        Mail::to('mhmdtaufiq3@gmail.com')->send(new ContactFormEmail($data));

        return back()->with('success', 'Terimakasih telah menghubungi kami!');
    }
}

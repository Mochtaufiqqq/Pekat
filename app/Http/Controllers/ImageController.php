<?php

namespace App\Http\Controllers;

use App\Models\FotoLaporan;
use App\Models\TemporaryImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        if (Session::has('folder')) {
            Session::remove('folder');
            Session::remove('filename');
        }
        return view('contents.dropzone');
    }


    public function store(Request $request)
    {
        $temporaryFolder = Session::get('folder');
        $namefile = Session::get('filename');

        for ($i = 0; $i < count($temporaryFolder); $i++) {
            $temporary = TemporaryImages::where('folder', $temporaryFolder[$i])->where('image', $namefile[$i])->first();

            if ($temporary) { //if exist

                FotoLaporan::create([
                    'folder' => $temporaryFolder[$i],
                    'image' => $namefile[$i],
                ]);

                //hapus file and folder temporary
                $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->image;
                if (File::exists($path)) {

                    Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->image, 'files/' . $temporary->folder . '/' . $temporary->image);

                    File::delete($path);
                    rmdir(storage_path('app/files/tmp/' . $temporary->folder));

                    //delete record in temporary table
                    $temporary->delete();
                }
            }
        }

        Session::remove('folder');
        Session::remove('filename');

        return response()->json(['status' => false, 'message' => 'Data Berhasil diupload']);
    }
}

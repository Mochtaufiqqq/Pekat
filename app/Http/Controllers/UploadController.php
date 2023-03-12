<?php

namespace App\Http\Controllers;

use App\Models\FotoLaporan;
use Illuminate\Http\Request;
use App\Models\TemporaryImages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function tmpUpload(Request $request)
    {
       if ($request->hasFile('image')) { 
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $folder = uniqid('complaint-image', true);
            $image->storeAs('complaint-images/tmp/' . $folder, $file_name);
            TemporaryImages::create([
                'folder' => $folder,
                'file' => $file_name
            ]);
            Session::push('folder', $folder); //save session  folder
            // folder = [item1, item2, item3];
            Session::push('filename', $file_name); //save session filename
            return $folder;
       }
       return '';
    }

  
    public function tmpDelete(Request $request)
    {
       $tmp_file = TemporaryImages::where('folder', request()->getContent())->first();
        if($tmp_file) {
            Storage::deleteDirectory('complaint-images/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response('success');
        }
    }

    // this not for filepond
    public function deleteImage(Request $request) {
        
        $foto_laporan = FotoLaporan::find($request->id);
      
            if ($foto_laporan) {
            Storage::delete('complaint-images/'.$foto_laporan->folder.'/'.$foto_laporan->image);
            $foto_laporan->delete();
            return response()->json(['success' => true]);
            } else {
            return response()->json(['success' => false, 'message' => 'Image not found']);
            }
      }
}

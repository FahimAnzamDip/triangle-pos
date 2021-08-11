<?php

namespace Modules\Upload\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Upload\Entities\Upload;

class UploadController extends Controller
{

    public function filepondUpload(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:png,jpeg,jpg'
        ]);

        if ($request->hasFile('image')) {
            $uploaded_file = $request->file('image');
            $filename = now()->timestamp . '.' . $uploaded_file->getClientOriginalExtension();
            $folder = uniqid() . '-' . now()->timestamp;

            $file = Image::make($uploaded_file)->encode($uploaded_file->getClientOriginalExtension());

            Storage::put('temp/' . $folder . '/' . $filename, $file);

            Upload::create([
                'folder'   => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return false;
    }


    public function filepondDelete(Request $request) {
        $upload = Upload::where('folder', $request->getContent())->first();

        Storage::deleteDirectory('temp/' . $upload->folder);
        $upload->delete();

        return response(null);
    }


    public function dropzoneUpload(Request $request) {
        $path = storage_path('temp/dropzone');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = now()->timestamp . '.' . trim($file->getClientOriginalExtension());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}

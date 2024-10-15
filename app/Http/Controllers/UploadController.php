<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi,txt|max:20480', // 20MB max
        ]);

        $file = $request->file('file');
        $filePath = $file->store('media', 's3');

        // Make the file publicly accessible
        Storage::disk('s3')->setVisibility($filePath, 'public');

        $fileUrl = Storage::disk('s3')->url($filePath);

        return back()->with('success', 'File uploaded successfully.')->with('fileUrl', $fileUrl);
    }

    public function uploadToPath(Request $request, $destinationPath)
    {
        file_put_contents("outputrequpload.txt",print_r($request->all(),1));
        // $request->validate([
        //     'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi,txt|max:20480', // 20MB max
        // ]);

        file_put_contents("output.txt", "here upload 34========");

        $file = $request->file('file');
        $filePath = $file->storeAs($destinationPath, $file->getClientOriginalName(), 's3');

        // Make the file publicly accessible
        Storage::disk('s3')->setVisibility($filePath, 'public');

        $fileUrl = Storage::disk('s3')->url($filePath);

        // return back()->with('success', 'File uploaded successfully.')->with('fileUrl', $fileUrl);
        return $fileUrl;
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Console\Commands\GoogleDrive;
use Illuminate\Support\Facades\Session;

class GoogleDriveController extends Controller
{
    public function googledriveForm()
    {
        return view('googledrive');
    }

    public function upload(Request $request, GoogleDrive $googleDrive)
    {
        $file = $request->file('file');

        if ($file) {
            try {
                $googleDrive->fileUpload($file);
                Session::flash('success', 'ファイルがアップロードされました。');
            } catch (\Exception $e) {
                Session::flash('error', 'ファイルのアップロード中にエラーが発生しました。');
            }
        } else {
            Session::flash('error', 'ファイルが選択されていません。');
        }

        return redirect()->back();
    }

    public function listFiles(GoogleDrive $googleDrive)
    {
        $files = $googleDrive->getFileList();
        return view('googledrive_files', ['files' => $files]);
    }

    public function downloadFile($id, GoogleDrive $googleDrive)
    {
        return $googleDrive->downloadFile($id);
    }
}

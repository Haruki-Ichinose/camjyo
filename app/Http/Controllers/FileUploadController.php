<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Console\Commands\GoogleDrive;
use Illuminate\Support\Facades\Session;

class FileUploadController extends Controller
{
    public function uploadForm()
    {
        return view('upload');
    }

    public function upload(Request $request, GoogleDrive $googleDrive)
    {
        // リクエストからファイルを取得
        $file = $request->file('file');

        // ファイルが存在するか確認
        if ($file) {
            // アップロード処理
            try {
                $googleDrive->fileUpload($file);

                // アップロード成功時のメッセージをセッションに保存
                Session::flash('success', 'ファイルが正常にアップロードされました。');
            } catch (\Exception $e) {
                // アップロード失敗時のメッセージをセッションに保存
                Session::flash('error', 'ファイルのアップロード中にエラーが発生しました。');
            }
        } else {
            // ファイルが選択されていない場合のメッセージをセッションに保存
            Session::flash('error', 'ファイルが選択されていません。');
        }

        return redirect()->back();
    }
}

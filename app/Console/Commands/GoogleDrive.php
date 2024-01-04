<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\GoogleDrive;

class GoogleDrive
{
    /**
     * Googleドライブへの認証を行う
     * @return Google_Service_Drive
     */
    public function getDriveClient(): \Google_Service_Drive
    {
        $client = new \Google_Client();

        // サービスアカウント作成時にダウンロードしたJSONファイルの名前を「client_secret」変更し、configフォルダ内に設置
        $client->setAuthConfig(config_path('crafty-shade-410101-2ecb9abb569f.json'));
        $client->setScopes(['https://www.googleapis.com/auth/drive']);

        return new \Google_Service_Drive($client);
    }

    /* ファイルをアップロードする
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function fileUpload($file)
    {
        $driveClient = $this->getDriveClient();

        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $file->getClientOriginalName(), // アップロードされたファイルの元の名前を使用
            'parents' => ['1LfIahyPnLlPy3i5Y4MePPtD8D-v1DvRv'],
        ]);

        $driveClient->files->create($fileMetadata, [
            'data' => file_get_contents($file->getRealPath()),
            'mimeType' => $file->getClientMimeType(),
            'uploadType' => 'media',
            'fields' => 'id',
        ]);
    }
}
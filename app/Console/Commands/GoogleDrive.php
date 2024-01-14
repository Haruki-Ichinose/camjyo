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
        $client->setAuthConfig(config_path('crafty-shade-410101-0104c9f7269e.json'));
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

     /**
     * Googleドライブにあるファイルの一覧を取得する
     * @return array
     */
    public function getFileList()
    {
        $service = $this->getDriveClient();
        $files = [];
        $response = $service->files->listFiles();
        foreach ($response->getFiles() as $file) {
            $files[] = ['name' => $file->getName(), 'id' => $file->getId()];
        }
        return $files;
    }

    /**
     * 指定されたファイルIDのファイルをダウンロードする
     * @param string $fileId
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile($fileId)
    {
        $service = $this->getDriveClient();
        $response = $service->files->get($fileId, [
            'alt' => 'media'
        ]);

        return response()->streamDownload(function () use ($response) {
            echo $response->getBody()->getContents();
        }, $response->getName());
    }

}

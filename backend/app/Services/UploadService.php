<?php


namespace App\Services;


use Illuminate\Http\UploadedFile;

class UploadService
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function saveFile(UploadedFile $file) {
        $disk = \Storage::getDefaultDriver();
        $randomName = uniqid('img_', true);
        $fullHashName = "{$randomName}.{$file->getClientOriginalExtension()}";

        $storagePath = config("filesystems.disks.{$disk}.storage_path");
        $file->move(storage_path($storagePath), $fullHashName);

        return $this->fileService->createByUploadedFile($file, $fullHashName, join_path($storagePath, $fullHashName), \Storage::getDefaultDriver());
    }
}

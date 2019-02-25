<?php


namespace App\Services;


use App\Repositories\FileRepository;
use Illuminate\Http\UploadedFile;

class FileService
{

    protected $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function createByUploadedFile(UploadedFile $file, $hashName, $storagePath, $drive) {
        return $this->fileRepository->create([
            'original_name' => $file->getClientOriginalName(),
            'hash_name' => $hashName,
            'mime_type' => $file->getClientMimeType(),
            'ext' => $file->getExtension(),
            'size' => $file->getSize(),
            'storage_drive' => $drive,
            'storage_path' => $storagePath
        ]);
    }

    /**
     * 刪除檔案(實體及資料庫)
     * @param $id
     * @return bool
     */
    public function deleteFile($id) {
        $file = $this->fileRepository->find($id);

        if ($file) {
            // 刪除實體檔案
            // 成功後再刪除資料庫檔案
            if ($success = \File::delete(storage_path($file->storage_path))) {
                return $file->delete();
            }
        }

        return false;
    }
}

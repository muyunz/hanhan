<?php


namespace App\Services;


use App\Repositories\AttachmentRepository;

class AttachmentService
{

    /**
     * @var AttachmentRepository
     */
    protected $attachmentRepository;

    protected $fileService;

    public function __construct(AttachmentRepository $attachmentRepository, FileService $fileService)
    {
        $this->attachmentRepository = $attachmentRepository;
        $this->fileService = $fileService;
    }

    public function delete($id, $withFile = false) {
        $attachment = $this->attachmentRepository->find($id);

        if (is_null($attachment)) {
            return false;
        }

        if ($withFile) {
            $this->fileService->deleteFile($attachment->file_id);
        }

        return $this->attachmentRepository->delete($id);
    }


    public function getOneById($id) {
        return $this->attachmentRepository->find($id);
    }

    public function getOneByModel($class, $id) {
        return $this->attachmentRepository->getOneByModel($class, $id);
    }

    public function getOneByModelAndType($class, $id, $type) {
        return $this->attachmentRepository->getOneByModelAndType($class, $id, $type);
    }

    public function attachFile($class, $id, $fileId, $type = null) {
        return $this->attachmentRepository->create([
            'attachable_type' => $class,
            'attachable_id' => $id,
            'file_id' => $fileId,
            'type' => $type
        ]);
    }
}

<?php


namespace App\Repositories;


use App\Models\Attachment;

class AttachmentRepository extends Repository
{
    public function __construct(Attachment $model)
    {
        parent::__construct($model);
    }

    public function getOneByModel($class, $id) {
        return $this->model
            ->where('attachable_type', $class)
            ->where('attachable_id', $id)
            ->first();
    }

    public function getByModel($class) {
        return $this->model
            ->where('attachable_type', $class)
            ->first();
    }

    public function getOneByModelAndType($class, $id, $type) {
        return $this->model
            ->where('attachable_type', $class)
            ->where('attachable_id', $id)
            ->where('type', $type)
            ->first();
    }

}

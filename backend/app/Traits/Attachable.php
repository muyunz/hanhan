<?php


namespace App\Traits;


use App\Models\File;

trait Attachable
{

    public function attachments() {
        return $this
            ->morphToMany(File::class, 'attachable', 'attachments')
            ->withPivot(['type']);
    }

    public function attachFile(File $file, $type = null, $name = null, $description = null) {
        return $this->attachments()->attach($file, [
            'type' => $type,
            'name' => $name,
            'description' => $description
        ]);
    }

}

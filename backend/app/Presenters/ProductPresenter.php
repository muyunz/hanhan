<?php

namespace App\Presenters;


class ProductPresenter extends Presenter
{

    public function item($model)
    {
        $preview = $model->attachments
            ->where('pivot.type', 'preview')
            ->first();
        $model->preview_url = $preview ? url('/storage/' . $preview->hash_name) : null;

        return $model;
    }
}

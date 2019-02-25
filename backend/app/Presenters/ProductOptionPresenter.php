<?php

namespace App\Presenters;


class ProductOptionPresenter extends Presenter
{

    public function item($model)
    {
        $model->price = (float)$model->price;
        return $model;
    }
}

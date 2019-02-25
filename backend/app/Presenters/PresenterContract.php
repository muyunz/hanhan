<?php


namespace App\Presenters;


interface PresenterContract
{

    public function item($model);
    public function collection($items);

}

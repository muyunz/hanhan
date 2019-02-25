<?php


namespace App\Repositories;


class Repository
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
}

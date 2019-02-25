<?php

namespace App\Presenters;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Presenter implements PresenterContract
{

    public function item($model)
    {
        return $model;
    }

    public function collection($items)
    {
        if (is_array($items)) {
            $items = collect($items);
        }

        $items->map(function($item) {
            return $this->item($item);
        });

        return $items;
    }

    public function pagination(LengthAwarePaginator $paginator) {
        $paginator->setCollection($this->collection($paginator->getCollection()));
        return $paginator;
    }
}

<?php


namespace App\Transformers;


use Illuminate\Pagination\LengthAwarePaginator;

class PaginatorTransformer implements TransformerContract
{

    /**
     * @param LengthAwarePaginator $instance
     * @return array
     */
    public function transform($instance)
    {
        $metaFields = [
            "current_page",
//            "first_page_url",
//            "from",
//            "last_page",
//            "last_page_url",
//            "next_page_url",
//            "path",
            "per_page",
//            "prev_page_url",
//            "to",
            "total"
        ];
        return [
            "data" => $instance->getCollection(),
            "meta" => $instance->only($metaFields)
        ];
    }
}

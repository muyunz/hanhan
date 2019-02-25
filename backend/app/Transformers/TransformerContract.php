<?php
/**
 * Created by PhpStorm.
 * User: louis
 * Date: 2019/2/26
 * Time: 4:34 PM
 */

namespace App\Transformers;


interface TransformerContract
{

    public function transform($instance);

}

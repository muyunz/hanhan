<?php


namespace App\Models;


use App\Traits\Attachable;
use Illuminate\Database\Eloquent\Model;

/**
 * 產品
 * Class Product
 * @package App\Models
 */
class Product extends Model
{

    use Attachable;

    protected $guarded = [];

    public function options() {
        return $this->hasMany(ProductOption::class);
    }
}

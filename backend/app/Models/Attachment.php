<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * 附件
 * Class Attachment
 * @package App\Models
 */
class Attachment extends Model
{
    protected $guarded = [];

    public function file() {
        return $this->hasOne(File::class);
    }

    public function scopeType($type) {
        return $this->where('type', $type);
    }
}

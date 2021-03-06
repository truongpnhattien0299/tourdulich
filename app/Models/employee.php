<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $table = "tour_nhanvien";
    protected $primaryKey="nv_id";
    public $timestamps = false;

    public function tours()
    {
        return $this->hasMany('App\Tour', 'loai_id', 'tour_id');
    }
}

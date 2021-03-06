<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitor extends Model
{
    use HasFactory;
    protected $table = "tour_nguoidi";
    protected $primaryKey="nguoidi_id";
    public $timestamps = false;

    public function doantour()
    {
        return $this->hasOne('App\Models\group', 'doan_id', 'doan_id');
    }

}

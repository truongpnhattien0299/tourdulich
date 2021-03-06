<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaitour extends Model
{
    use HasFactory;
    protected $table = "tour_loai";
    protected $primaryKey="loai_id";
    public $timestamps = false;

    public function tours()
    {
        return $this->hasMany('App\Tour', 'loai_id', 'loai_id');
    }
}

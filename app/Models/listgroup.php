<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listgroup extends Model
{
    use HasFactory;
    protected $table = "tour_nguoidi";
    protected $primaryKey="nguoidi_id";
    public $timestamps = false;

    public function group()
    {
        return $this->hasMany('App\Models\visitor', 'doan_id', 'doan_id');
    }

}

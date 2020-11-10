<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listcity extends Model
{
    use HasFactory;
    protected $table = "tour_thanhpho";
    protected $primaryKey="dd_id";
    public $timestamps = false;


    public function location()
    {
        return $this->hasMany('App\Models\location', 'tp_id', 'tp_id');
    }
}

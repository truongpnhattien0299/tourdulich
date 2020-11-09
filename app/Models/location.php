<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;
    protected $table = "tour_diadiem";
    protected $primaryKey="id";
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\listcity', 'id_tp', 'dd_id');
    }
}
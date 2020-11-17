<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tourprice extends Model
{
    use HasFactory;
    protected $table = "tour_gia";
    protected $primaryKey="gia_id";
    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo('App\Models\Tour', 'tour_id', 'tour_id');
    }

    public function doan()
    {
        return $this->hasOne('App\Models\group', 'gia_id', 'gia_id');
    }
}

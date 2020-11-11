<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $table = "tours";
    protected $primaryKey="tour_id";
    public $timestamps = false;

    public function loaitour()
    {
        return $this->belongsTo('App\Models\Loaitour', 'loai_id', 'loai_id');
    }

    public function doantour()
    {
        return $this->belongsTo('App\Models\group', 'tour_id', 'tour_id');
    }
    public function tour_detail()
    {
        return $this->hasMany('App\Models\tourdetail', 'tour_id', 'tour_id');
    }
}

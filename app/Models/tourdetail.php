<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tourdetail extends Model
{
    use HasFactory;
    protected $table = "tour_chitiet";
    protected $primaryKey="ct_id";
    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo('App\Models\Tour', 'tour_id', 'tour_id');
    }
    public function location()
    {
        return $this->belongsTo('App\Models\location', 'dd_id', 'id');
    }

}

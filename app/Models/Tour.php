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
        return $this->belongsTo('App\Models\Loaitour', 'tour_id', 'loai_id');
    }
}

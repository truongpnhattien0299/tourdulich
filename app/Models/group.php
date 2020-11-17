<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;
    protected $table = "tour_doan";
    protected $primaryKey="doan_id";
    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo('App\Models\Tour', 'tour_id', 'tour_id');
    }

    public function visitor()
    {
        return $this->hasMany('App\Models\visitor', 'doan_id', 'doan_id');
    }
    public function listgroup()
    {
        return $this->belongsTo('App\Models\listgroup', 'doan_id', 'doan_id');
    }
}

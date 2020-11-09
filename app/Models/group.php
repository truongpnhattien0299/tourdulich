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

    public function tours()
    {
        return $this->hasMany('App\Tour', 'tour_id', 'tour_id');
    }
}

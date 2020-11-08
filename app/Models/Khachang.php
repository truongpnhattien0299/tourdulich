<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khachang extends Model
{
    use HasFactory;
    protected $table = "tour_khachang";
    protected $primaryKey="kh_id";
    public $timestamps = false;
}

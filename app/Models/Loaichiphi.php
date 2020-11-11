<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaichiphi extends Model
{
    use HasFactory;
    protected $table = "tour_loaichiphi";
    protected $primaryKey="cp_id";
    public $timestamps = false;
}

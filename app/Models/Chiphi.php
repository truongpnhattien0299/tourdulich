<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chiphi extends Model
{
    use HasFactory;
    protected $table = "tour_loaichiphi";
    protected $primaryKey="chiphi_id";
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasReading extends Model
{
    use HasFactory;

    protected $fillable = ['gas_level', 'fire_detected'];
}

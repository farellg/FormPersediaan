<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    use HasFactory;

    protected $table = 'checkout';

    protected $fillable = ['unit', 'tanggal', 'items'];

    protected $casts = [
        'items' => 'array', // Menyimpan data sebagai array atau objek
    ];
}

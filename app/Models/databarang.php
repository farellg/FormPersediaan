<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class databarang extends Model
{
    use HasFactory;
    protected $fillable = ['kode_barang','image_barang','nama_barang','satuan','saldo_disistem'];
    protected $table = 'databarang';
    public $timestamps = false;
}

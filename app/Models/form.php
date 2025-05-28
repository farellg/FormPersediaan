<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form extends Model
{
    use HasFactory;
    protected $fillable = ['nama_barang','jumlah','satuan','keterangan','unit','tanggal','user_id'];
    protected $table = 'form';
}

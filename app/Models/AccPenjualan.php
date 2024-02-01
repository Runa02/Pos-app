<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccPenjualan extends Model
{
    use HasFactory;

    protected $table = 'acc_penjualans';
    protected $guarded = [];

    protected $fillable = ['user_id', 'produk_id','status','jumlah','pesan','total_bayar'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

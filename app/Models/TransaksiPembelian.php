<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pembelians';
    protected $guarded = [];

    public function transaksi_pembelian_barang()
    {
        return $this->hasMany(TransaksiPembelianBarang::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}

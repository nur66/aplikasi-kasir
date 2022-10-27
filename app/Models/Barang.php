<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
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

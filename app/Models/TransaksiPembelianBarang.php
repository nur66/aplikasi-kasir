<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelianBarang extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pembelian_barangs';
    protected $guarded = [];

    public function transaksi_pembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}

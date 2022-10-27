<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $guarded = [];

    public function transaksi_pembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class);
    }

    public function transaksi_pembelian_barang()
    {
        return $this->belongsTo(TransaksiPembelianBarang::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

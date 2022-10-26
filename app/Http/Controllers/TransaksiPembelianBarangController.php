<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiPembelianBarangController extends Controller
{
    public function show(Request $request)
    {
        $barang = Barang::all();
        return view('/transaction.add_transaction')->with('barang', $barang);
    }

    public function store(Request $request)
    {
        $transaksi_pembelian = new TransaksiPembelian();
        $transaksi_pembelian_barang = new TransaksiPembelianBarang();

        $nama_barang = $request->input('nama_barang');
        $harga = $request->input('harga');
        $qty = $request->input('qty');
        $subtotal = $request->input('total');

        $id_barang = Barang::where('id', $nama_barang)->first('id');
        $id_barang = $id_barang->id;

        // $transaksi_pembelian->id = $id_transaction;
        $transaksi_pembelian->total_harga = $subtotal;
        $transaksi_pembelian->save();

        $id_transaksi_pemebelian = TransaksiPembelian::orderBy('created_at', 'DESC')->first('id');
        $id_transaksi_pemebelian = $id_transaksi_pemebelian->id;

        $transaksi_pembelian_barang->transaksi_pembelian_id = $id_transaksi_pemebelian;
        $transaksi_pembelian_barang->barang_id = $id_barang;
        $transaksi_pembelian_barang->jumlah = $qty;
        $transaksi_pembelian_barang->harga_satuan = $harga;
        $transaksi_pembelian_barang->save();

        return redirect('/show-transaction');
    }

    public function showTransaction(Request $request)
    {
        $data = [];
        $transaksi_pembelian = TransaksiPembelian::orderBy('created_at', 'DESC')->first();
        $transaksi_pembelian_barang = TransaksiPembelianBarang::with('barang')->orderBy('created_at', 'DESC')->first();

        $nama_barang = $transaksi_pembelian_barang->barang->nama_barang;

        $data = [
            'id' => $transaksi_pembelian->id,
            'namaBarang' => $nama_barang,
            'harga' => $transaksi_pembelian_barang->harga_satuan,
            'qty' => $transaksi_pembelian_barang->jumlah,
            'subtotal' => $transaksi_pembelian->total_harga
        ];

        return view('transaction.show-transaction')->with('data', $data);
    }

    public function storeInvoice(Request $request)
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Invoice;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'id_transaksi_pembelian' => $transaksi_pembelian->id,
            'id_transaksi_pembelian_barang' => $transaksi_pembelian_barang->id,
            'namaBarang' => $nama_barang,
            'harga' => $transaksi_pembelian_barang->harga_satuan,
            'qty' => $transaksi_pembelian_barang->jumlah,
            'subtotal' => $transaksi_pembelian->total_harga
        ];

        return view('transaction.show-transaction')->with('data', $data);
    }

    public function storeInvoice(Request $request)
    {
        $dateNow = Carbon::parse(now())->format('ymd');
        $string = 'NUR'.$dateNow.'-'.mt_rand(10,100);

        $no_invoice = $string;
        // $no_invoice = 'hardcode_inv_num';
        $tgl_invoice = Carbon::now();
        $pembayaran = $request->pembayaran;
        $kembalian = $request->kembalian;
        $id_transaksi_pemebelian = $request->id_transaksi_pembelian;
        $id_transaksi_pemebelian_barang = $request->id_transaksi_pembelian_barang;

        $trans_p_barang = TransaksiPembelianBarang::with('barang')->where('id', $id_transaksi_pemebelian_barang)->first();
        $id_barang = $trans_p_barang->barang->id;


        $invoice = new Invoice();
        $invoice->no_invoice = $no_invoice;
        $invoice->tgl_invoice = $tgl_invoice;
        $invoice->pembayaran = $pembayaran;
        $invoice->kembalian = $kembalian;
        $invoice->transaksi_pembelian_id = $id_transaksi_pemebelian;
        $invoice->transaksi_pembelian_barang_id = $id_transaksi_pemebelian_barang;
        $invoice->barang_id = $id_barang;
        $invoice->save();

        return redirect('/home');
    }

    // public function searchTransaction(Request $request)
    // {
    //     $search = $request->input('search');
    //     $result = [];

    //     if ($search) {
    //         $invoice = Invoice::where('no_invoice', 'like', "%{$search}%")
    //             ->orWhere('tgl_invoice', 'LIKE',  "%{$search}%")
    //             ->orWhere('pembayaran', 'LIKE',  "%{$search}%")
    //             ->orWhere('kembalian', 'LIKE',  "%{$search}%")
    //             ->get();
    //     } else {
    //         $invoice = Invoice::all();
    //     }

    //     $total = count($invoice);

    //     foreach ($invoice as $row) {
    //         $result[] = [
    //             'id' => $row->id,
    //             'namaBarang' => $row->nama_barang,
    //             'harga' => $row->harga_satuan,
    //             'tanggal' => $row->created_at,
    //             'total' => $total
    //         ];
    //     }

    //     return view('layouts.master')->with('data', $result);
    // }

    public function searchTransaction(Request $request)
    {
        $result = $data = [];
        $search = $request->input('search');

        $inv = Invoice::with([
            'transaksi_pembelian', 'transaksi_pembelian_barang', 'barang'
        ])->where('no_invoice', 'like', "%{$search}%")
        ->orWhere('tgl_invoice', 'LIKE',  "%{$search}%")
        ->orWhere('pembayaran', 'LIKE',  "%{$search}%")
        ->orWhere('kembalian', 'LIKE',  "%{$search}%")
        ->get();


        if(count($inv) == 0){
            return view('not_found');
        }

        // Card
        $pembayaran = $penjualan = $terjual = 0;
        foreach ($inv as $row) {
            $terjual += $row->transaksi_pembelian_barang->jumlah;
            $penjualan += $row->transaksi_pembelian->total_harga;
            $pembayaran += $row->pembayaran;

            $data[] = [
                'id' => $row->id,
                'no_invoice' => $row->no_invoice,
                'qty' => $row->transaksi_pembelian_barang->jumlah,
                'subtotal' => $row->transaksi_pembelian->total_harga,
                'pembayaran' => $row->pembayaran,
                'kembalian' => $row->kembalian,
                'tanggal' => $row->tgl_invoice
            ];
        }

        $best_seller = "SELECT nama_barang FROM barangs WHERE id IN (SELECT barang_id FROM transaksi_pembelian_barangs GROUP BY barang_id ORDER BY COUNT(barang_id) DESC) LIMIT 1";
        $best_seller = DB::select($best_seller);
        $best_seller = $best_seller[0]->nama_barang;

        $result = [
            'Terjual' => $terjual,
            'Penjualan' => $penjualan,
            'Pembayaran' => $pembayaran,
            'Best_seller' => $best_seller,
            'data' => $data
        ];

        return view('layouts.master')->with('data', $result);
    }
}

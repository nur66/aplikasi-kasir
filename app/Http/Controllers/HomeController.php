<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Invoice;
use App\Models\TransaksiPembelianBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result = $data = [];
        $inv = Invoice::with([
            'transaksi_pembelian', 'transaksi_pembelian_barang', 'barang'
        ])->get();

        // Card
        $pembayaran = $penjualan = $terjual = 0;
        foreach($inv as $row){
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

    public function delete(Request $request)
    {
        if(Auth::user()){
            $id = $request->id;
            Invoice::where('id',$id)->delete();

            return redirect('/home');
        } else {
            return redirect('/');
        }
    }

    public function print(Request $request)
    {
        if(Auth::user()){
            $id = $request->id;

            $data = Invoice::with([
                'transaksi_pembelian', 'transaksi_pembelian_barang', 'barang'
            ])->where('id', $id)->first();
            
            // $data = Invoice::where('id', $id)->first();
            // return redirect('/home');
            return view('invoice.invoice')->with('data', $data);
        } else {
            return redirect('/');
        }
    }
}

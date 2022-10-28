<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BarangController extends Controller
{
    public function read(Request $request)
    {
        $result = [];
        $user = User::where('email', 'nuriswanto66@gmail.com');

        $barang = Barang::all();
        $total = count($barang);

        foreach ($barang as $row) {
            $result[] = [
                'id' => $row->id,
                'namaBarang' => $row->nama_barang,
                'harga' => $row->harga_satuan,
                'tanggal' => $row->created_at,
                'total' => $total
            ];
        }

        // return view('crud.show_all_product', [
        //     'barang' => $result
        // ]);

        return view('crud.show_all_product')->with('barang', $result);
    }

    public function add(Request $request)
    {
        return view('crud.add_product');
    }

    public function store(Request $request)
    {
        if (Auth::user()) {

            Barang::create([
                'nama_barang' => $request->nama,
                'harga_satuan' => $request->harga,
            ]);
            return redirect('/show-all-product');
        } else {
            return redirect('/');
        }
    }

    public function edit(Request $request)
    {
        if (Auth::user()) {
            $id = $request->id;

            $result = Barang::where('id', $id)->get();

            return view('crud.edit_product', [
                'params_barang' => $result
            ]);
        } else {
            return redirect('/');
        }
    }

    public function editStore(Request $request)
    {
        if (Auth::user()) {

            Barang::where('id', $request->id)->update([
                'nama_barang' => $request->nama,
                'harga_satuan' => $request->harga
            ]);
            return redirect('/show-all-product');
        } else {
            return redirect('/');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $result = [];

        if ($search) {
            $barang = Barang::where('nama_barang', 'like', "%{$search}%")
                ->orWhere('harga_satuan', 'LIKE',  "%{$search}%")
                ->get();
        } else {
            $barang = Barang::all();
        }

        $total = count($barang);

        foreach ($barang as $row) {
            $result[] = [
                'id' => $row->id,
                'namaBarang' => $row->nama_barang,
                'harga' => $row->harga_satuan,
                'tanggal' => $row->created_at,
                'total' => $total
            ];
        }

        return view('crud.show_all_product')->with('barang', $result);
    }

    public function delete(Request $request)
    {
        if(Auth::user()){
            $id = $request->id;
            Barang::where('id',$id)->delete();

            return redirect('/show-all-product');
        } else {
            return redirect('/');
        }
    }
}

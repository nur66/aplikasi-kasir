<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function read()
    {
        // return view('crud.read', [
        //     'menu' => Barang::all()
        // ]);
        $result = [];
        $result = Barang::all();
        return view('crud.show_all_product', [
            'barang' => $result
        ]);
    }
}

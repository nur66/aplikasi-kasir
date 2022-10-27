<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="col-lg-6 col-md-6 col-sm-6 pt-5 px-5 print-show">
        <div class="container">
            <div class="text-center mb-5 pt-2">
                <h2 class="mb-3" style="font-size:60px;">Nur Shop</h2>
                <h2 class="mb-0">Tiban MC Dermott</h2>
                <h2 class="mb-4">Telp : 081261518980</h2>
            </div>
            <h2 class="mb-1">Invoice : {{ $data->no_invoice }}
                <span class="float-right">Kasir : Nur Iswanto</span>
            </h2>
            <h2 class="mb-1">Tanggal : {{ $data['tgl_invoice'] }}</h2>
            <div class="row">
                <div class="col-12 py-3 my-3 border-top border-bottom">
                    <div class="row">
                        <div class="col-5">
                            <h2 class="mb-0 py-1" style="font-weight:700;">Description</h2>
                        </div>
                        <div class="col-2">
                            <h2 class="mb-0 py-1" style="font-weight:700;">Harga</h2>
                        </div>
                        <div class="col-2">
                            <h2 class="mb-0 py-1" style="font-weight:700;">Qty</h2>
                        </div>
                        <div class="col-3">
                            <h2 class="mb-0 py-1" style="font-weight:700;">Jumlah</h2>
                        </div>
                    </div>
                </div>
    
                <div class="col-12">
                    <div class="row">
                        <div class="col-5">
                            <h2 class="mb-0 py-1" style="font-weight:500;">{{ $data->barang->nama_barang }}</h2>
                        </div>
                        <div class="col-2">
                            <h2 class="mb-0 py-1" style="font-weight:500;">{{ $data->barang->harga_satuan }}</h2>
                        </div>
                        <div class="col-2">
                            <h2 class="mb-0 py-1" style="font-weight:500;">{{ $data->barang->harga_satuan }}</h2>
                            {{-- <h2 class="mb-0 py-1" style="font-weight:500;">{{ $data->transaksi_pembalian_barang->jumlah }}</h2> --}}
                        </div>
                        <div class="col-3">
                            <h2 class="mb-0 py-1" style="font-weight:500;">{{ $data->barang->harga_satuan }}</h2>
                            {{-- <h2 class="mb-0 py-1" style="font-weight:500;">{{ $data->transaksi_pembalian->total_harga }}</h2> --}}
                        </div>
                    </div>
                </div>
    
                <div class="col-12 py-3 my-3 border-top">
                    <div class="row justify-content-end">
    
                        <div class="col-3 text-right border-bottom">
                            <h2 class="mb-1" style="font-weight:700;">Total <span class="ml-3">:</span></h2>
                            <h2 class="mb-1" style="font-weight:500;">Tunai <span class="ml-3">:</span></h2>
                            <h2 class="mb-1" style="font-weight:500;">Kembali <span class="ml-3">:</span></h2>
                        </div>
                        <div class="col-3 border-bottom">
                            <h2 class="mb-1" style="font-weight:700;">{{ $data->barang->harga_satuan }}</h2>
                            {{-- <h2 class="mb-1" style="font-weight:700;">{{ $data->transaksi_pembalian->total_harga }}</h2> --}}
                            <h2 class="mb-1" style="font-weight:500;">{{ $data->pembayaran }}</h2>
                            <h2 class="mb-1" style="font-weight:500;">{{ $data->kembalian }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-5">
                    <h2>* Terima Kasih Telah Berbelanja Di Nur Shop *</h2>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>

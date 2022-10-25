{{-- @extends('layouts.app')  --}}

@section('content')
<div class="container-fluid"> <!--d-flex justify-content-center -->
    <div class="col-md-8">
        <h1>Tambah Menu</h1>
        <form action="{{ url('/create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="" class="form-control" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <label for="kadaluarsa">Harga</label>
                <input type="number" name="harga" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="toko">Toko</label>
                <select name="id_toko" id="toko" class="form-control">
                    @foreach($toko as $item)
                    <option value="{{ $item->id }}">{{ $item->namaToko }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" accept="image/*" name="gambar" id="">
            </div>
            <div class="input-group">
                <input type="submit" value="Save" class="btn btn-success"> &nbsp;
                <input type="reset" value="Reset" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>
@endsection


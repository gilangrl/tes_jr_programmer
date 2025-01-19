@extends('default')
@push('style')
@endpush

@section('pageContent')
    <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menambahkan metode PUT untuk update -->

        <div class="mb-3 mt-3">
            <label for="simpleinput" class="form-label">Nama Produk</label>
            <input type="text" id="simpleinput" name="nama_produk" class="form-control"
                value="{{ old('nama_produk', $produk->nama_produk) }}" required>
        </div>

        <div class="mb-3 mt-3">
            <label for="simpleinput" class="form-label">Harga</label>
            <input type="number" id="simpleinput" name="harga" class="form-control"
                value="{{ old('harga', $produk->harga) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <select class="form-select" name="nama_kategori" aria-label="Default select example">
                @foreach ($kategori as $row)
                    <option value="{{ $row->id_kategori }}"
                        {{ $row->id_kategori == $produk->kategori_id ? 'selected' : '' }}>{{ $row->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="nama_status" aria-label="Default select example">
                @foreach ($status as $row)
                    <option value="{{ $row->id_status }}" {{ $row->id_status == $produk->status_id ? 'selected' : '' }}>
                        {{ $row->nama_status }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Update</button>
    </form>
@endsection

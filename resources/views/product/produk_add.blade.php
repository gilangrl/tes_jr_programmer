@extends('default')
@push('style')
@endpush

@section('pageContent')
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="simpleinput" class="form-label">Nama Produk</label>
            <input type="text" id="simpleinput" name="nama_produk" class="form-control" required>
        </div>
        
        <div class="mb-3 mt-3">
            <label for="simpleinput" class="form-label">Harga</label>
            <input type="number" id="simpleinput" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <select class="form-select" name="nama_kategori" aria-label="Default select example">
                @foreach ($kategori as $row)
                    <option value="{{ $row->id_kategori }}">{{ $row->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="nama_status" aria-label="Default select example">
                @foreach ($status as $row)
                    <option value="{{ $row->id_status }}">{{ $row->nama_status }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
@endsection

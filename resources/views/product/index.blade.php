@extends('default')
@push('style')
@endpush

@section('pageContent')
    <div class="content__wrap">
        <div class="btn__ctaData">
            <span class="btn__Inpdata">
                <a href="/produk/create" class="btn__cta"><i class="fa fa-plus"></i>Tambah Data</a>
            </span>
            <form action="{{ route('produk.import') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Ambil Data dari API</button>
            </form>

        </div>
        <table id="tableProduct" class="display dataTable" style="width:100%">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Nama Produk
                    </th>
                    <th>
                        Harga Produk
                    </th>
                    <th>
                        Kategori
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $row)
                
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}.</td>
                        <td>{{ $row->nama_produk }}</td>
                        <td data-sort="{{ $row->harga }}">Rp {{ number_format($row->harga, 2, ',', '.') }}</td>
                        <td>{{ $row->kategori->nama_kategori }}</td>
                        <td>{{ $row->status->nama_status }}</td>
                        <td class="text-center">
                            <div class="row">
                                <a href="/produk/edit/{{$row->id_produk}}" class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn__destroyCta btn-sm col-6 btnDelete"
                                    href="{{ route('produk.destroy', $row->id_produk) }}"
                                    data-nama="{{ $row->nama_produk }}">
                                    <i class="fa fa-trash"> </i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $('.btnDelete').on('click', function() {
            var href = $(this).attr('href');
            var nama = $(this).data('nama');
            Swal.fire({
                    title: "Anda yakin untuk menghapus data produk : \"" + nama + "\"?",
                    text: "Setelah dihapus, data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, hapus',
                    customClass: 'sweetAlert__class'
                })
                .then((willDelete) => {
                    if (willDelete.value) {
                        $('#deleteForm').attr('action', href);
                        $('#deleteForm').submit();
                    }
                })
        });
    </script>
@endpush

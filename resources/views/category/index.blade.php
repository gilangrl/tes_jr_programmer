@extends('default')
@push('style')
@endpush

@section('pageContent')
<div class="content__wrap">
    <div class="btn__ctaData">
        <span class="btn__Getdata">
        </span>
        <span class="btn__Inpdata">
            <button type="button" class="btn__cta" data-toggle="modal" data-target="#tambahKategori" id="btnTambah"
                name="btnTambah">
                <i class="fa fa-plus"></i>
                Tambah Data
            </button>
        </span>
    </div>
    <table id="tableProduct" class="display dataTable" style="width:100%">
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Nama Kategori
                </th>
                <th>
                    Deskripsi
                </th>
                <th>
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $row)
            <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td>{{ $row->nama_kategori }}</td>
                <td>{{ $row->deskripsi_kategori }}</td>
                <td class="text-center">
                    <div class="row">
                        <button class="btn btn-sm col-6 btn__editCta border-0 shadow-0 outline-0 btnEdit"
                            href="{{ route('kategori.update', $row->id) }}" data-nama="{{ $row->nama_kategori }}"
                            data-desc="{{ $row->deskripsi_kategori }}"><i class="fa fa-edit">
                            </i></button>

                        <button class="btn btn__destroyCta btn-sm col-6 btnDelete"
                            href="{{ route('kategori.destroy', $row->id) }}" data-nama="{{ $row->nama_kategori }}">
                            <i class="fa fa-trash"> </i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Category -->
<div id="tambahKategori" name="tambahKategori" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="tambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKategoriLabel"><b>tambahKategori Data Reward</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insertForm" action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="inputNama">Nama Kategori</label><br>
                        <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama kategori...
                        " required>
                    </div>
                    <div class="form-group">
                        <label for="inputDeskripsi">Deskripsi</label><br>
                        <input type="textarea" class="form-control" id="inputDeskripsi" name="inputDeskripsi"
                            placeholder="Deskripsi kategori...">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btnSave">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Category -->
<div id="editKategori" name="editKategori" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel"><b>Edit Data Reward</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="inputedNama">Nama Kategori</label><br>
                        <input type="text" class="form-control" id="inputedNama" name="inputedNama"
                            placeholder="Nama kategori..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputedDeskripsi">Deskripsi</label><br>
                        <input type="textarea" class="form-control" id="inputedDeskripsi" name="inputedDeskripsi"
                            placeholder="Deskripsi kategori...">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btnSave">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('.btnEdit').on('click', function(){
        $('#inputedNama').val($(this).data('nama'));
        $('#inputedDeskripsi').val($(this).data('desc'));
        $('#updateForm').attr('action', $(this).attr('href'));
        $('#editKategori').modal('show');
    });

    $('.btnDelete').on('click', function() {
        var href = $(this).attr('href');
        var nama = $(this).data('nama');
        Swal.fire({
                title: "Anda yakin untuk menghapus data kategori : \"" + nama + "\"?",
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
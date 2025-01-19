@if (session('success'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{{ session("success") }}',
        showConfirmButton: false,
        customClass: 'sweetAlert__success'
    })
</script>
@endif



<script>
    $('button#delete').on('click', function() {
        var href = $(this).attr('href');
        var nama = $(this).data('nama');
        Swal.fire({
                title: "Anda yakin untuk menghapus data : \"" + nama + "\"?",
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
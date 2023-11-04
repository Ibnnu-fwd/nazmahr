@if (Session::has('success'))
    Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ Session::get('success') }}',
    showConfirmButton: false,
    })
@endif

@if (Session::has('error'))
    Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ Session::get('error') }}',
    showConfirmButton: false,
    })
@endif

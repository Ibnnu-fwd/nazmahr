@if (Session::has('success'))
    Swal.fire(
    'Berhasil!',
    '{{ Session::get('success') }}',
    'success'
    )
@endif

@if (Session::has('error'))
    Swal.fire(
    'Gagal!',
    '{{ Session::get('error') }}',
    'error'
    )
@endif

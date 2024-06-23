@php
    $currentRouteName = Route::currentRouteName();
@endphp
<div class="d-flex">
    <a href="{{ route('employees.show', ['employee' => $employee->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
    <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>

    <div>
        <form action="{{ route('employees.destroy', ['employee' => $employee->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-trash"></i></button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".deleteBtn").click(function(){
            var id = $(this).data('id');
                Swal.fire({
                    title : 'Apakah Anda Yakin ?',
                    text : "Anda tidak akan dapat mengembalikan ini!",
                    icon : 'warning',
                    showCancelButton : true,
                    confirmButtonColor : '#d33',
                    cancelButtonColor : '#3085d6',
                    confirmButtonText : "Ya, Hapus Data!"
                }).then((result) => {
                    if(result.isConfirmed){
                       $.ajax({
                        type: "POST",
                        url: "{{ route('data.destroy') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success : function(response) {
                            Swal.fire({ 
                                title : "Sukses !",
                                text : "Data Berhasil Dihapus!",
                                icon : "success"
                            }).then((result) => {
                                location.reload();
                            })
                        },
                        error : function(error) {
                            Swal.fire({
                                icon : 'error',
                                title : 'Oops...',
                                text : "Terjadi Kesalahan!"
                            })
                        }
                       })
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire (
                            'Batal',
                            'Tidak ada perubahan yang dilakukan.',
                            'info'
                        ).then((result) => {
                            location.reload();
                        })
                    }
                }
            )
            })
        })
</script>


@extends('templates.layout')

@push('style')

@endpush

@section('content')
<section class="content">

<!-- Default box -->
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">produk</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
        </button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
            @foreach ($errors->all() as $errors)
            <li>{{ $errors }}</li>
            @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormProduk">
            Tambah Produk
        </button>
        @include('produk.data')
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@include('produk.from')
</section>
@endsection

@push('script')
    <script>
        $('#tbl-produk').DataTable()

        $('.alert-success').fadeTo(2000,500).slideUp(500, function(){
             $('.alert-success').slideUp(500)
        })
        $('.alert-danger').fadeTo(2000,500).slideUp(500, function(){
            $('.alert-danger').slideUp(500)
        })

        console.log($('.delete-data'))

        $('.delete-data').on('click', function(e){
        e.preventDefault()
        const data = $(this).closest('tr').find('td:eq(1)').text()
        Swal.fire({
            title: `Apakah data <span style="color:red">${data}</span> akan dihapus?`,
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data ini!'
        }).then((result) => {
            if (result.isConfirmed)
              $(e.target).closest('form').submit()
            else swal.close()
        })
    })

    $('#modalFormProduk').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        console.log(btn.data('mode'))
        const mode = btn.data('mode')
        const nama_produk = btn.data('nama_produk')
        const kode = btn.data('kode')
        const stock = btn.data('stock')
        const harga = btn.data('harga')
        const kategori = btn.data('kategori')
        const id = btn.data('id')
        const modal = $(this)
        if(mode === 'edit'){
            modal.find('.modal-title').text('Edit Data Produk')
            modal.find('#nama_produk').val(nama_produk)
            modal.find('#kode').val(kode)
            modal.find('#stock').val(stock)
            modal.find('#harga').val(harga)
            modal.find('#kategori').val(kategori)
            console.log(nama_produk)
            modal.find('.modal-body form').attr('action','{{ url('produk')}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        }else{
            modal.find('.modal-title').text('Input Data Produk')
            modal.find('#nama_produk').val('')
            modal.find('#kode').val('')
            modal.find('#stock').val('')
            modal.find('#harga').val('')
            modal.find('#kategori').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action','{{ url('produk') }}')
        }
    })
    </script>
@endpush


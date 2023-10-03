@extends('templates.layout')

@push('style')

@endpush

@section('content')
<section class="content">

<!-- Default box -->
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">Barang</h3>

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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormBarang">
            Tambah barang
        </button>
        @include('barang.data')
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@include('barang.from')
</section>
@endsection

@push('script')
    <script>
        $('#tbl-barang').DataTable()

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

    $('#modalFormBarang').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const kode_barang = btn.data('kode_barang')
        const produk_id = btn.data('produk_id')
        const nama_barang = btn.data('nama_barang')
        const satuan = btn.data('satuan')
        const harga_jual = btn.data('harga_jual')
        const stok = btn.data('stok')
        const ditarik = btn.data('ditarik')
        const user_id = btn.data('user_id')
        const id = btn.data('id')
        const modal = $(this)
        if(mode === 'edit'){
            modal.find('.modal-title').text('Edit Data pelanggan')
            modal.find('#kode_barang').val(kode_barang)
            modal.find('#produk_id').val(produk_id)
            modal.find('#nama_barang').val(nama_barang)
            modal.find('#satuan').val(satuan)
            modal.find('#harga_jual').val(harga_jual)
            modal.find('#stok').val(stok)
            modal.find('#ditarik').val(ditarik)
            modal.find('#user_id').val(user_id)
            modal.find('.modal-body form').attr('action','{{ url('barang')}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        }else{
            modal.find('.modal-title').text('Input Data pelanggan')
            modal.find('#kode_barang').val('')
            modal.find('#produk_id').val('')
            modal.find('#nama_barang').val('')
            modal.find('#satuan').val('')
            modal.find('#harga_satuan').val('')
            modal.find('#stok').val('')
            modal.find('#ditarik').val('')
            modal.find('#user_id').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action','{{ url('barang') }}')
        }
    })
    </script>
@endpush
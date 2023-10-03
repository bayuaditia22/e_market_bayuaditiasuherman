@extends('templates.layout')

@push('style')

@endpush

@section('content')
<section class="content">

<!-- Default box -->
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">History Pembelian</h3>

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
    <a href="{{ route('export-pembelian')}}" class="btn btn-success">
        <i class="fa fa-file-excel"></i> Export
    </a>

<table class="table table-compact table stripped" id="tbl-pemasok">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Masuk</th>
            <th>Tanggal Masuk</th>
            <th>Total</th>
            <th>Nama Pemasok</th>
            <th>Nama User</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembelian  as $p)
            <tr>
                <td>{{ $i = !isset ($i) ? ($i = 1) : ++$i }}</td>
                <td>{{ $p->kode_masuk }}</td>
                <td>{{ $p->tanggal_masuk }}</td>
                <td>{{ $p->totalHarga }}</td>
                <td>{{ $p->nama_pemasok }}</td>
                <td>{{ $p->nama_pemasok }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@include('pemasok.from')
</section>
@endsection





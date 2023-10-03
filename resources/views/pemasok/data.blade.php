<table class="table table-compact table stripped" id="tbl-pemasok">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Pemasok</th>
            <th>Tools</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemasok  as $p)
            <tr>
                <td>{{ $i = !isset ($i) ? ($i = 1) : ++$i }}</td>
                <td>{{ $p->nama_pemasok }}</td>
                <td>
                    <button class="btn text-warning" data-toggle="modal" data-target="#modalFormPemasok" data-mode="edit"
                        data-id="{{ $p->id }}" data-nama_pemasok="{{ $p->nama_pemasok }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="post" action="{{ route('pemasok.destroy', $p->id) }}" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn text-danger delete-data" data-nama="{{ $p->nama_pemasok }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



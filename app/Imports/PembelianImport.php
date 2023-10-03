<?php

namespace App\Imports;

use App\Models\Paket;
use Maatwebsite\Excel\Concerns\ToModel;

class PembelianImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Paket([
            'id_outlet' =>auth()->user()->id_outlet,
            'jenis' => $row['jenis'],
            'nama_paket' => $row['nama_paket'],
            'harga' => $row['harga'],
        ]);
    }
    public function headingRow(): int
    {
        return 3;
    }
}

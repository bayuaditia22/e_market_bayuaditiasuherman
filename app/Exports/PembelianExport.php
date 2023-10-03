<?php

namespace App\Exports;

use App\Models\Pembelian;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use App\Exports\PaketExport;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class PembelianExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pembelian::get();
    }

    public function exportData() {
        $date = date('Y-m-d');
        return Excel::download(new PembelianExport, $date.'_paket.xlsx');
    }
    public function headings(): array
    {
        return[
            'No.',
            'ID Outlet',
            'Jenis',
            'Nama Paket',
            'Harga',
            'Tanggal Input',
            'Tanggal Update',
        ];
    }

    public function registerEvents(): array
    {
        return[
            AfterSheet::class  => function(AfterSheet $event) {
                $event->sheet->grtColumnDimension('A')->setAutoSize(true);
                $event->sheet->grtColumnDimension('B')->setAutoSize(true);
                $event->sheet->grtColumnDimension('C')->setAutoSize(true);
                $event->sheet->grtColumnDimension('D')->setAutoSize(true);
                $event->sheet->grtColumnDimension('E')->setAutoSize(true);
                $event->sheet->grtColumnDimension('F')->setAutoSize(true);
                $event->sheet->grtColumnDimension('G')->setAutoSize(true);

                $event->sheet->insertNewRoeBefore(1, 2);
                $event->sheet->mergeCells('A1, G1');
                $event->sheet->setCellValue('A1','Data Paket Pembelian');
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A3:G' .$event->sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \phpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000']
                        ]
                    ]
                ]);
            }
        ];
    }
}

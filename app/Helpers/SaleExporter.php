<?php

namespace App\Helpers;

use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


// class Exporter implements FromCollection,ShouldAutoSize
// {
//     public function collection()
//     {
//     	$users = DB::table('users')->select('name', 'email as user_email')->get()->toArray();
//         return $users;
//     }
// }

class SaleExporter implements FromCollection, withHeadings, WithMapping, ShouldAutoSize, WithEvents, WithColumnFormatting
{

    /**
     * @var User $users
     */
    function __construct($sales)
    {
        $this->sales = $sales;
    }
    public function headings(): array
    {
        return [
            'بەروار',
            'کات',
            'جۆر',
            'ژ.وەصل',
            'ناوی کڕیار',
            ' شار',
            ' گەڕەك',
            ' کۆڵان',            
            ' ماڵ',
            ' تێل',
            'کۆی گشتی',
            'سماح',
            ' کۆی داواکراو',
            'پێشەکی',
        ];
    }
    public function map($sale): array
    {
        return [
            $sale->created_at->format('d-m-Y'),
            $sale->created_at->format('h:m:i'),
            $sale->installments == 0 ? 'نقد' : 'قیست',
            $sale->id,
            $sale->customer->name,
            $sale->customer->city,
            $sale->customer->garak,
            $sale->customer->kolan,
            $sale->customer->mal,
            $sale->customer->tel,
            $sale->total + $sale->discount,
            $sale->discount,
            $sale->remainedAmount(),
            $sale->initial_amount,
        ];
    }
    public function collection()
    {
        return $this->sales;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 16, 'height' => '100']],
        ];
    }
    public function registerEvents(): array
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
            $sheet->getRowDimension(1)->setRowHeight(20);
            $sheet->getStyle('1')->getFont()
                ->setSize(14)
                ->setBold(true);
            $sheet->getStyle('A2:Z999')->getFont()
                ->setSize(13);

            // ->getColor()->setRGB('0000ff');
        });
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->styleCells(
                    'A1:J1',
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['argb' => 'd3d6ba']
                        ]
                    ]
                );
            },
        ];
    }
    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_CURRENCY_USD,
            'H' => NumberFormat::FORMAT_CURRENCY_USD,
            'I' => NumberFormat::FORMAT_CURRENCY_USD,
        ];
    }
}

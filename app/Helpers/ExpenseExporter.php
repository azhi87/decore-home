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
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// class Exporter implements FromCollection,ShouldAutoSize
// {
//     public function collection()
//     {
//     	$users = DB::table('users')->select('name', 'email as user_email')->get()->toArray();
//         return $users;
//     }
// }

class ExpenseExporter implements FromCollection, withHeadings, WithMapping, ShouldAutoSize, WithEvents
{

    /**
     * @var User $users
     */
    function __construct($expenses)
    {
        $this->expenses = $expenses;
    }
    public function headings(): array
    {
        return [
            'ناوی کارمەند',
            'لق',
            'دینار',
            'دۆلار',
            ' کۆ',
            'هۆکار',
            'بەروار',
            ' تێبینی',
        ];
    }
    public function map($expense): array
    {
        return [
            $expense->user->name,
            $expense->branch->name,
            $expense->dinars,
            $expense->dollars,
            $expense->amount,
            $expense->reason,
            $expense->created_at,
            $expense->note
        ];
    }
    public function collection()
    {
        return $this->expenses;
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
                    'A1:H1',
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
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'D' => NumberFormat::FORMAT_CURRENCY_USD,
        ];
    }
}

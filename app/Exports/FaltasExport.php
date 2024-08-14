<?php

namespace App\Exports;

use App\Models\Falta;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class FaltasExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public $falta_empleado;
    public $falta_tipo;
    public $fecha1;
    public $fecha2;
    public $area;
    public $localidad;


    public function __construct($localidad, $area, $falta_empleado, $falta_tipo, $fecha1, $fecha2)
    {
        $this->falta_empleado = $falta_empleado;
        $this->falta_tipo = $falta_tipo;
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;
        $this->area = $area;
        $this->localidad = $localidad;

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Falta::with('persona', 'justificacion')
                        ->when (isset($this->localidad) && $this->localidad != "", function($q){
                            return $q->whereHas('persona', function($q){
                                $q->where('localidad', $this->localidad);
                            });
                        })
                        ->when (isset($this->area) && $this->area != "", function($q){
                            return $q->whereHas('persona', function($q){
                                $q->where('area', $this->area);
                            });
                        })
                        ->when(isset($this->falta_empleado) && $this->falta_empleado != "", function($q){
                            return $q->where('persona_id', $this->falta_empleado);
                        })
                        ->when(isset($this->falta_tipo) && $this->falta_tipo != "", function($q){
                            return $q->where('tipo', 'like','%'.$this->falta_tipo.'%');
                        })
                        ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                        ->get();
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(storage_path('app/public/img/logo2.png'));
        $drawing->setHeight(90);
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function headings(): array
    {
        return [
            'Tipo',
            'Empleado',
            'Justificación',
            'Registrado en',
        ];
    }

    public function map($falta): array
    {
        return [
            $falta->tipo,
            $falta->persona->nombre . ' ' . $falta->persona->ap_paterno . ' ' . $falta->persona->ap_materno,
            $falta->justificacion ? 'Justificada':'Sin Justificar' ,
            $falta->created_at,
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de Faltas (Sistema de Gestión Personal)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de faltas (Sistema de Gestión Personal)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
                $event->sheet->getRowDimension('1')->setRowHeight(90);
                $event->sheet->getStyle('A2:G2')->applyFromArray([
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );
            },
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function columnWidths(): array
    {
        return [
            'E' => 20,
            'F' => 20,

        ];
    }
}

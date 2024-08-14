<?php

namespace App\Exports;

use App\Models\Incapacidad;
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

class IncapacidadesExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public $incapacidades_folio;
    public $incapacidades_tipo;
    public $incapacidades_empleado;
    public $fecha1;
    public $fecha2;
    public $area;

    public function __construct($area, $incapacidades_folio, $incapacidades_tipo, $incapacidades_empleado, $fecha1, $fecha2)
    {
        $this->incapacidades_folio = $incapacidades_folio;
        $this->incapacidades_tipo = $incapacidades_tipo;
        $this->incapacidades_empleado = $incapacidades_empleado;
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;
        $this->area = $area;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Incapacidad::with('creadoPor', 'actualizadoPor','persona')
                                ->when (isset($this->area) && $this->area != "", function($q){
                                    return $q->whereHas('persona', function($q){
                                        $q->where('area', $this->area);
                                    });
                                })
                                ->when(isset($this->incapacidades_folio) && $this->incapacidades_folio != "", function($q){
                                    return $q->where('folio', $this->incapacidades_folio);

                                })
                                ->when(isset($this->incapacidades_tipo) && $this->incapacidades_tipo != "", function($q){
                                    return $q->where('tipo','like', '%'.$this->incapacidades_tipo.'%');

                                })->when(isset($this->incapacidades_empleado) && $this->incapacidades_empleado != "", function($q){
                                    return $q->where('persona_id', $this->incapacidades_empleado);
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
            'Folio',
            'Tipo',
            'Empleado',
            'Registrado por',
            'Actualizado por',
            'Registrado en',
            'Actualizado en'
        ];
    }

    public function map($incapacidad): array
    {
        return [
            $incapacidad->folio,
            $incapacidad->tipo,
            $incapacidad->persona->nombre . ' ' . $incapacidad->persona->ap_paterno . ' ' . $incapacidad->persona->ap_materno,
            $incapacidad->creado_por ? $incapacidad->creadoPor->name : 'N/A',
            $incapacidad->actualizado_por ? $incapacidad->actualizadoPor->name : 'N/A',
            $incapacidad->created_at,
            $incapacidad->updated_at,
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de incapacidades (Sistema de Gestión Personal)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de incapacidades (Sistema de Gestión Personal)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:G1')->applyFromArray([
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
                $event->sheet->getStyle('A2:K2')->applyFromArray([
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

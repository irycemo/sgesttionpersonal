<?php

namespace App\Exports;

use App\Models\PermisoPersona;
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

class PermisosExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

        public $personaPermiso;
        public $permisoPermiso;
        public $fecha_inicioPermiso;
        public $fecha_finalPermiso;
        public $fecha1;
        public $fecha2;
        public $area;

    public function __construct($area, $personaPermiso,$permisoPermiso, $fecha_inicioPermiso, $fecha_finalPermiso, $fecha1, $fecha2)
    {
        $this->personaPermiso = $personaPermiso;
        $this->permisoPermiso = $permisoPermiso;
        $this->fecha_inicioPermiso = $fecha_inicioPermiso;
        $this->fecha_finalPermiso = $fecha_finalPermiso;
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;
        $this->area = $area;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PermisoPersona::with('persona', 'permiso', 'creadoPor')
                                ->when (isset($this->area) && $this->area != "", function($q){
                                    return $q->whereHas('persona', function($q){
                                        $q->where('area', $this->area);
                                    });
                                })
                                ->when (isset($this->personaPermiso) && $this->personaPermiso != "", function($q){
                                    return $q->where('persona_id', $this->personaPermiso);
                                })
                                ->when (isset($this->permisoPermiso) && $this->permisoPermiso != "", function($q){
                                    return $q->where('permisos_id', $this->permisoPermiso);
                                })
                                ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
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
            'Empleado',
            'Descripción',
            'Fecha Inicial',
            'Fecha Final',
            'Tiempo Consumido (min)',
            'Registrado Por',
            'Registrado en',
        ];
    }

    public function map($permiso): array
    {
        return [
            $permiso->persona->nombre . ' ' . $permiso->persona->ap_paterno . ' ' . $permiso->persona->ap_materno,
            $permiso->permiso->descripcion,
            $permiso->fecha_inicio,
            $permiso->fecha_final,
            $permiso->tiempo_consumido ? $permiso->tiempo_consumido : 'N/A',
            $permiso->creado_por ? $permiso->creadoPor->name : 'N/A',
            $permiso->created_at,
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de permisos (Sistema de Gestión Personal)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de permisos (Sistema de Gestión Personal)\n" . now()->format('d-m-Y'));
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
                $event->sheet->getStyle('A2:I2')->applyFromArray([
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

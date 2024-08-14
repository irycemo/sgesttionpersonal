<?php

namespace App\Exports;

use App\Models\Persona;
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

class PersonalExport implements FromCollection, WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public $status_empleado;
    public $localidad_empleado;
    public $area_empleado;
    public $tipo_empleado;
    public $horario_empleado;
    public $fecha1;
    public $fecha2;

    public function __construct($status_empleado, $localidad_empleado, $area_empleado, $tipo_empleado, $horario_empleado, $fecha1, $fecha2)
    {
        $this->status_empleado = $status_empleado;
        $this->localidad_empleado = $localidad_empleado;
        $this->area_empleado = $area_empleado;
        $this->tipo_empleado = $tipo_empleado;
        $this->horario_empleado = $horario_empleado;
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Persona::with('creadoPor', 'actualizadoPor','horario')
                            ->when(isset($this->status_empleado) && $this->status_empleado != "", function($q){
                                return $q->where('status', $this->status_empleado);

                            })
                            ->when(isset($this->localidad_empleado) && $this->localidad_empleado != "", function($q){
                                return $q->where('localidad', $this->localidad_empleado);
                            })
                            ->when(isset($this->area_empleado) && $this->area_empleado != "", function($q){
                                return $q->where('area', $this->area_empleado);
                            })
                            ->when(isset($this->tipo_empleado) && $this->tipo_empleado != "", function($q){
                                return $q->where('tipo', $this->tipo_empleado);
                            })
                            ->when(isset($this->horario_empleado) && $this->horario_empleado != "", function($q){
                                return $q->where('horario_id', $this->horario_empleado);
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
            'Número de empleado',
            'Status',
            'Nombre',
            'Apellido paterno',
            'Apellido materno',
            'Código de barras',
            'Localidad',
            'Área',
            'Tipo',
            'RFC',
            'CURP',
            'Teléfono',
            'Domicilio',
            'eMail',
            'Fecha de ingreso',
            'Registrado por',
            'Actualizado por',
            'Registrado en',
            'Actualizado en',
            'Horario',
            'Lunes',
            'Martes',
            'Miercoles',
            'Juevez',
            'Viernes',
            'Observaciones'
        ];
    }

    public function map($empleado): array
    {
        return [
            $empleado->numero_empleado,
            $empleado->status,
            $empleado->nombre,
            $empleado->ap_paterno,
            $empleado->ap_materno,
            $empleado->codigo_barras,
            $empleado->localidad,
            $empleado->area,
            $empleado->tipo,
            $empleado->rfc,
            $empleado->curp,
            $empleado->telefono,
            $empleado->domicilio,
            $empleado->email,
            $empleado->fecha_ingreso,
            $empleado->creado_por ? $empleado->creadoPor->name : 'N/A',
            $empleado->actualizado_por ? $empleado->actualizadoPor->name : 'N/A',
            $empleado->created_at,
            $empleado->updated_at,
            $empleado->horario->nombre,
            $empleado->horario->lunes_entrada . ' - ' . $empleado->horario->lunes_salida,
            $empleado->horario->martes_entrada . ' - ' . $empleado->horario->martes_salida,
            $empleado->horario->miercoles_entrada . ' - ' . $empleado->horario->miercoles_salida,
            $empleado->horario->jueves_entrada . ' - ' . $empleado->horario->jueves_salida,
            $empleado->horario->viernes_entrada . ' - ' . $empleado->horario->viernes_salida,
            $empleado->observaciones
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de empleados (Sistema de Gestión Personal)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:Z1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de empleados (Sistema de Gestión Personal)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
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
                $event->sheet->getStyle('A2:Z2')->applyFromArray([
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

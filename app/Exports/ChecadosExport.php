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

class ChecadosExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public $status;
    public $empleado_id;
    public $localidad;
    public $area;
    public $tipo;
    public $horario_id;
    public $fecha1;
    public $fecha2;

    public function __construct($status, $empleado_id, $localidad, $area, $tipo, $horario_id, $fecha1, $fecha2)
    {
        $this->status = $status;
        $this->empleado_id = $empleado_id;
        $this->localidad = $localidad;
        $this->area = $area;
        $this->tipo = $tipo;
        $this->horario_id = $horario_id;
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Persona::with('horario')
                        ->withWhereHas('checados', function($q){
                            $q->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59']);
                        })
                        ->when(isset($this->status) && $this->status != "", function($q){
                            return $q->where('status', $this->status);
                        })
                        ->when(isset($this->empleado_id) && $this->empleado_id != "", function($q){
                            return $q->where('id', $this->empleado_id);
                        })
                        ->when(isset($this->localidad) && $this->localidad != "", function($q){
                            return $q->where('localidad', $this->localidad);
                        })
                        ->when(isset($this->area) && $this->area != "", function($q){
                            return $q->where('area', $this->area);
                        })
                        ->when(isset($this->tipo) && $this->tipo != "", function($q){
                            return $q->where('tipo', $this->tipo);
                        })
                        ->when(isset($this->horario_id) && $this->horario_id != "", function($q){
                            return $q->WhereHas('horario', function($q){
                                $q->where('id', $this->horario_id);
                            });
                        })
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
            '# Empleado',
            'Nombre',
            'Horario',
            'Entradas',
            'Salidas'
        ];
    }

    public function map($persona): array
    {
        return [
            $persona->numero_empleado,
            $persona->nombre . ' ' . $persona->ap_paterno . ' ' . $persona->ap_materno,
            'Nombre:' . $persona->horario->nombre . PHP_EOL .
            'Tolerancia retardo: ' . $persona->horario->tolerancia . 'min.' . PHP_EOL .
            'Tolerancia falta: ' . $persona->horario->falta . 'min.' . PHP_EOL .
            'Lunes entrada: ' . $persona->horario->lunes_entrada . ', Lunes salida: ' . $persona->horario->lunes_salida . PHP_EOL .
            'Martes entrada: ' . $persona->horario->martes_entrada . ', Martes salida: ' . $persona->horario->martes_salida . PHP_EOL .
            'Miercoles entrada: ' . $persona->horario->miercoles_entrada . ', Miercoles salida: ' .  $persona->horario->miercoles_salida . PHP_EOL .
            'Jueves entrada: ' . $persona->horario->jueves_entrada . ', Jueves salida: ' . $persona->horario->jueves_salida . PHP_EOL .
            'Viernes entrada: ' . $persona->horario->viernes_entrada . ', Viernes salida: ' . $persona->horario->viernes_salida,
            $this->entradas($persona),
            $this->salidas($persona),
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de Checados (Sistema de Gestión Personal)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:E1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de checados (Sistema de Gestión Personal)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:E1')->applyFromArray([
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
                $event->sheet->getStyle('C:E')->getAlignment()->setWrapText(true);
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

    public function entradas($persona):string
    {

        $entradas = '';

        foreach($persona->checados as $checado){

            if($checado->tipo == 'entrada') $entradas .= $checado->hora . PHP_EOL;

        }

        return $entradas;

    }

    public function salidas($persona):string
    {

        $salidas = '';

        foreach($persona->checados as $checado){

            if($checado->tipo == 'salida') $salidas .= $checado->hora . PHP_EOL;

        }

        return $salidas;

    }

}

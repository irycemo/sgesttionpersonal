<div>

    <x-header>Reportes</x-header>

    <div class="p-4 mb-5 bg-white shadow-lg rounded-lg">

        <x-input-group for="area" label="Área" :error="$errors->first('area')" class="w-fit mx-auto">

            <x-input-select id="area" wire:model.live="area">

                <option selected value="">Selecciona una área</option>
                <option value="permisos">Permisos</option>
                <option value="incapacidades">Incapacidades</option>
                <option value="personal">Personal</option>
                <option value="justificaciones">Justificaciones</option>
                <option value="faltas">Faltas</option>
                <option value="retardos">Retardos</option>
                <option value="checados">Checados</option>

            </x-input-select>

        </x-input-group>

    </div>

    @if ($verPermisos)

            @livewire('reportes.reporte-permiso', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verIncapacidades)

        @livewire('reportes.reporte-incapacidad', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verJustificaciones)

        @livewire('reportes.reporte-justificacion', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verPersonal)

        @livewire('reportes.reporte-personal', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verFaltas)

        @livewire('reportes.reporte-flata', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verRetardos)

        @livewire('reportes.reporte-retardo', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verChecados)

        @livewire('reportes.reporte-checado', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

</div>

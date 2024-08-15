<div>

    <x-header>Asignación de permisos</x-header>

    <div class="p-4 mb-5 bg-white shadow-lg rounded-lg text-center">

        <x-input-group for="permiso_id" label="Permiso" :error="$errors->first('permiso_id')" class="lg:w-1/3 mx-auto">

            <x-input-select id="permiso_id" wire:model.live="permiso_id">

                <option selected value="">Selecciona una opción</option>

                @foreach ($permisos as $permiso)

                    <option value="{{ $permiso->id }}">{{ $permiso->descripcion }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

    </div>

    @if($permiso_id)

        <div class="p-4 mb-5 bg-white shadow-lg rounded-lg text-center">

            <x-input-group for="empleado_id" label="Empleado" :error="$errors->first('empleado_id')" class="lg:w-1/3 mx-auto">

                <x-input-select id="empleado_id" wire:model.live="empleado_id">

                    <option selected value="">Selecciona una opción</option>

                    @foreach ($empleados as $empleado)

                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

        </div>

        <div class="p-4 mb-5 bg-white shadow-lg rounded-lg text-center ">

            <div class="lg:w-1/3 justify-center mx-auto flex gap-3">

                @if($flag_catastro)

                    <x-input-group for="fecha_inicial" label="Fecha inicial" :error="$errors->first('fecha_inicial')" >

                        <x-input-text type="datetime-local" id="fecha_inicial" wire:model="fecha_inicial" />

                    </x-input-group>

                    <x-input-group for="fecha_final" label="Fecha final" :error="$errors->first('fecha_final')" >

                        <x-input-text type="datetime-local" id="fecha_final" wire:model="fecha_final" />

                    </x-input-group>

                @else

                    <x-input-group for="fecha_inicial" label="Fecha inicial" :error="$errors->first('fecha_inicial')" >

                        <x-input-text type="date" id="fecha_inicial" wire:model="fecha_inicial" />

                    </x-input-group>

                @endif

            </div>

        </div>

        <div class="p-4 mb-5 bg-white shadow-lg rounded-lg text-center">

            <div class="flex justify-center">

                <x-button-blue
                    wire:click="asignarPermiso"
                    wire:target="asignarPermiso"
                    wire:loading.attr="disabled">

                    <img wire:loading wire:target="asignarPermiso" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Asignar permiso
                </x-button-blue>

            </div>

        </div>

    @endif

</div>

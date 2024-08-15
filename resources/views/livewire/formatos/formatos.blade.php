<div class="">

    <div class="mb-5">

        <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Formatos</h1>

    </div>

    <div class="p-4 mb-5 bg-white shadow-lg rounded-lg">

        <div class="text-center lg:w-1/3 mx-auto space-y-3">

            <x-input-group for="formato" label="Formato" :error="$errors->first('formato')">

                <x-input-select id="formato" wire:model.live="formato">

                    <option selected value="">Selecciona una opción</option>
                    <option value="economico">Permiso económico</option>
                    <option value="salida">Pase de salida</option>

                </x-input-select>

            </x-input-group>

            <x-input-group for="empleado" label="Empleado" :error="$errors->first('empleado')">

                <x-input-select id="empleado" wire:model.live="empleado">

                    <option selected value="">Selecciona una opción</option>

                        @foreach ($empleados as $empleado)

                            <option value="{{ $empleado }}">{{ $empleado->nombre }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</option>

                        @endforeach

                </x-input-select>

            </x-input-group>

            <div class="flex space-x-3 justify-center w-full">

                @if($this->flags['fecha1'])

                    <x-input-group for="fecha1" label="Fecha inicial" :error="$errors->first('fecha1')" >

                        <x-input-text type="date" id="fecha1" wire:model.live="fecha1" />

                    </x-input-group>

                @endif

                @if($this->flags['hora1'])

                    <x-input-group for="hora1" label="Hora inicial" :error="$errors->first('hora1')" >

                        <x-input-text type="time" id="hora1" wire:model.live="hora1" />

                    </x-input-group>

                @endif

                @if($this->flags['fecha2'])

                    <x-input-group for="fecha2" label="Fecha final" :error="$errors->first('fecha2')" >

                        <x-input-text type="date" id="fecha2" wire:model.live="fecha2" />

                    </x-input-group>

                @endif

                @if($this->flags['hora2'])

                    <x-input-group for="hora2" label="Hora final" :error="$errors->first('hora2')" >

                        <x-input-text type="time" id="hora2" wire:model.live="hora2" />

                    </x-input-group>

                @endif

                @if($this->flags['dias'])

                    <x-input-group for="dias" label="Días" :error="$errors->first('dias')" >

                        <x-input-text type="number" id="dias" wire:model.live="dias" />

                    </x-input-group>

                @endif

            </div>

            <div class="mt-3">

                <x-input-group for="autoriza" label="Autoriza" :error="$errors->first('autoriza')">

                    <x-input-select id="autoriza" wire:model.live="autoriza">

                        <option selected value="">Selecciona una opción</option>

                        @foreach ($estructura as $item)

                            <option value="{{ $item->nombre }} {{ $item->ap_paterno }} {{ $item->ap_materno }}">{{ $item->nombre }} {{ $item->ap_paterno }} {{ $item->ap_materno }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

            </div>

            @if($this->flags['observaciones'])

                <x-input-group for="observaciones" label="Observaciones" :error="$errors->first('observaciones')" >

                    <textarea class="bg-white rounded text-sm mb-3 w-full" wire:model.defer="observaciones" rows="5"></textarea>

                </x-input-group>

            @endif

            <div class="mt-3 flex justify-center items-center">

                <x-button-blue
                    wire:click="crear"
                    wire:loading.attr="disabled"
                    wire:target="crear"
                    >
                    <img wire:loading wire:target="crear" class="h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    <p>Crear formato</p>
                </x-button-blue>

            </div>

        </div>

    </div>

</div>

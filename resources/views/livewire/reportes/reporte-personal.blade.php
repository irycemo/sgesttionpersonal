<div>

    <div class="md:flex md:flex-row flex-col md:space-x-4 items-center justify-center gap-3 bg-white rounded-xl mb-5 p-4">

        <x-input-group for="fecha1" label="Fecha inicial" :error="$errors->first('fecha1')" >

            <x-input-text type="date" id="fecha1" wire:model.live="fecha1" />

        </x-input-group>

        <x-input-group for="fecha2" label="Fecha final" :error="$errors->first('fecha2')" >

            <x-input-text type="date" id="fecha2" wire:model.live="fecha2" />

        </x-input-group>

    </div>

    <div class="md:flex flex-col md:flex-row justify-center md:space-x-3 items-center bg-white rounded-xl mb-5 p-4">


        <x-input-group for="status" label="Tipo" :error="$errors->first('status')">

            <x-input-select id="status" wire:model.live="status">

                <option value="" selected>Seleccione una opción</option>
                <option value="activo" >Activo</option>
                <option value="inactivo" >Inactivo</option>

            </x-input-select>

        </x-input-group>

        <x-input-group for="localidad" label="Localidad" :error="$errors->first('localidad')">

            <x-input-select id="localidad" wire:model.live="localidad">

                <option value="" selected>Seleccione una opción</option>

                @foreach ($localidades as $localidad)

                    <option value="{{ $localidad }}" selected>{{ $localidad }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

        <x-input-group for="area" label="Áreas" :error="$errors->first('area')">

            <x-input-select id="area" wire:model.live="area">

                <option value="" selected>Seleccione una opción</option>

                @foreach ($areas as $area)

                    <option value="{{ $area }}" selected>{{ $area }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

        <x-input-group for="tipo" label="Tipo" :error="$errors->first('tipo')">

            <x-input-select id="tipo" wire:model.live="tipo">

                <option value="" selected>Seleccione una opción</option>

                @foreach ($tipos as $tipo)

                    <option value="{{ $tipo }}" selected>{{ $tipo }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

        <x-input-group for="horario_id" label="Horarios" :error="$errors->first('horario_id')">

            <x-input-select id="horario_id" wire:model.live="horario_id">

                <option value="" selected>Seleccione una opción</option>

                @foreach ($horarios as $horario)

                    <option value="{{ $horario->id }}" selected>{{ $horario->nombre }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

    </div>

    @if(count($personal))

        <div class="rounded-lg shadow-xl mb-5 p-4 font-thin md:flex items-center justify-between bg-white">

            <p class="text-xl font-extralight">Se encontraron: {{ number_format($personal->total()) }} registros con los filtros seleccionados.</p>

            <x-button-green wire:click="descargarExcel">

                <img wire:loading wire:target="descargarExcel" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>

                Exportar a Excel

            </x-button-green>

        </div>

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs text-gray-500 uppercase text-left traling-wider">

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Número de empleado

                        </th>


                        <th class="px-3 py-3 hidden lg:table-cell">

                            Status

                        </th>


                        <th class="px-3 py-3 hidden lg:table-cell">

                            Nombre

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Código de barras

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Localidad

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Área

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Tipo

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            RFC

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            CURP

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Teléfono

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Domicilio

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            eMail

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Fecha de ingreso

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Horario

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Observaciones

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Registro

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Actualizado

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                    @foreach($personal as $persona)

                        <tr class="text-sm text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 text-center">

                            <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de empleado</span>

                                {{ $persona->numero_empleado }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Status</span>

                                {{ $persona->status }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Código de barras</span>

                                {{ $persona->codigo_barras }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Localidad</span>

                                {{ $persona->localidad }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Área</span>

                                {{ $persona->area }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                {{ $persona->tipo }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">RFC</span>

                                {{ $persona->rfc }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">CURP</span>

                                {{ $persona->curp }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Teléfono</span>

                                {{ $persona->telefono }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Domicilio</span>

                                {{ $persona->domicilio }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">eMail</span>

                                {{ $persona->email }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha de ingreso</span>

                                {{ $persona->fecha_ingreso }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Horario</span>

                                {{ $persona->horario->nombre }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Observaciones</span>

                                {{ $persona->observaciones }}

                            </td>

                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                @if($persona->creado_por != null)

                                    <span class="font-semibold">Registrado por: {{$persona->creadoPor->name}}</span> <br>

                                @endif

                                {{ $persona->created_at }}

                            </td>

                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                @if($persona->actualizado_por != null)

                                    <span class="font-semibold">Actualizado por: {{$persona->actualizadoPor->name}}</span> <br>

                                @endif

                                {{ $persona->updated_at }}

                            </td>
                        </tr>

                    @endforeach

                </tbody>

                <tfoot class="border-gray-300 bg-gray-50">

                    <tr>

                        <td colspan="1" class="py-2 px-5">

                            <select class="bg-white rounded-full text-sm" wire:model="pagination">

                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>

                            </select>

                        </td>

                        <td colspan="16" class="py-2 px-5">

                            {{ $personal->links()}}

                        </td>

                    </tr>

                </tfoot>

            </table>

            <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading.delay.longer>

                <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

            </div>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

</div>

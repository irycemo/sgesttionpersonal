<div>

    <div class="md:flex md:flex-row flex-col md:space-x-4 items-center justify-center gap-3 bg-white rounded-xl mb-5 p-4">

        <x-input-group for="fecha1" label="Fecha inicial" :error="$errors->first('fecha1')" >

            <x-input-text type="date" id="fecha1" wire:model.live="fecha1" />

        </x-input-group>

        <x-input-group for="fecha2" label="Fecha final" :error="$errors->first('fecha2')" >

            <x-input-text type="date" id="fecha2" wire:model.live="fecha2" />

        </x-input-group>

    </div>

    <div class="md:flex flex-col md:flex-row justify-between md:space-x-3 items-center bg-white rounded-xl mb-5 p-4">

        <x-input-group for="empleado_id" label="Empleado" :error="$errors->first('empleado_id')">

            <x-input-select id="empleado_id" wire:model.live="empleado_id">

                <option value="">Seleccione una opción</option>

                @foreach ($empleados as $empleado)

                    <option value="{{$empleado->id}}" >{{$empleado->nombre}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

        <x-input-group for="status" label="Estado" :error="$errors->first('status')">

            <x-input-select id="status" wire:model.live="status">

                <option value="" selected>Seleccione una opción</option>
                <option value="activo" selected>Activo</option>
                <option value="inactivo" selected>Inactivo</option>

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

            {{-- <button wire:click="descargarExcel" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700 mt-2 md:mt-0 w-full md:w-auto justify-center">

                <img wire:loading wire:target="descargarExcel" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>

                Exportar a Excel

            </button> --}}

        </div>

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs  text-gray-500 uppercase text-left traling-wider">

                        <th class="px-3 py-3 hidden lg:table-cell">

                            #Empleado

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Nombre

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Horario

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Entradas

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Salidas

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 ">

                    @foreach($personal as $empleado)

                        <tr class="text-sm  text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap mb-10 lg:mb-0 text-center">

                            <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl"># Empleado</span>

                                {{ $empleado->numero_empleado }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                {{ $empleado->nombre }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Horario</span>

                                <ul>
                                    <li>{{ $empleado->horario->nombre }}, Tolerancia retardo: {{ $empleado->horario->tolerancia }} min. Tolerancia falta: {{ $empleado->horario->falta }} min.</li>
                                    <li>Lunes entrada: {{ $empleado->horario->lunes_entrada }}, Lunes salida: {{ $empleado->horario->lunes_salida }}</li>
                                    <li>Martes entrada: {{ $empleado->horario->martes_entrada }}, Martes salida: {{ $empleado->horario->martes_salida }}</li>
                                    <li>Miercoles entrada: {{ $empleado->horario->miercoles_entrada }}, Miercoles salida: {{ $empleado->horario->miercoles_salida }}</li>
                                    <li>Jueves entrada: {{ $empleado->horario->jueves_entrada }}, Jueves salida: {{ $empleado->horario->jueves_salida }}</li>
                                    <li>Viernes entrada: {{ $empleado->horario->viernes_entrada }}, Viernes salida: {{ $empleado->horario->viernes_salida }}</li>
                                </ul>

                            </td>

                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Entradas</span>

                                <ul>

                                    @foreach ($empleado->checados as $checada)

                                        @if($checada->tipo == 'entrada')
                                            <li>{{ $checada->hora }}</li>
                                        @endif

                                    @endforeach

                                </ul>

                            </td>

                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Salidas</span>

                                <ul>

                                    @foreach ($empleado->checados as $checada)

                                        @if($checada->tipo == 'salida')
                                            <li>{{ $checada->hora }}</li>
                                        @endif

                                    @endforeach

                                </ul>

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

                        <td colspan="20" class="py-2 px-5">
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

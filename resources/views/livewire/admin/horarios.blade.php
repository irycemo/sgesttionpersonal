<div class="">

    <div class="mb-6">

        <x-header>Horarios</x-header>

        <div class="flex justify-between">

            <div class="flex gap-3">

                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

                <x-input-select class="bg-white rounded-full text-sm w-min" wire:model.live="pagination">

                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>

                </x-input-select>

            </div>

            @can('Crear horario')

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 text-sm py-2 px-4 text-white rounded-full hidden md:block items-center justify-center focus:outline-gray-400 focus:outline-offset-2">

                    <img wire:loading wire:target="abrirModalCrear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Agregar nuevo horario

                </button>

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right text-sm py-2 px-4 text-white rounded-full md:hidden focus:outline-gray-400 focus:outline-offset-2">+</button>

            @endcan

        </div>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('nombre')" :direction="$sort === 'nombre' ? $direction : null" >Nombre</x-table.heading>
                <x-table.heading>Descripción</x-table.heading>
                <x-table.heading>Tolerancia</x-table.heading>
                <x-table.heading>Falta</x-table.heading>
                <x-table.heading>Lunes entrada</x-table.heading>
                <x-table.heading>Lunes salida</x-table.heading>
                <x-table.heading>Martes entrada</x-table.heading>
                <x-table.heading>Martes salida</x-table.heading>
                <x-table.heading>Miercoles entrada</x-table.heading>
                <x-table.heading>Miercoles salida</x-table.heading>
                <x-table.heading>Jueves entrada</x-table.heading>
                <x-table.heading>Jueves salida</x-table.heading>
                <x-table.heading>Viernes entrada</x-table.heading>
                <x-table.heading>Viernes salida</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sort === 'created_at' ? $direction : null">Registro</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('updated_at')" :direction="$sort === 'updated_at' ? $direction : null">Actualizado</x-table.heading>
                <x-table.heading >Acciones</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($horarios as $horario)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $horario->id }}">

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                            {{ $horario->nombre }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Descripción</span>

                            {{ $horario->descripcion }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tolerancia</span>

                            {{ $horario->tolerancia }} min.

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Falta</span>

                            {{ $horario->falta }} min.

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Lunes entrada</span>

                            {{ $horario->lunes_entrada }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Lunes salida</span>

                            {{ $horario->lunes_salida }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Martes entrada</span>

                            {{ $horario->martes_entrada }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Martes salida</span>

                            {{ $horario->martes_salida }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Miercoles entrada</span>

                            {{ $horario->miercoles_entrada }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Miercoles salida</span>

                            {{ $horario->miercoles_salida }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Jueves entrada</span>

                            {{ $horario->jueves_entrada }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Jueves salida</span>

                            {{ $horario->jueves_salida }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Viernes entrada</span>

                            {{ $horario->viernes_entrada }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Viernes salida</span>

                            {{ $horario->viernes_salida }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>


                            <span class="font-semibold">@if($horario->creadoPor != null)Registrado por: {{$horario->creadoPor->name}} @else Registro: @endif</span> <br>

                            {{ $horario->created_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="font-semibold">@if($horario->actualizadoPor != null)Actualizado por: {{$horario->actualizadoPor->name}} @else Actualizado: @endif</span> <br>

                            {{ $horario->updated_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                            <div class="ml-3 relative" x-data="{ open_drop_down:false }">

                                <div>

                                    <button x-on:click="open_drop_down=true" type="button" class="rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>

                                    </button>

                                </div>

                                <div x-cloak x-show="open_drop_down" x-on:click="open_drop_down=false" x-on:click.away="open_drop_down=false" class="z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                                    @can('Editar horario')

                                        <button
                                            wire:click="abrirModalEditar({{ $horario->id }})"
                                            wire:loading.attr="disabled"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Editar
                                        </button>

                                    @endcan

                                    @can('Borrar horario')

                                        <button
                                            wire:click="abrirModalBorrar({{ $horario->id }})"
                                            wire:loading.attr="disabled"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Eliminar
                                        </button>

                                    @endcan

                                </div>

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @empty

                    <x-table.row>

                        <x-table.cell colspan="17">

                            <div class="bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                                No hay resultados.

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @endforelse

            </x-slot>

            <x-slot name="tfoot">

                <x-table.row>

                    <x-table.cell colspan="17" class="bg-gray-50">

                        {{ $horarios->links()}}

                    </x-table.cell>

                </x-table.row>

            </x-slot>

        </x-table>

    </div>

    <x-dialog-modal wire:model="modal">

        <x-slot name="title">

            @if($crear)
                Nuevo Horario
            @elseif($editar)
                Editar Horario
            @endif

        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between gap-3 mb-3">

                <x-input-group for="modelo_editar.nombre" label="Nombre" :error="$errors->first('modelo_editar.nombre')" class="w-full">

                    <x-input-text id="modelo_editar.nombre" wire:model="modelo_editar.nombre" />

                </x-input-group>

                <x-input-group for="modelo_editar.tolerancia" label="Tolerancia" :error="$errors->first('modelo_editar.tolerancia')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.tolerancia" wire:model="modelo_editar.tolerancia" />

                </x-input-group>

                <x-input-group for="modelo_editar.falta" label="Falta" :error="$errors->first('modelo_editar.falta')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.falta" wire:model="modelo_editar.falta" />

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between gap-3 mb-3">

                <div class="flex-auto ">

                    <table class="mx-auto w-full table-auto">

                        <thead>

                            <tr class="text-xs  text-gray-700 uppercase traling-wider text-center">
                                <th>Día</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                            </tr>

                        </thead>

                        <tbody class="space-y-4">

                            <tr class="">

                                <td class="px-3 py-2">
                                    Lunes
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.lunes_entrada">

                                    </div>

                                    <div>

                                        @error('modelo_editar.lunes_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.lunes_salida">

                                    </div>

                                    <div>

                                        @error('modelo_editar.lunes_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Martes
                                </td>

                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.martes_entrada">

                                    </div>

                                    <div>

                                        @error('modelo_editar.martes_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.martes_salida">

                                    </div>

                                    <div>

                                        @error('modelo_editar.martes_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Miercoles
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.miercoles_entrada">

                                    </div>

                                    <div>

                                        @error('modelo_editar.miercoles_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.miercoles_salida">

                                    </div>

                                    <div>

                                        @error('modelo_editar.miercoles_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Jueves
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.jueves_entrada">

                                    </div>

                                    <div>

                                        @error('modelo_editar.jueves_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.jueves_salida">

                                    </div>

                                    <div>

                                        @error('modelo_editar.jueves_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Viernes
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.viernes_entrada">

                                    </div>

                                    <div>

                                        @error('modelo_editar.viernes_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model="modelo_editar.viernes_salida">

                                    </div>

                                    <div>

                                        @error('modelo_editar.viernes_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.descripcion" label="Descripción" :error="$errors->first('modelo_editar.descripcion')" class="w-full">

                    <textarea wire:model="modelo_editar.descripcion" class="bg-white rounded text-sm w-full"></textarea>

                </x-input-group>

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                @if($crear)

                    <x-button-blue
                        wire:click="guardar"
                        wire:loading.attr="disabled"
                        wire:target="guardar">

                        <img wire:loading wire:target="guardar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        <span>Guardar</span>
                    </x-button-blue>

                @elseif($editar)

                    <x-button-blue
                        wire:click="actualizar"
                        wire:loading.attr="disabled"
                        wire:target="actualizar">

                        <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        <span>Actualizar</span>
                    </x-button-blue>

                @endif

                <x-button-red
                    wire:click="resetearTodo"
                    wire:loading.attr="disabled"
                    wire:target="resetearTodo"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

    <x-confirmation-modal wire:model="modalBorrar" maxWidth="sm">

        <x-slot name="title">
            Eliminar horario
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el horario? No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button
                wire:click="$toggle('modalBorrar')"
                wire:loading.attr="disabled"
            >
                No
            </x-secondary-button>

            <x-danger-button
                class="ml-2"
                wire:click="borrar"
                wire:loading.attr="disabled"
                wire:target="borrar"
            >
                Borrar
            </x-danger-button>

        </x-slot>

    </x-confirmation-modal>

</div>

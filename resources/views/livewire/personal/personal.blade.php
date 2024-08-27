<div class="">

    <div class="mb-6">

        <x-header>Personal</x-header>

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

            @can('Crear personal')

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 text-sm py-2 px-4 text-white rounded-full hidden md:block items-center justify-center focus:outline-gray-400 focus:outline-offset-2">

                    <img wire:loading wire:target="abrirModalCrear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Agregar nuevo empleado

                </button>

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right text-sm py-2 px-4 text-white rounded-full md:hidden focus:outline-gray-400 focus:outline-offset-2">+</button>

            @endcan

        </div>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('numero_empleado')" :direction="$sort === 'numero_empleado' ? $direction : null" ># Empleado</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('nombre')" :direction="$sort === 'nombre' ? $direction : null" >Nombre</x-table.heading>
                @if (auth()->user()->hasRole('Administrador'))
                    <x-table.heading sortable wire:click="sortBy('codigo_barras')" :direction="$sort === 'codigo_barras' ? $direction : null" >Código de barras</x-table.heading>
                @endif
                <x-table.heading sortable wire:click="sortBy('status')" :direction="$sort === 'status' ? $direction : null" >Estado</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('localidad')" :direction="$sort === 'localidad' ? $direction : null" >Localidad</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('area')" :direction="$sort === 'area' ? $direction : null" >Área</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('tipo')" :direction="$sort === 'tipo' ? $direction : null" >Tipo</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('horario_id')" :direction="$sort === 'horario_id' ? $direction : null" >Horario</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sort === 'created_at' ? $direction : null">Registro</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('updated_at')" :direction="$sort === 'updated_at' ? $direction : null">Actualizado</x-table.heading>
                <x-table.heading >Acciones</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($personas as $persona)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $persona->id }}">

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl"># Empleado</span>

                            {{ $persona->numero_empleado }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                            {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}

                        </x-table.cell>

                        @if (auth()->user()->hasRole('Administrador'))

                            <x-table.cell>

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Código de barras<</span>

                                {{ $persona->codigo_barras }}

                            </x-table.cell>

                        @endif

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Estado</span>

                            @if($persona->status == 'activo')

                                <span class="bg-green-400 py-1 px-2 rounded-full text-white">{{ ucfirst($persona->status) }}</span>

                            @else

                                <span class="bg-red-400 py-1 px-2 rounded-full text-white">{{ ucfirst($persona->status) }}</span>

                            @endif

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Localidad</span>

                            {{ $persona->localidad }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Área</span>

                            {{ $persona->area }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                            {{ $persona->tipo }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Horario</span>

                            <a href="{{ route('horarios') . '?search=' . $persona->horario->nombre }}">{{ $persona->horario->nombre }}</a>

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>


                            <span class="font-semibold">@if($persona->creadoPor != null)Registrado por: {{$persona->creadoPor->name}} @else Registro: @endif</span> <br>

                            {{ $persona->created_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="font-semibold">@if($persona->actualizadoPor != null)Actualizado por: {{$persona->actualizadoPor->name}} @else Actualizado: @endif</span> <br>

                            {{ $persona->updated_at }}

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

                                    @can('Ver personal')

                                        <a href="{{ route('personal_detalle', $persona->id) }}" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Ver</a>

                                    @endcan

                                    @can('Editar personal')

                                        <button
                                            wire:click="abrirModalEditar({{ $persona->id }})"
                                            wire:loading.attr="disabled"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Editar
                                        </button>

                                    @endcan

                                    @can('Borrar personal')

                                        <button
                                            wire:click="abrirModalBorrar({{ $persona->id }})"
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

                        {{ $personas->links()}}

                    </x-table.cell>

                </x-table.row>

            </x-slot>

        </x-table>

    </div>

    <x-dialog-modal wire:model="modal">

        <x-slot name="title">

            @if($crear)
                Nuevo Empleado
            @elseif($editar)
                Editar Empleado
            @endif

        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between gap-3 mb-3">

                <x-input-group for="modelo_editar.numero_empleado" label="# Empleado" :error="$errors->first('modelo_editar.numero_empleado')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.numero_empleado" wire:model="modelo_editar.numero_empleado" />

                </x-input-group>

                <x-input-group for="modelo_editar.nombre" label="Nombre" :error="$errors->first('modelo_editar.nombre')" class="w-full">

                    <x-input-text id="modelo_editar.nombre" wire:model="modelo_editar.nombre" />

                </x-input-group>

                <x-input-group for="modelo_editar.ap_paterno" label="Paterno" :error="$errors->first('modelo_editar.ap_paterno')" class="w-full">

                    <x-input-text id="modelo_editar.ap_paterno" wire:model="modelo_editar.ap_paterno" />

                </x-input-group>

                <x-input-group for="modelo_editar.ap_materno" label="Materno" :error="$errors->first('modelo_editar.ap_materno')" class="w-full">

                    <x-input-text id="modelo_editar.ap_materno" wire:model="modelo_editar.ap_materno" />

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.localidad" label="Localidad" :error="$errors->first('modelo_editar.localidad')" class="w-full">

                    <x-input-select id="modelo_editar.localidad" wire:model="modelo_editar.localidad" class="w-full">

                        <option value="">Seleccione una opción</option>

                        @foreach ($localidades as $localidad)

                            <option value="{{ $localidad }}">{{ $localidad }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="modelo_editar.area" label="Área" :error="$errors->first('modelo_editar.area')" class="w-full">

                    <x-input-select id="modelo_editar.area" wire:model="modelo_editar.area" class="w-full">

                        <option value="">Seleccione una opción</option>

                        @foreach ($areas as $area)

                            <option value="{{ $area }}">{{ $area }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="modelo_editar.tipo" label="Tipo" :error="$errors->first('modelo_editar.tipo')" class="w-full">

                    <x-input-select id="modelo_editar.tipo" wire:model="modelo_editar.tipo" class="w-full">

                        <option value="">Seleccione una opción</option>

                        @foreach ($tipos as $tipo)

                            <option value="{{ $tipo }}">{{ $tipo }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.codigo_barras" label="Código de barras" :error="$errors->first('modelo_editar.codigo_barras')" class="w-full">

                    <div x-data="{ showPassword : false }">

                        <div  class="relative rounded-md shadow-sm">

                          <input :type="showPassword ? 'text' : 'password'" id="password" class="border p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md" wire:model="modelo_editar.codigo_barras">

                          <div x-on:click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2" :class="showPassword ? 'hidden' : 'block'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2" :class="showPassword ? 'block' : 'hidden'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                          </div>

                        </div>

                    </div>

                </x-input-group>

                <x-input-group for="modelo_editar.telefono" label="Teléfono" :error="$errors->first('modelo_editar.telefono')" class="w-full">

                    <x-input-text id="modelo_editar.telefono" wire:model="modelo_editar.telefono" />

                </x-input-group>

                <x-input-group for="modelo_editar.email" label="Email" :error="$errors->first('modelo_editar.email')" class="w-full">

                    <x-input-text id="modelo_editar.email" wire:model="modelo_editar.email" />

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.rfc" label="RFC" :error="$errors->first('modelo_editar.rfc')" class="w-full">

                    <x-input-text id="modelo_editar.rfc" wire:model="modelo_editar.rfc" />

                </x-input-group>


                <x-input-group for="modelo_editar.curp" label="CURP" :error="$errors->first('modelo_editar.curp')" class="w-full">

                    <x-input-text id="modelo_editar.curp" wire:model="modelo_editar.curp" />

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.domicilio" label="Domicilio" :error="$errors->first('modelo_editar.domicilio')" class="w-full">

                    <textarea wire:model="modelo_editar.domicilio" class="bg-white rounded text-sm w-full">{{ $modelo_editar->domicilio }}</textarea>

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.fecha_ingreso" label="Fecha de ingreso" :error="$errors->first('modelo_editar.fecha_ingreso')" class="w-full">

                    <x-input-text type="date" id="modelo_editar.fecha_ingreso" wire:model="modelo_editar.fecha_ingreso" />

                </x-input-group>

                <x-input-group for="modelo_editar.horario_id" label="Horario" :error="$errors->first('modelo_editar.horario_id')" class="w-full">

                    <x-input-select id="modelo_editar.horario_id" wire:model="modelo_editar.horario_id" class="w-full">

                        <option value="">Seleccione una opción</option>

                        @foreach ($horarios as $horario)

                            <option value="{{ $horario->id }}">{{ $horario->nombre }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="modelo_editar.status" label="Estado" :error="$errors->first('modelo_editar.status')" class="w-full">

                    <x-input-select id="modelo_editar.status" wire:model="modelo_editar.status" class="w-full">

                        <option value="">Seleccione una opción</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>

                    </x-input-select>

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.observaciones" label="Observaciones" :error="$errors->first('modelo_editar.observaciones')" class="w-full">

                    <textarea wire:model="modelo_editar.observaciones" class="bg-white rounded text-sm w-full">{{ $modelo_editar->observaciones }}</textarea>

                </x-input-group>

            </div>

            <div>

                <x-filepond wire:model.live="foto"/>

                <div>

                    @error('foto') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

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

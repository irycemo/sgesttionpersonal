@extends('layouts.admin')

@push('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css">

@endpush


@section('content')

    <x-header>{{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</x-header>

    <div class="grid grid-cols-1 md:grid-cols-2 mb-3">

        <div class="p-4 mx-auto">

            <img class="rounded-lg max-h-96 object-cover mb-3 shadow-xl" src="{{ $persona->imagenUrl() }}" alt="Fotografía">

        </div>

        <div class="p-4">

            <div class="grid grid-cols-1 md:grid-cols-2 p-4 bg-white rounded-lg shadow-xl">

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Fecha de Ingreso</p>

                    <p>{{ $persona->fecha_ingreso_formateada }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Número de empleado</p>

                    <p>{{ $persona->numero_empleado }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Código de Barras</p>

                    @if(auth()->user()->hasRole('Administrador'))
                        <p>{{ $persona->codigo_barras }}</p>
                    @else
                        ******
                    @endif

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Localidad</p>

                    <p>{{ $persona->localidad }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Área</p>

                    <p>{{ $persona->area }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Tipo</p>

                    <p>{{ $persona->tipo }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">RFC</p>

                    <p>{{ $persona->rfc }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">CURP</p>

                    <p>{{ $persona->curp }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Teléfono</p>

                    <p>{{ $persona->telefono }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Email</p>

                    <p>{{ $persona->email }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Estado</p>

                    @if($persona->status == 'activo')

                        <span class="bg-green-400 py-1 px-2 rounded-full text-white text-sm">{{ ucfirst($persona->status) }}</span>

                    @else

                        <span class="bg-red-400 py-1 px-2 rounded-full text-white text-sm">{{ ucfirst($persona->status) }}</span>

                    @endif

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Horario</p>

                    <a href="{{ route('horarios') . '?search=' . $persona->horario->nombre }}">{{ $persona->horario->nombre }}</a>

                </div>

                @if ( $persona->observaciones)

                    <div class="mb-4 col-span-2">

                        <p class="tracking-widest font-semibold text-lg">Observaciones</p>

                        <p>{{ $persona->observaciones }}</p>

                    </div>

                @endif

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Tiempo consumido (año actual)</p>

                    <p>Permisos: {{ abs($persona->tiempoConsumidoPermisos()) }} min.</p>
                    <p>Incidencias: {{ abs($persona->tiempoConsumidoIncidencias()) }} min.</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Permisos económicos (año actual)</p>

                    {{ $persona->permisosEconomicos() }}

                </div>

            </div>


        </div>

    </div>

    <div>

        <div class="w-full" x-data="{selected : null}">

            <div @click="selected != 1 ? selected = 1 : selected = null">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Incapacidades ({{ $persona->incapacidades->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 1 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab1"
                :style="selected == 1 ? 'max-height: ' + $refs.tab1.scrollHeight + 'px;' :  ''"
            >

                @livewire('personal.incapacidades', ['persona' => $persona])

            </div>

            <div @click="selected != 3 ? selected = 3 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Justificaciones ({{ $persona->justificaciones->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 3 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab3"
                :style="selected == 3 ? 'max-height: ' + $refs.tab3.scrollHeight + 'px;' :  ''"
            >

                @livewire('personal.justificaciones', ['persona' => $persona])

            </div>

            <div @click="selected != 4 ? selected = 4 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Retardos ({{ $persona->retardos->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 4 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab4"
                :style="selected == 4 ? 'max-height: ' + $refs.tab4.scrollHeight + 'px;' :  ''"
            >

                @livewire('personal.retardos', ['persona' => $persona])

            </div>

            <div @click="selected != 5 ? selected = 5 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Faltas ({{ $persona->faltas->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 5 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab5"
                :style="selected == 5 ? 'max-height: ' + $refs.tab5.scrollHeight + 'px;' :  ''"
            >

                @livewire('personal.faltas', ['persona' => $persona])

            </div>

            <div @click="selected != 2 ? selected = 2 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Permisos ({{ $persona->permisos->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 2 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab2"
                :style="selected == 2 ? 'max-height: ' + $refs.tab2.scrollHeight + 'px;' :  ''"
            >

                @livewire('personal.permisos', ['persona' => $persona])

            </div>

            <div @click="selected != 7 ? selected = 7 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Incidencias ({{ $persona->incidencias->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 6 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab7"
                :style="selected == 7 ? 'max-height: ' + $refs.tab7.scrollHeight + 'px;' :  ''"
            >

                @livewire('personal.incidencias', ['persona' => $persona])

            </div>

            <div @click="selected != 6 ? selected = 6 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Checador

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 6 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab6"
                :style="selected == 6 ? 'max-height: ' + $refs.tab6.scrollHeight + 'px;' :  ''"
            >

                @livewire('personal.full-calendar', ['persona_id' => $persona->id])

            </div>

        </div>

    </div>

@endsection

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>
@endpush

@extends('layouts.admin')

@section('content')

    <div class=" mb-10">

        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500  mb-6  bg-white">Estadisticas del mes actual</h2>

        @livewire('dashboard.estadisticas')

    </div>

    <div>

        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500  mb-6  bg-white">Estadisticas de Asistencias</h2>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

        <div class=" border-t-4 border-green-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Catastro</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Catastro', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-blue-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">RPP</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'RPP', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-gray-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 1 (Zamora)</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Regional 1', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-red-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 2 (La Piedad)</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Regional 2', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-yellow-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 3 (Apatzingan)</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Regional 3', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-indigo-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 4 (Uruapan)</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Regional 4', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-orange-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 5 (Huetamo)</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Regional 5', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-pink-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 6 (Lazaro Cardenas)</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Regional 6', 'lazy' => true])

            </div>

        </div>

        <div class=" border-t-4 border-purple-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 7 (Ciudad Hidalgo)</h4>

            <div class="md:flex items-end justify-between">

                @livewire('dashboard.ver-inasistencia', ['localidad'=>'Regional 7', 'lazy' => true])

            </div>

        </div>

    </div>

@endsection

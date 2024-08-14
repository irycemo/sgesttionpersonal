@extends('layouts.admin')

@section('content')

    <div class=" mb-10">

        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500  mb-6  bg-white">Estadisticas del mes actual</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">

            <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-blue-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

                <div class="  mb-2 items-center">

                    <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                        <p>{{ $faltas }}</p>

                    </span>

                    <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Faltas</h5>

                </div>

                <a href="{{ route('reportes') . "?area=faltas&fecha1=" . now()->startOfMonth()->format('Y-m-d') . "&fecha2=" . now()->endOfMonth()->format('Y-m-d') }}" class="mx-auto rounded-full border border-blue-600 py-1 px-4 text-blue-500 hover:bg-blue-600 hover:text-white transition-all ease-in-out"> Ver faltas</a>

            </div>

            <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-green-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

                <div class="  mb-2 items-center">

                    <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                        <p>{{ $retardos }}</p>

                    </span>

                    <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Retardos</h5>

                </div>

                <a href="{{ route('reportes') . "?area=retardos&fecha1=" . now()->startOfMonth()->format('Y-m-d') . "&fecha2=" . now()->endOfMonth()->format('Y-m-d')  }}" class="mx-auto rounded-full border border-green-600 py-1 px-4 text-green-500 hover:bg-green-600 hover:text-white transition-all ease-in-out"> Ver retardos</a>

            </div>

            <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-indigo-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

                <div class="  mb-2 items-center">

                    <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                        <p>{{ $permisos }}</p>

                    </span>

                    <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Permisos</h5>

                </div>

                <a href="{{ route('reportes') . "?area=permisos&fecha1=" . now()->startOfMonth()->format('Y-m-d') . "&fecha2=" . now()->endOfMonth()->format('Y-m-d') }}" class="mx-auto rounded-full border border-indigo-600 py-1 px-4 text-indigo-500 hover:bg-indigo-600 hover:text-white transition-all ease-in-out"> Ver permisos</a>

            </div>

            <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-yellow-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

                <div class="  mb-2 items-center">

                    <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                        <p>{{ $justificaciones }}</p>

                    </span>

                    <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Justificaciones</h5>

                </div>

                <a href="{{ route('justificaciones') . "?search=" . now()->format('Y-m') }}" class="mx-auto rounded-full border border-yellow-600 py-1 px-4 text-yellow-500 hover:bg-yellow-600 hover:text-white transition-all ease-in-out"> Ver justificaciones</a>

            </div>

            <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-gray-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

                <div class="  mb-2 items-center">

                    <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                        <p>{{ $incapacidades }}</p>

                    </span>

                    <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Incapacidades</h5>

                </div>

                <a href="{{ route('incapacidades') . "?search=" . now()->format('Y-m') }}" class="mx-auto rounded-full border border-gray-600 py-1 px-4 text-gray-500 hover:bg-gray-600 hover:text-white transition-all ease-in-out"> Ver incapacidades</a>

            </div>

        </div>

    </div>

    <div>

        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500  mb-6  bg-white">Estadisticas de Asistencias</h2>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

        <div class=" border-t-4 border-green-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Catastro</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalCatastroTotal }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalCatastroPresente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Catastro' ,'personalTotal' => $personalCatastroTotal, 'personalPresente' => $personalCatastroPresente])

            </div>

        </div>

        <div class=" border-t-4 border-blue-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">RPP</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRPPTotal }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRppPresente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'RPP' ,'personalTotal' => $personalRPPTotal, 'personalPresente' => $personalRppPresente])

            </div>

        </div>

        <div class=" border-t-4 border-gray-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 1 (Zamora)</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRegional1Total }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRegional1Presente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Regional 1' ,'personalTotal' => $personalRegional1Total, 'personalPresente' => $personalRegional1Presente])

            </div>

        </div>

        <div class=" border-t-4 border-red-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 2 (La Piedad)</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRegional2Total }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRegional2Presente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Regional 2' ,'personalTotal' => $personalRegional2Total, 'personalPresente' => $personalRegional2Presente])

            </div>

        </div>

        <div class=" border-t-4 border-yellow-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 3 (Apatzingan)</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRegional3Total }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRegional3Presente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Regional 3' ,'personalTotal' => $personalRegional3Total, 'personalPresente' => $personalRegional3Presente])

            </div>

        </div>

        <div class=" border-t-4 border-indigo-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 4 (Uruapan)</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRegional4Total }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRegional4Presente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Regional 4' ,'personalTotal' => $personalRegional4Total, 'personalPresente' => $personalRegional4Presente])

            </div>

        </div>

        <div class=" border-t-4 border-orange-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 5 (Huetamo)</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRegional5Total }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRegional5Presente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Regional 5' ,'personalTotal' => $personalRegional5Total, 'personalPresente' => $personalRegional5Presente])

            </div>

        </div>

        <div class=" border-t-4 border-pink-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 6 (Lazaro Cardenas)</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRegional6Total }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRegional6Presente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Regional 6' ,'personalTotal' => $personalRegional6Total, 'personalPresente' => $personalRegional6Presente])

            </div>

        </div>

        <div class=" border-t-4 border-purple-400 shadow-xl text-gray-600 rounded-xl bg-white p-3">

            <h4 class="text-center text-2xl mb-2">Regional 7 (Ciudad Hidalgo)</h4>

            <div class="md:flex items-end justify-between">

                <div>

                    <p class="font-semibold">Total de empleados activos: {{ $personalRegional7Total }}</p>

                    <p class="font-semibold">Total de empleados presentes: {{ $personalRegional7Presente }}</p>

                </div>

                @livewire('dashboard.ver-inasistencia', ['localidad' => 'Regional 7' ,'personalTotal' => $personalRegional7Total, 'personalPresente' => $personalRegional7Presente])

            </div>

        </div>

    </div>

@endsection

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
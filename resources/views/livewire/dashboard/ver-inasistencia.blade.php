<div>

    <div>

        <p class="font-semibold">Total de empleados activos: {{ $personalTotal }}</p>

        <p class="font-semibold">Total de empleados presentes: {{ $personalPresente }}</p>

    </div>

    <button wire:click="consultarFaltantes" class="rounded-full border w-full md:w-auto mt-3 border-gray-600 py-1 px-4 text-gray-500 hover:bg-gray-600 hover:text-white transition-all ease-in-out">Faltantes</button>

    <x-dialog-modal wire:model="modal">

        <x-slot name="title">

            <h4 class="text-2xl">{{ $localidad }}</h4>

        </x-slot>

        <x-slot name="content">

            <div class="mb-5">

                <p>Total de empleados presentes: {{ $personalPresente }}</p>

                <p>Total de empleados sin presentarse: {{ count($empleados) }}</p>

            </div>

             <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5 overflow-y-auto">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50 text-left">

                        <tr>

                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach ($empleados as $empleado)

                            <tr>

                                <td>{{ $empleado['nombre'] }}</td>
                                <td>{{ $empleado['ap_paterno'] }}</td>
                                <td>{{ $empleado['ap_materno'] }}</td>

                            </tr>

                        @endforeach


                    </tbody>

                </table>

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="float-righ">

                <button
                    wire:click="$set('modal', false)"
                    type="button"
                    class="bg-red-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-red-700 flaot-left focus:outline-none">
                    Cerrar
                </button>

            </div>

        </x-slot>

    </x-dialog-modal>

</div>

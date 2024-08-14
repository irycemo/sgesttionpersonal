<div>

    @if($incapacidades->count())

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50 ">

                    <tr class="text-xs text-gray-500 uppercase text-left traling-wider ">

                        <th class="px-3 hidden lg:table-cell py-2">

                            Folio

                        </th>

                        <th  class="px-3 hidden lg:table-cell py-2">

                            Documento

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Tipo

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Fecha inicial

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Fecha final

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Observaciones

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Registro

                        </th>

                        <th class="px-3 hidden lg:table-cell py-2">

                            Actualizado

                        </th>

                        <th class="px-3 hidden lg:table-cell py-2">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                    @foreach($incapacidades as $incapacidad)

                        <tr class="text-sm text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Folio</span>

                                <a href="{{ route('incapacidades') . '?search=' . $incapacidad->folio }}">{{ $incapacidad->folio }}</a>

                            </td>


                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Documento</span>

                                <a href="{{ $incapacidad->imagenUrl() }}" data-lightbox="{{ $incapacidad->id }}" data-title="Documento">
                                    <img class="h-20 py-1" src="{{ $incapacidad->imagenUrl() }}" alt="Incapacidad">
                                </a>

                            </td>

                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                {{ $incapacidad->tipo }}

                            </td>

                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha Inicial</span>

                                {{ $incapacidad->fecha_inicial }}

                            </td>

                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha final</span>

                                {{ $incapacidad->fecha_final }}

                            </td>

                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Observaciones</span>

                                {{ $incapacidad->observaciones }}

                            </td>

                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                @if($incapacidad->creado_por != null)

                                    <span class="font-semibold">Registrado por: {{ $incapacidad->creadoPor->name }}</span> <br>

                                @endif

                                {{ $incapacidad->created_at }}

                            </td>

                            <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                @if($incapacidad->actualizado_por != null)

                                    <span class="font-semibold">Actualizado por: {{$incapacidad->actualizadoPor->name}}</span> <br>

                                @endif

                                {{ $incapacidad->updated_at }}

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                @can('Borrar incapacidad')

                                    <button
                                        wire:click="abrirModalEliminar({{ $incapacidad->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="abrirModalEliminar({{ $incapacidad->id }})"
                                        class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-1 items-center rounded-full hover:bg-red-700 flex focus:outline-none"
                                    >

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>

                                        <p>Eliminar</p>

                                    </button>

                                @endcan

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

                            {{ $incapacidades->links()}}

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

    <x-confirmation-modal wire:model="modal">

        <x-slot name="title">
            Eliminar incapacidad
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar la incapacidad? No sera posible recuperar la información.
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
                wire:click="eliminar"
                wire:loading.attr="disabled"
                wire:target="eliminar"
            >
                Borrar
            </x-danger-button>

        </x-slot>

    </x-confirmation-modal>

</div>

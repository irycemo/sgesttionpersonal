<div class="overflow-y-auto">

    @if($faltas->count())

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs text-gray-500 uppercase text-left traling-wider">

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Tipo

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Registro

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Justificación

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                    @foreach($faltas as $falta)

                        <tr class="text-sm text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                {{ $falta->tipo }}

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registro</span>

                                {{ $falta->created_at }}

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Justificación</span>

                                @if ($falta->justificacion)

                                <a href="{{ route('justificaciones') . '?search=' . $falta->justificacion->folio }}">Folio: {{ $falta->justificacion->folio }}</a>

                                @else

                                    Sin justificación

                                @endif

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

                            {{ $faltas->links()}}

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

</div>

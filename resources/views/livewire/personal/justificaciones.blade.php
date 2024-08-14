<div>

    @if($justificaciones->count())

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs text-gray-500 uppercase text-left traling-wider">

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Folio

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Documento

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Retardo / Falta

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Observaciones

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Registro

                        </th>

                        <th  class=" px-3 hidden lg:table-cell py-2">

                            Actualizado

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                    @foreach($justificaciones as $justificacion)

                        <tr class="text-sm text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                            <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Motivo</span>

                                <a href="{{ route('justificaciones') . '?search=' . $justificacion->folio }}">{{ $justificacion->folio }}</a>

                            </td>

                            <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">fecha</span>

                                <a href="{{ $justificacion->imagenUrl() }}" data-lightbox="{{ $justificacion->id }}" data-title="Documento">
                                    <img class="h-20 py-1" src="{{ $justificacion->imagenUrl() }}" alt="Justificación">
                                </a>

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Retardo / Falta</span>

                                @if ($justificacion->retardo)

                                    Retardo: {{ $justificacion->retardo->created_at }}

                                @elseif($justificacion->falta)

                                    Falta: {{ $justificacion->falta->tipo }} / {{ $justificacion->falta->created_at }}

                                @endif

                            </td>

                            <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Observaciones</span>

                                {{ $justificacion->observaciones }}

                            </td>

                            <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                @if($justificacion->creadoPor != null)

                                    <span class="font-semibold">Registrado por: {{$justificacion->creadoPor->name}}</span> <br>

                                @endif

                                {{ $justificacion->created_at }}

                            </td>

                            <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                @if($justificacion->actualizadoPor != null)

                                    <span class="font-semibold">Actualizado por: {{$justificacion->actualizadoPor->name}}</span> <br>

                                @endif

                                {{ $justificacion->updated_at }}

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

                            {{ $justificaciones->links()}}

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

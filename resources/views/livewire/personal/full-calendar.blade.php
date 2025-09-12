<div class="p-4">

    <input type="month" class="bg-white rounded text-sm w-full lg:w-1/6 mb-3 " wire:model.live="mes">

    <div class="bg-white" id='calendar' wire:ignore></div>

    <x-dialog-modal wire:model="modal" maxWidth="sm">

        <x-slot name="title">

            @if($evento)

                {{ $evento['title'] }}

            @endif

        </x-slot>

        <x-slot name="content">

            <div class="text-left space-y-3">

                @if($evento)

                    @if($evento['title'] === 'Incapacidad')

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Fecha inicial:</strong> {{ $evento['start'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Fecha final:</strong> {{ $evento['end'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Tipo:</strong> {{ $evento['extendedProps']['tipo'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Registrado por:</strong> {{ $evento['extendedProps']['registrado_por'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Observaciones:</strong> {{ $evento['extendedProps']['observaciones'] }}</p>

                        </div>

                    @elseif($evento['title'] === 'Incidencia')

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Tipo:</strong> {{ $evento['extendedProps']['tipo'] }}</p>

                        </div>

                    @elseif($evento['title'] === 'Jutificación')

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Registrado por:</strong> {{ $evento['extendedProps']['registrado_por'] }}</p>

                        </div>

                        @if(isset($evento['extendedProps']['falta']))

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Falta:</strong> {{ $evento['extendedProps']['falta'] }}</p>

                            </div>

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Tipo:</strong> {{ $evento['extendedProps']['tipo_falta'] }}</p>

                            </div>

                        @else

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Falta:</strong> {{ $evento['extendedProps']['retardo'] }}</p>

                            </div>

                        @endif

                    @elseif($evento['title'] === 'Permiso')

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Tipo:</strong> {{ $evento['extendedProps']['tipo'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Fecha inicial:</strong> {{ $evento['start'] }}</p>

                        </div>

                        @if(isset($evento['end']))

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Fecha final:</strong> {{ $evento['end'] }}</p>

                            </div>

                        @endif

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Registrado por:</strong> {{ $evento['extendedProps']['registrado_por'] }}</p>

                        </div>

                    @elseif($evento['title'] === 'Falta')

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Fecha inicial:</strong> {{ $evento['start'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Tipo:</strong> {{ $evento['extendedProps']['tipo'] }}</p>

                        </div>

                    @elseif($evento['title'] === 'Retardo')

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Fecha inicial:</strong> {{ $evento['start'] }}</p>

                        </div>

                    @endif

                @endif

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="flex justify-end gap-3">

                <x-button-red
                    wire:click="$toggle('modal')"
                    wire:loading.attr="disabled"
                    wire:target="$toggle('modal')"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

</div>

<script>

    document.addEventListener('livewire:initialized', function() {

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          events: JSON.parse(@this.events),
          initialView: 'dayGridMonth',
          headerToolbar: false,
          locale: 'es',

            eventClick: function(info) {

                @this.abrirModalEvento(info);

            }

        });

        @this.on(`refreshCalendar`, () => {
            calendar.refetchEvents()
            calendar.gotoDate(@this.mes)
        });

        calendar.render();

      });

</script>

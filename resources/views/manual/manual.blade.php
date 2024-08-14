<x-app-layout>

    <div class="relative min-h-screen md:flex">

        {{-- Sidebar --}}
        <div id="sidebar" class="z-50 bg-white w-64 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out md:relative md:translate-x-0">

            {{-- Header --}}
            <div class="w-100 flex-none bg-white border-b-2 border-b-grey-200 flex flex-row p-5 pr-0 justify-between items-center h-20 ">

                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="mx-auto">

                    <img class="h-16" src="{{ asset('storage/img/logo2.png') }}" alt="Logo">

                </a>

                {{-- Side Menu hide button --}}
                <button  type="button" title="Cerrar Menú" id="sidebar-menu-button" class="md:hidden mr-2 inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

            {{-- Nav --}}
            <nav class="p-4 text-rojo">

                <a href="#usuarios" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>

                    Usuarios
                </a>

                <a href="#horarios" class="mb-3 capitalize text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>

                    Horarios
                </a>

                <a href="#permisos" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>

                    Permisos
                </a>

                <a href="#incapacidades" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>

                    Incapacidades
                </a>

                <a href="#justificaciones" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>

                    Justificaciones
                </a>

                <a href="#inhabil" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    Días Inhábiles
                </a>

                <a href="#reportes" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>

                    Reportes
                </a>

                <a href="#checador" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>

                    Checador
                </a>

                <a href="#personal" class="mb-3 capitalize text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg"  class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>

                    Personal
                </a>

                <a href="#formatos" class="mb-3 capitalize text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>

                    Formatos
                </a>

            </nav>

        </div>

        {{-- Content --}}
        <div class="flex-1 flex-col flex max-h-screen overflow-x-auto min-h-screen">

            {{-- Mobile --}}
            <div class="w-100 bg-white border-b-2 border-b-grey-200 flex-none flex flex-row p-5 justify-between items-center h-20">

                <!-- Mobile menu button-->
                <div class="flex items-center">

                    <button  type="button" title="Abrir Menú" id="mobile-menu-button" class="md:hidden inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                    </button>

                </div>

                {{-- Logo --}}
                <p class="font-semibold text-2xl text-rojo">Manual de Usuario</p>

                <div></div>

            </div>

            {{-- Main Content --}}
            <div class="bg-white flex-1 overflow-y-auto py-8 md:border-l-2 border-l-grey-200">

                <div class="lg:w-2/3 mx-auto rounded-xl">

                    <div class="capitulo mb-10" id="introduccion">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Introducción</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                El Sistema de Gestión Personal, tiene como propósito administrar los empleados del Instituto Registral y Catastral de Michoacán.
                                El sistema permite dar seguimiento a las incidencias que cada empleado genera como: faltas, retardos, justificaciones, entre otras.
                                La información puede ser accesada y procesada en cada una de las áreas correspondientes asi como hacer reportes generados en Excel.
                            </p>

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="usuarios">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Usuarios</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de usuarios lleva el control del registro de los usuarios del sistema. Los usuarios estan clasificados por roles
                                ('Delegado(a) Administrativo(a)' y 'Contador(a)' y 'Checador')
                                cada uno con atribuciones distintas. Solo los usuarios con rol de "Delegado(a) Administrativo(a)" pueden agregar nuevos usuarios y editarlos.
                            </p>

                            <p>
                                <strong>Busqueda de usuario:</strong>
                                puede hacer busqueda de usuarios por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nuevo usuario:</strong>
                                puede agregar un nuevo usuario haciendo click el el botón "Agregar nuevo usuario" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_modal_crear.jpg') }}" alt="Imágen crear">

                            <p>
                                <strong>Editar usuario:</strong>
                                cada usuario tiene asociado dos botones de acciones, puede editar un usuario haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información del usuario para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_editar.jpg') }}" alt="Imágen buscar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_modal_editar.jpg') }}" alt="Imágen editar">

                            <p>
                                <strong>Borrar usuario:</strong>
                                puede borrar un usuario haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_borrar.jpg') }}" alt="Imágen borrar">

                            <p>
                                Al crear un usuario, su credenciales para iniciar sesión seran su correo y la contraseña "sistema", al tratar de iniciar sesión le pedira actualizar su contraseña.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/actualizar_contraseña.jpg') }}" alt="Imágen contraseña">

                            <p>
                                Puede revisar su perfil de usuario haciendo click en el circulo superior izquierdo en la opción "Mi perfil"
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/perfil.jpg') }}" alt="Imágen perfil">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="horarios">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Horarios</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de horarios lleva el control del registro de los horarios los cuales estaran asignados a cada uno de los empleados.Cada registro tiene
                                los siguientes campos:
                            </p>

                            <p class="mb-2 px-4">
                                <strong>Nombre:</strong> Es el nombre del horario.
                                <br>
                                <strong>Tolerancia:</strong> El tiempo limite que tiene el empleado para registrar su entrada sin que se genere un retardo (minutos).
                                <br>
                                <strong>Falta:</strong> El tiempo limite que tiene el empleado para registrar su entrada sin que se genere una falta (minutos)..
                                <br>
                                <strong>Descripción:</strong> Descripción del horario.
                                <br>
                                <strong>Lunes entrada:</strong> Hora de entrada.
                                <br>
                                <strong>Lunes salida:</strong> Hora de salida.
                                <br>
                                <strong>Martes entrada:</strong> Hora de entrada.
                                <br>
                                <strong>Martes salida:</strong> Hora de salida.
                                <br>
                                <strong>Miercoles entrada:</strong> Hora de entrada.
                                <br>
                                <strong>Miercoles salida:</strong> Hora de salida.
                                <br>
                                <strong>Jueves entrada:</strong> Hora de entrada.
                                <br>
                                <strong>Jueves salida:</strong> Hora de salida.
                                <br>
                                <strong>Viernes entrada:</strong> Hora de entrada.
                                <br>
                                <strong>Viernes salida:</strong> Hora de salida.
                                <br>
                            </p>

                            <p>
                                <strong>Busqueda de horario:</strong>
                                puede hacer busqueda de horarios por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/horarios_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nuevo horario:</strong>
                                puede agregar una nuevo horario haciendo click el el botón "Agregar nueva Horario" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/horarios_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar horario:</strong>
                                cada horario tiene asociado dos botones de acciones, puede editar un horario haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información de la dependencia para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/horarios_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/horarios_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Borrar horario:</strong>
                                puede borrar un horario haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/horarios_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="permisos">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Permisos</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de permisos lleva el control del registro de los permisos. Cada registro tiene los siguientes campos:
                            </p>

                            <p class="mb-2 px-4">
                                <strong>Límite:</strong> Es la cantidad veces que el empleado puede solicitar el permiso en el mes actual.
                                <br>
                                <strong>Tipo:</strong> El tipo de permiso puede ser "Oficial" o "Personal".
                                <br>
                                <strong>Tiempo:</strong> El tiempo que abarca el permiso.
                                <br>
                                <strong>Descripción:</strong> Descripción general del permiso.
                                <br>
                            </p>

                            <p>
                                <strong>Busqueda de permisos:</strong>
                                puede hacer busqueda de permisos por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/permisos_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nuevo permiso:</strong>
                                puede agregar un nuevo permiso haciendo click el el botón "Agregar nueva Permiso" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/permiso_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar permiso:</strong>
                                cada permiso tiene asociado tres botones de acciones, puede editar una permiso haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información de la permiso para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/permiso_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/permiso_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Asignar</strong>
                                puede hacer asignaciones de permisos a cualquier empleado indicando la fecha en la que será asignado.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/permiso_asignar.jpg') }}" alt="Imágen asignar">

                            <p>
                                <strong>Borrar permiso:</strong>
                                puede borrar un permiso haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/permiso_borrar.jpg') }}" alt="Imágen borrar">

                            <p>
                                <strong>Tareas automáticas:</strong>
                                El sistema integra tareas automáticas, estas se encargan de revisar los registros efectuados por los permisos
                                solicitados por los empleados.
                                <br>
                                Cada fin de mes se ejecuta una tarea encargada de calcular el tiempo consumido por los permisos personales solicitados de cada empleado, si
                                la cantidad de tiempo es mayor a la cantidad de tiempo de una jornada laboral se le agregara un permiso "Día Económico" descontandose del límite
                                de permisos que puede solicitar de este tipo de permiso.
                                <br>
                                Otra tarea automática es la de revisar los permisos personales solicitados por los empleados en los que no se registra  su regreso,
                                calculando el tiempo consumido desde su salida hasta la hora de salida que tiene su horario.
                            </p>

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="incapacidades">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Incapacidades</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de incapacidades lleva el control del registro de las incapacidades. Cada registro tiene los siguientes campos:
                            </p>

                            <p class="mb-2 px-4">
                                <strong>Folio:</strong> Es el folio con el que se identifica la incapacidad.
                                <br>
                                <strong>Tipo:</strong> El tipo de incacpacidad.
                                <br>
                                <strong>Empleado:</strong> El empleado que se incapacita.
                                <br>
                                <strong>Documento:</strong> El documento que avala la incapacidad.
                                <br>
                                <strong>Fecha Inicial:</strong> La fecha en la que comienza la incapacidad.
                                <br>
                                <strong>Fecha Final:</strong> La fecha en la que termina la incapacidad.
                                <br>
                            </p>

                            <p>
                                <strong>Busqueda de incapacidades:</strong>
                                puede hacer busqueda de incapacidades por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/incapacidades_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nueva incapacidad:</strong>
                                puede agregar un nuevo incapacidades haciendo click el el botón "Agregar nuevo Incapacidad" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/incapacidades_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar incapacidad:</strong>
                                cada incapacidad tiene asociado dos botones de acciones, puede editar un incapacidades haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información del incapacidades para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/incapacidades_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/incapacidades_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Borrar incapacidad:</strong>
                                puede borrar un incapacidad haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/incapacidades_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="justificaciones">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Justificaciones</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de justificaciones lleva el control del registro de las justificaciones. Cada registro tiene los siguientes campos:
                            </p>

                            <p class="mb-2 px-4">
                                <strong>Folio:</strong> Es el folio con el que se identifica la justificación.
                                <br>
                                <strong>Empleado:</strong> El empleado que se justificará.
                                <br>
                                <strong>Retardo:</strong> El retardo que se pretende justificar.
                                <br>
                                <strong>Falta:</strong> La falta que se pretende justificar.
                                <br>
                                <strong>Documento:</strong> El documento que avala la justificación.
                            </p>

                            <p>
                                <strong>Busqueda de justificaciones:</strong>
                                puede hacer busqueda de justificaciones por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/justificaciones_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nueva justificación:</strong>
                                puede agregar una nueva justificación haciendo click el el botón "Agregar nueva justificación" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/justificaciones_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                Al seleccionar un empleado automaticamente se desplegaran las opciones de Retardo y Falta pudiendo seleccionar solo una de ellas.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/justificaciones_modal_crear_2.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar justificación:</strong>
                                cada justificación tiene asociado dos botones de acciones, puede editar una justificación haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información del justificación para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/justificaciones_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/justificaciones_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Borrar justificación:</strong>
                                puede borrar una justificación haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/justificaciones_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="inhabil">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Días Inhábiles</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de días inhabiles lleva el control del registro de los días inhabiles. Cada registro tiene los siguientes campos:
                            </p>

                            <p class="mb-2 px-4">
                                <strong>Fecha:</strong> La fecha del día inhabil.
                                <br>
                                <strong>Descripción:</strong> La descripción del día inhabil.
                            </p>

                            <p>
                                <strong>Busqueda de días inhabiles:</strong>
                                puede hacer busqueda de días inhabiles por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/inhabiles_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nuevo día inhabil:</strong>
                                puede agregar un nuevo día inhabil haciendo click el el botón "Agregar día inhabil" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/inhabiles_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar día inhabil:</strong>
                                cada día inhabil tiene asociado dos botones de acciones, puede editar un día inhabil haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información del día inhabil para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/inhabiles_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/inhabiles_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Borrar día inhabil:</strong>
                                puede borrar una día inhabil haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/inhabiles_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="reportes">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Reportes</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de reportes permite generar consultas sobre las áreas de interes asi como generar un archivo .xlsx (Excel) con el resultado de la consulta.
                            </p>

                            <p>
                                <strong>Generar consulta:</strong>
                                puede generar consulta de las áreas  indicando el intervalo de tiempo.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reporte_1.jpg') }}" alt="Imágen reportes">

                            <p>
                                <strong>Filtros:</strong>
                                cada área despleagrá un conjunto de opciones para filtrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reporte_2.jpg') }}" alt="Imágen reportes">

                            <p>
                                <strong>Generar reporte Excel:</strong>
                                Al tener seleccionados los filtros necesarios y hacer click en el botón "Filtrar", se desplegara una tabla con la información filtrada, puede hacer click en el boton "Exportar a Excel"
                                para generar el archivo
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reporte_3.jpg') }}" alt="Imágen reportes">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reporte_4.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="checador">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Checador</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de checador esta encargada de llevar el registro de las asistencias, inasistencias y retardos del personal.
                            </p>

                            <p>
                                <strong>Registro de entrada / salida:</strong>
                                El empleado generara su registro de llegada o salida en el sistema al ser escaneado o ingresado manualmente su código de barras. Esto desplegará
                                una nueva pantalla con información general del empleado
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/checador_1.jpg') }}" alt="Imágen checador">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/checador_2.jpg') }}" alt="Imágen checador">

                            <p>
                                <strong>Tareas automáticas:</strong>
                                El sistema integra tareas automáticas que se ejecutan una vez al día, estas se encargan de revisar los registros efectuados por el checador,
                                revisando los empleados que no registraron su entradas y generandoles una falta, si el empleado tiene registrada una incapacidad ó permiso
                                no se le generará falta. Otra tarea automáticas es revisar si el empleado genera su tercer retardo automáticamente se le genera una falta.
                            </p>

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="personal">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Personal</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de personal lleva el control del registro de los empleados. Cada registro tiene los siguientes campos:
                            </p>

                            <p class="mb-2 px-4">
                                <strong># Empleado:</strong> Es el número del empleado.
                                <br>
                                <strong>Nombre:</strong> Nombre del empleado.
                                <br>
                                <strong>Paterno:</strong> El apellido paterno del empleado.
                                <br>
                                <strong>Materno:</strong> El apellido materno del empleado.
                                <br>
                                <strong>Localidad:</strong> La localidad del empleado ,esta pueden ser las regionales o Catastro o RPP.
                                <br>
                                <strong>Área:</strong> El área a la que pertenece el empleado, esta puede ser direcciones, subdirecciones o departamentos.
                                <br>
                                <strong>Tipo:</strong> El tipo de empleado.
                                <br>
                                <strong>Código de barras:</strong> El código de barras del empleado.
                                <br>
                                <strong>Teléfono:</strong> El teléfono del empleado.
                                <br>
                                <strong>Email:</strong> El correo electrónico del empleado.
                                <br>
                                <strong>RFC:</strong> El RFC del empleado.
                                <br>
                                <strong>CURP:</strong> La CURP del empleado.
                                <br>
                                <strong>Domicilio:</strong> El domicilio del empleado.
                                <br>
                                <strong>Fecha de ingreso:</strong> La fecha en la que ingreso a trabajar al Instituto Registral y Catastral del Estado de Michoacán empleado.
                                <br>
                                <strong>Horario:</strong> El horario del empleado.
                                <br>
                                <strong>Estado:</strong> El estado del empleado puede estar activo o inactivo.
                                <br>
                                <strong>Observaciones:</strong> Observaciones necesarias del empleado.
                                <br>
                                <strong>Fotografía:</strong> Imagen del empleado.
                                <br>
                            </p>

                            <p>
                                <strong>Busqueda de personal:</strong>
                                puede hacer busqueda de personal por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nuevo personal:</strong>
                                puede agregar un nuevo personal haciendo click el el botón "Agregar nueva Personal" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar personal:</strong>
                                cada personal tiene asociado tres botones de acciones, puede editar una personal haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información de la personal para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Ver</strong>
                                puede ver la información completa del personal haciendo click en el boton "Ver", asi como todas las incidencias que ha generado cada empleado.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_ver.jpg') }}" alt="Imágen ver">

                            <p>
                                <strong>Borrar personal:</strong>
                                puede borrar un personal haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="formatos">

                        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-6  bg-white">Personal</h2>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de formatos puede generar los diferentes tipos de formatos para asignar permisos a los empleados.
                            </p>

                            <p>
                                <strong>Formato:</strong>
                                debe seleccionar de las opciones el tipo de formato que se solicite.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Empleado:</strong>
                                es necesario seleccionar el usuario que lo solicita.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/personal_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Fecha y hora:</strong>
                                de pendiendo del tipo de formato se mostraran los campos necesarios.
                            </p>

                            <p>
                                <strong>Autoriza:</strong>
                                es necesario seleccionar la autoridad que autoriza.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/formatos.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        const btn_close = document.getElementById('sidebar-menu-button');
        const btn_open = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');

        btn_open.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        btn_close.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        /* Change nav profile image */
        window.addEventListener('nav-profile-img', event => {

            document.getElementById('nav-profile').setAttribute('src', event.detail.img);

        });

    </script>

</x-app-layout>

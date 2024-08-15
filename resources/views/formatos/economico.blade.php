<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
</head>
<style>

@page {
        size: A5 landscape;
    }

    header{
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 80px;
        text-align: center;
    }

    header img{
        height: 80px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }


    body{
        margin-top: 90px;
        margin-bottom: 20px;
        margin-left: auto;
        margin-right: auto;
        counter-reset: page;
        height: 100%;
        background-image: url("storage/img/escudo_fondo.png");
        background-size: contain;
        background-position:center;
        background-repeat: no-repeat;
        font-family: sans-serif;
        font-weight: normal;
        line-height: 1.5;
        text-transform: uppercase
    }

    .container{
        font-size: 10px;
        display: flex;
        align-content: space-around;
    }

    .tabla{
        width: 100%;
        font-size: 10px;
        margin-bottom: 30px;;
        margin-left: auto;
        margin-right: auto;
    }

</style>
<body>

    <header>


            <img src="{{ public_path('storage/img/encabezado.png') }}" alt="encabezado">


    </header>

    <main>

        <div class="container">

            <p class="titulo">SOLICITUD DE PERMISO ECONÓMICO</p>

            <p><strong>Nombre del empleado: </strong>{{ $empleado }}</p>
            <p><strong>Adscrito al departamento: </strong>{{ $departamento }}</p>
            <p><strong>Número de dias solicitados: </strong>{{ $dias }}</p>
            <div>
                <p><strong>Fecha inicial: </strong>{{ $fecha1 }}, <strong>Fecha final: </strong>{{ $fecha2 }}</p>
            </div>
            {{-- <p class="observaciones"><strong>Observaciones: </strong>{{ $observaciones }}</p> --}}
            <p><strong>Elaboró: </strong>{{ auth()->user()->name }}, el {{ now()->format('d-m-Y H:i:s') }}</p>

            <div class="firmas">

                <table class="tabla">

                    <thead>

                        <tr>
                            <th >
                                <p>Empleado</p>
                                <p style="font-weight: 400; vertical-align: top">{{ $empleado }}</p>
                            </th>
                            <th>
                                <p>Autoriza</p>
                                <p style="font-weight: 400; vertical-align: top">{{ $autoriza }}</p>
                            </th>
                        </tr>

                    </thead>

                </table>

            </div>

            <p style="font-size: 10px;">Confirmación de trabajo social (IMSS, ISSSTE, STASPE, SITASPE, Dir. de Pensiones, Dir. de Recursos Humanos)</p>

        </div>

    </main>
</body>
</html>

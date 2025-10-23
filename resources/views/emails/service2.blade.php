<!DOCTYPE html>
<html>

<head>
    <title>Tu Ticket</title>
    <style>
        @font-face {
            font-family: 'Arima';
            font-style: normal;
            font-weight: 400;
            src: url('https://fonts.googleapis.com/css2?family=Arima:wght@400&display=swap');
        }

        body {
            font-family: 'Arima', Arial, sans-serif;
        }

        .card {
            background-color: #64a4b5;
            color: #ffffff;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            color: black;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #0056b3;
            color: white;
        }

        #total {
            background-color: #0056b3;
            color: white;
        }

        .total {
            font-weight: bold;
        }

        .tittle {
            color: white;
        }
    </style>
</head>

<body>
    <div class="card">
        <center>
            <img src="cid:logo.png" alt="Logo de la Empresa" style="max-width: 200px;">
            <br>
            <h2 class="tittle">Centro Ecoturístico La Heredad</h2>
        </center>
        <center>
            <h1 class="tittle">¡Gracias por tu compra!</h1>
        </center>
        <center>
            <h2>Este es tu código QR:</h2>
        </center>
        <div style="text-align: center;">
            <img src="cid:qr_code.png" alt="Código QR" style="max-width: 150px;">
        </div>
        <center>
            <h2 class="tittle">Cabañas</h2>
        </center>
        <center>
            <h2>Información adicional:</h2>
        </center>
        <table>
            <thead>
                <tr>
                    <th>Fecha de reservación</th>
                    <th>Fecha de salida</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data[0]->fecha_ingreso }}</td>
                    <td>{{ $data[0]->fecha_egreso }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Cabaña</th>
                    <th>Tipo</th>
                    <th>Personas extra</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data[1] as $reservacion)
                    <tr>
                        <td>Cabaña {{ $reservacion['id_cabin'] }}</td>
                        <td>
                            @if ($reservacion['tipo_cabin'] == 1)
                                Cabaña sencilla
                            @elseif ($reservacion['tipo_cabin'] == 2)
                                Cabaña sencilla decorada
                            @elseif ($reservacion['tipo_cabin'] == 3)
                                Cabaña doble
                            @endif
                        </td>
                        <td>{{ $reservacion['personas_extra'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <center>
            <p class="tittle">Acceso libre al área de albercas</p>
        </center>
    </div>
</body>

</html>

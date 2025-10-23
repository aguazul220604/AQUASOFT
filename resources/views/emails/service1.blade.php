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
            <h2 class="tittle">Albercas</h2>
        </center>
        <center>
            <h2>Información adicional:</h2>
        </center>
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Niños menores de tres años</td>
                    <td>{{ $data[0] }}</td>
                    <td>$ {{ $data[1] }}</td>
                </tr>
                <tr>
                    <td>Niños y adultos</td>
                    <td>{{ $data[2] }}</td>
                    <td>$ {{ $data[3] }}</td>
                </tr>
                <tr>
                    <td>Adultos mayores</td>
                    <td>{{ $data[4] }}</td>
                    <td>$ {{ $data[5] }}</td>
                </tr>
                <tr id="total">
                    <td colspan="2" class="total" style="text-align: right;">Total</td>
                    <td class="total">$ {{ $data[6] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

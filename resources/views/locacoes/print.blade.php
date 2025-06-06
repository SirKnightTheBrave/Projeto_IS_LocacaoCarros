<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reserva</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header img {
            max-height: 60px;
        }

        .title {
            font-size: 22px;
            margin-top: 10px;
            color: #004080;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 10px;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        .label {
            font-weight: bold;
            width: 30%;
            color: #004080;
        }

        .value {
            width: 70%;
        }

        .footer {
            position: absolute;
            bottom: 40px;
            left: 40px;
            right: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="header">
        {{-- Adicione um logo aqui se quiser --}}
        {{-- <img src="{{ public_path('images/logo.png') }}" alt="Logo"> --}}
        <div class="title">Dados da Reserva</div>
    </div>

    <table>
        <tr>
            <td class="label">ID:</td>
            <td class="value">{{ $reserva->id }}</td>
        </tr>
        <tr>
            <td class="label">Usuário:</td>
            <td class="value">{{ $reserva->user->name }}</td>
        </tr>
        <tr>
            <td class="label">Email:</td>
            <td class="value">{{ $reserva->user->email }}</td>
        </tr>
        <tr>
            <td class="label">Bem Locável:</td>
            <td class="value">{{ $reserva->bemLocavel->modelo }}</td>
        </tr>
        <tr>
            <td class="label">Data de Início:</td>
            <td class="value">{{ $reserva->data_inicio->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">Data de Fim:</td>
            <td class="value">{{ $reserva->data_fim->format('d/m/Y') }}</td>
        </tr>
    </table>

    <div class="footer">
        Gerado automaticamente por {{ config('app.name') }} em {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>

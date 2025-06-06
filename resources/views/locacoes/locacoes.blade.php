<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Reservas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y2FyJTIwd2FsbHBhcGVyfGVufDB8fDB8fHww');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* <-- add this line */
        }
              body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            /* semi-transparent overlay */
            z-index: -1;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    @include('layouts.navigation')

    <main class="pt-[70px] max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-white mb-6">As Minhas Reservas</h1>

        @if ($reservas->isEmpty())
            <div class="bg-white p-6 rounded-xl shadow text-gray-700">
                Nenhuma reserva encontrada.
            </div>
        @else
            <ul class="bg-white rounded-xl shadow divide-y divide-gray-200">
                @foreach ($reservas as $reserva)
                    <li>
                        <a href="{{ route('locacao.show', $reserva->id) }}"
                            class="block px-6 py-4 hover:bg-gray-100 transition">
                            <div class="font-semibold text-gray-800">{{ $reserva->bemLocavel->modelo }}  {{$reserva->bemLocavel->registo_unico_publico}}</div>
                            <div class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($reserva->data_inicio)->format('d/m/Y') }}
                                -
                                {{ \Carbon\Carbon::parse($reserva->data_fim)->format('d/m/Y') }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>
</body>

</html>

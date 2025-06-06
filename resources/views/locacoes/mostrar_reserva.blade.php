<!-- resources/views/mostrar_reserva.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Detalhes da Reserva</title>
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID&currency=EUR"></script>
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
        <h1 class="text-3xl font-bold text-white mb-6">Detalhes da Reserva</h1>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex flex-col md:flex-row gap-6 mb-6">
                <div class="md:w-1/2">
                    <img src="{{ $reserva->bem_locavel->imageUrl ?? 'https://www.rentava.ch/wp-content/uploads/2025/01/hyundai-i30-wagon.jpg' }}"
                        alt="imagem generica carro" class="rounded-md w-full h-64 object-cover">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-2xl font-semibold mb-2">ID Reserva: {{ $reserva->id }}</h2>
                    <h2 class="text-2xl font-semibold mb-2">Veiculo: {{ $reserva->bemLocavel->modelo }}</h2>
                    <p class="text-purple-600 text-lg font-bold mt-2">
                        Total: {{ $reserva->preco_total }} €
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p><strong>Data Início:</strong> {{ $reserva->data_inicio }}</p>
                    <p><strong>Data Fim:</strong> {{ $reserva->data_fim }}</p>
                </div>
                <div>
                    <p><strong>Cliente:</strong> {{ $reserva->user->name }}</p>
                    <p><strong>Email:</strong> {{ $reserva->user->email }}</p>
                </div>
            </div>
            <!-- botão de imprimir reserva em PDF -->
            <form action="{{ route('locacoes.print', $reserva->id) }}" method="GET" class="mb-4">
                <button class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700">
                    Baixar PDF da Reserva
                </button>
            </form>
        </div>

    </main>
</body>

</html>

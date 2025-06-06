<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efetuar Reserva</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
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
        <h1 class="text-3xl font-bold text-white mb-6">Reserva do Veículo</h1>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Imagem do Veículo -->
                <div class="md:w-1/2">
                    <img src="{{ $veiculo->imageUrl ?? 'https://www.rentava.ch/wp-content/uploads/2025/01/hyundai-i30-wagon.jpg' }}"
                        alt="{{ $veiculo->modelo }}" class="rounded-md w-full h-64 object-cover">
                </div>

                <!-- Informações do Veículo -->
                <div class="md:w-1/2">
                    <h2 class="text-2xl font-semibold mb-2">{{ $veiculo->modelo }}</h2>
                    <p class="text-gray-700 mb-1">Marca: {{ $marcaNome }}</p>
                    <p class="text-gray-700 mb-1">Ano: {{ $veiculo->ano }}</p>
                    <p class="text-gray-700 mb-1">Transmissão: {{ $veiculo->transmissao }}</p>
                    <p class="text-gray-700 mb-1">Portas: {{ $veiculo->numero_portas }}</p>
                    <p class="text-gray-700 mb-1">Passageiros: {{ $veiculo->numero_passageiros }}</p>
                    <p class="text-gray-700 mb-1">Combustível: {{ $veiculo->combustivel }}</p>
                    <div>
                        <p class="text-gray-700 mb-1">Características:</p>
                        <ul class="list-disc pl-5 text-gray-600">

                            @foreach ($caracteristicasNomes as $nome)
                                <li>{{ $nome }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <p class="text-purple-600 text-lg font-bold mt-2">
                        {{ number_format($veiculo->preco_diario, 2, ',', '.') }} € / dia
                    </p>
                </div>
            </div>

            <form action="{{ route('locacao.store') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="bem_locavel_id" value="{{ $veiculo->id }}">

                <!-- Datas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="data_inicio" class="block font-medium text-gray-700">Data de Início</label>
                        <input type="date" name="data_inicio" id="data_inicio" required min="{{ date('Y-m-d') }}"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm"
                            value="{{ old('data_inicio') }}">
                    </div>

                    <div>
                        <label for="data_fim" class="block font-medium text-gray-700">Data de Entrega</label>
                        <input type="date" name="data_fim" id="data_fim" required
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm"
                            value="{{ old('data_fim') }}">
                    </div>
                </div>

                <!-- Informações do Cliente -->
                <div>
                    <label for="nome" class="block font-medium text-gray-700">Nome Completo</label>
                    <input type="text" name="nome" id="nome" required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm"
                        value="{{ old('nome', Auth::user()->name ?? '') }}">
                </div>

                <!-- Simulação Multibanco -->
                <div class="mt-6 bg-gray-100 p-4 rounded">
                    <p class="mb-2 font-medium">Referência Multibanco:</p>
                    <p>Entidade: 12345</p>
                    <p>Referência: <span id="referencia_multibanco"></span></p>
                    <p>Valor: <span id="preco_total_label"></span></p>
                    <input type="hidden" name="preco_total" id="preco_total" value="">
                </div>
                <!-- Botão -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-green-600 text-white font-semibold py-3 rounded-md hover:bg-green-700 transition duration-300">
                        Confirmar Pagamento e Reservar
                    </button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const precoDiario = {{ $veiculo->preco_diario }};
        const dataInicioInput = document.getElementById('data_inicio');
        const dataFimInput = document.getElementById('data_fim');
        const precoTotalInput = document.getElementById('preco_total');
        const precoTotalLabel = document.getElementById('preco_total_label');
        const referenciaSpan = document.getElementById('referencia_multibanco');

        function calcularDias() {
            const inicio = new Date(dataInicioInput.value);
            const fim = new Date(dataFimInput.value);
            if (dataInicioInput.value && dataFimInput.value && fim > inicio) {
                const diffTime = fim - inicio;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                return diffDays;
            }
            return 1;
        }

        function atualizarPreco() {
            const dias = calcularDias();
            const total = dias * precoDiario;
            precoTotalInput.value = total.toFixed(2); // hidden input for backend
            precoTotalLabel.textContent = total.toLocaleString('pt-PT', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + ' €'; // visible label for user
        }

        function gerarReferencia() {
            // Gera um número de 9 dígitos, formatado em 3 blocos
            let ref = Math.floor(100000000 + Math.random() * 900000000).toString();
            return ref.replace(/(\d{3})(\d{3})(\d{3})/, "$1 $2 $3");
        }

        // Atualiza a referência ao carregar a página
        if (referenciaSpan) {
            referenciaSpan.textContent = gerarReferencia();
        }

        dataInicioInput.addEventListener('change', atualizarPreco);
        dataFimInput.addEventListener('change', atualizarPreco);

        atualizarPreco();
    });
</script>

</html>

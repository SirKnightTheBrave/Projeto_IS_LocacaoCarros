<!-- resources/views/disponiveis/index.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casas em Destaque</title>
      <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
  <style>
    .steering-wheel {
      width: 20px;
      height: 20px;
      color: #333;
    }
    .car-door {
      width: 20px;
      height: 20px;
      color: #333;
    }
        .car-seat {
      width: 20px;
      height: 20px;
      color: #333;
    }
        .gas-pump {
      width: 20px;
      height: 20px;
      color: #333;
    }
       .calendar-icon {
      width: 20px;
      height: 20px;
      color: #333;
    }
  </style>
</head>

<body class="beige-light">
   @include('layouts.navigation')
<main>
    <!-- Barra de filtro -->
    <section class="pt-[70px] relative">
        <div class="bg-gradient-to-r from-white via-gray-50 to-white shadow-lg rounded-xl p-6 mb-2 border border-gray-100">
            <form action="{{ route('disponiveis') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

             <form action="{{ route('disponiveis') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Data de Chegada -->
                <div>
                    <label for="data_inicio" class="block text-sm font-semibold text-gray-700 mb-1">
                        📅 Data de Chegada
                    </label>
                    <input type="date" id="data_inicio" name="data_inicio" value="{{ request('data_inicio') }}"
                        min="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-dark focus:border-purple-dark shadow-sm"
                        required>
                </div>

                <!-- Data de Saída -->
                <div>
                    <label for="data_fim" class="block text-sm font-semibold text-gray-700 mb-1">
                        📆 Data de Saída
                    </label>
                    <input type="date" id="data_fim" name="data_fim" value="{{ request('data_fim') }}"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-dark focus:border-purple-dark shadow-sm"
                        required>
                </div>


                <!-- Botão -->
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-md transition duration-300 flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Verificar Disponibilidade
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="mt-2 relative h-[45vh]">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Veiculos Disponiveis</h1>

            @if ($disponiveis->isEmpty())
                <div class="text-center text-gray-600">No vehicles available</div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($disponiveis as $bem)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 cursor-pointer"
                            onclick="openModal({{ $bem->id }})" role="button" tabindex="0">
                            <div class="relative aspect-w-16 aspect-h-9">
                                <img src="{{ $bem->imageUrl ?? 'https://www.rentava.ch/wp-content/uploads/2025/01/hyundai-i30-wagon.jpg' }}"
                                    alt="{{ $bem->modelo }}"
                                    class="w-full h-48 object-cover hover:opacity-90 transition-opacity duration-300"
                                    onerror="this.onerror=null; this.src='https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/25d45014-8cc3-4c98-b02c-5a0cf3a55ddd/dd4t3er-e0c91cc1-cba1-40ad-8126-064e12c86d01.png/v1/fill/w_1120,h_714/broken_after_the_accident_car__by_prussiaart_dd4t3er-pre.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzI1ZDQ1MDE0LThjYzMtNGM5OC1iMDJjLTVhMGNmM2E1NWRkZFwvZGQ0dDNlci1lMGM5MWNjMS1jYmExLTQwYWQtODEyNi0wNjRlMTJjODZkMDEucG5nIiwiaGVpZ2h0IjoiPD04MTYiLCJ3aWR0aCI6Ijw9MTI4MCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS53YXRlcm1hcmsiXSwid21rIjp7InBhdGgiOiJcL3dtXC8yNWQ0NTAxNC04Y2MzLTRjOTgtYjAyYy01YTBjZjNhNTVkZGRcL3BydXNzaWFhcnQtNC5wbmciLCJvcGFjaXR5Ijo5NSwicHJvcG9ydGlvbnMiOjAuNDUsImdyYXZpdHkiOiJjZW50ZXIifX0.LRu0w_a8ZYHpta55uPplj-HT4y_a3Exx9bsnu_KRrRw';"
                                    loading="lazy">
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $bem->modelo }}</h3>
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                        </path>
                                    </svg>

                                </div>
                                <div class="text-lg font-bold text-purple-light">
                                    {{ number_format($bem->preco_diario, 2, ',', '.') }} € <span
                                        class="text-sm font-normal text-gray-600">/por dia</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div id="propertyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4">
            <img id="modalImagem" src="" alt="Property Image" class="w-full h-64 object-cover rounded-lg mb-4"
                onerror="this.onerror=null; this.src='https://autoimage.capitalone.com/cms/Auto/assets/images/2772-hero-5-things-that-made-interiors-better.jpg'">
            <h2 id="modalTitulo" class="text-2xl font-bold mb-4"></h2>

            <div class="flex gap-x-8 items-center text-gray-600 mb-4">
                <!-- Par 1: Ícone + Texto: Numero Passageiros -->
                <div class="flex items-center gap-x-1">
                 <svg class="car-seat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
       stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
    <!-- Backrest -->
    <path d="M7 3h6c0.6 0 1 0.4 1 1v8H6V4c0-0.6 0.4-1 1-1z" />
    <!-- Seat base -->
    <path d="M5 14h14v4c0 0.6-0.4 1-1 1H6c-0.6 0-1-0.4-1-1v-4z" />
  </svg>
                    <span id="modalNumeroPassageiros" class="text-sm sm:text-base md:text-lg"></span>

                </div>

                <!-- Par 2: Número de Portas -->
                <div class="flex items-center gap-x-1">
                     <svg class="car-door" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
       stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
    <!-- Door Frame -->
    <path d="M3 20V8c0-1.1.9-2 2-2h6l6 4v10H3z" />
    <!-- Window Divider -->
    <path d="M11 6v4" />
    <!-- Handle -->
    <path d="M7 14h2" />
  </svg>
                    <span id="modalNumeroPortas" class="text-sm sm:text-base md:text-lg"></span>
                </div>

                <!-- Par 3: Transmissão -->
                <div class="flex items-center gap-x-1">
                <svg class="steering-wheel" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" />
                <circle cx="12" cy="12" r="3" />
                <path d="M12 2a10 10 0 0 1 10 10h-4a6 6 0 0 0-6-6V2z" />
                <path d="M12 22a10 10 0 0 1-10-10h4a6 6 0 0 0 6 6v4z" />
                <path d="M2 12h20" />
                </svg>
                    <span id="modalTransmissao" class="text-sm sm:text-base md:text-lg"></span>
                </div>
                <!-- Par 4: Combustível -->
                <div class="flex items-center gap-x-1">
                    <svg class="gas-pump" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
       stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
    <!-- Pump body -->
    <rect x="4" y="3" width="10" height="18" rx="2" ry="2" />
    <!-- Nozzle handle -->
    <path d="M14 8h2c0.6 0 1 0.4 1 1v4c0 0.6-0.4 1-1 1h-2" />
    <!-- Hose -->
    <path d="M16 12l4 4" />
    <!-- Trigger inside handle -->
    <path d="M15 10v2" />
  </svg>
                    <span id="modalCombustivel" class="text-sm sm:text-base md:text-lg"></span>
                </div>
                <!-- Par 5: Ano -->
                <div class="flex items-center gap-x-1">
                  <svg class="calendar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
       stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
    <!-- Outer frame -->
    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
    <!-- Top rings -->
    <line x1="16" y1="2" x2="16" y2="6" />
    <line x1="8" y1="2" x2="8" y2="6" />
    <!-- Top divider -->
    <line x1="3" y1="10" x2="21" y2="10" />
    <!-- Day cells (optional – can be removed or expanded) -->
    <circle cx="7" cy="14" r="1" />
    <circle cx="12" cy="14" r="1" />
    <circle cx="17" cy="14" r="1" />
    <circle cx="7" cy="18" r="1" />
    <circle cx="12" cy="18" r="1" />
    <circle cx="17" cy="18" r="1" />
  </svg>
                    <span id="modalAno" class="text-sm sm:text-base md:text-lg"></span>
                </div>
            </div>

            <p id="modalPreco" class="text-2xl font-bold text-purple-600 mb-4"></p>
            <button onclick="closeModal()"
            class="border-2 bg-orange-700 text-white px-6 py-2 rounded-lg bg-transparent hover:bg-orange-200 hover:border-orange-200 transition-colors duration-300">
                Ver mais
            </button>
        </div>
    </div>


    <script>
        // Array para armazenar dados das propriedades para uso no modal
        const properties = @json($disponiveis);

        function openModal(id) {
            const property = properties.find(p => p.id === id);

            if (!property) return;
            document.getElementById('modalImagem').src = property.imageUrl ||
                'https://autoimage.capitalone.com/cms/Auto/assets/images/2772-hero-5-things-that-made-interiors-better.jpg';
            document.getElementById('modalTitulo').textContent = property.modelo;
            document.getElementById('modalTransmissao').textContent = `${property.transmissao}`;
            document.getElementById('modalNumeroPortas').textContent = `${property.numero_portas} portas`;
            document.getElementById('modalNumeroPassageiros').textContent = `${property.numero_passageiros} lugares`;
            document.getElementById('modalCombustivel').textContent = `${property.combustivel}`;
            document.getElementById('modalAno').textContent = `${property.ano}`;
            document.getElementById('modalPreco').innerHTML =
                `${property.preco_diario.toLocaleString('pt-PT', {minimumFractionDigits: 2, maximumFractionDigits: 2}).replace('.', ',')} € <span class="text-sm font-normal text-gray-600">/por dia</span>`;

            document.getElementById('propertyModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Impede o scroll quando o modal está aberto
        }

        function closeModal() {
            document.getElementById('propertyModal').classList.add('hidden');
            document.body.style.overflow = ''; // Restaura o scroll
        }

        // Fecha o modal clicando fora dele
        document.getElementById('propertyModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        /* Fecha o modal com a tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('propertyModal').classList.contains('hidden')) {
                closeModal();
            }
        });*/

        // Seleciona os campos de data
        const dataInicio = document.getElementById('data_inicio');
        const dataFim = document.getElementById('data_fim');

        // Atualiza o mínimo de data_fim automaticamente
        dataInicio.addEventListener('change', () => {
            const dataSelecionada = new Date(dataInicio.value);
            dataSelecionada.setDate(dataSelecionada.getDate() + 1); // Define mínimo para um dia depois

            // Define a data mínima no formato correto automaticamente
            dataFim.min = dataSelecionada.toISOString().split("T")[0];

            // Ajusta a data de saída se estiver antes do mínimo permitido
            if (dataFim.value < dataFim.min) {
                dataFim.value = dataFim.min;
            }
        });

    </script>
 </main>
</body>
</html>

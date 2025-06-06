<x-app-layout>


    {{-- Full-screen background container --}}
    <div class="min-h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y2FyJTIwd2FsbHBhcGVyfGVufDB8fDB8fHww'); background-attachment: fixed;">

        {{-- Semi-transparent overlay --}}

        {{-- Semi-transparent overlay container --}}
        <div class="bg-white/55 dark:bg-gray-800/55 min-h-screen flex justify-center items-center p-5">
            <div class="w-full max-w-sm">

                @if (session('success'))
                    <div
                        class="alert alert-success shadow-lg rounded-lg py-4 px-6 font-semibold text-green-800 bg-green-100 ring-1 ring-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Bem-vindo, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Aqui você pode gerir as suas reservas e aceder aos seus dados.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{route('reservas.minhas')}}"
                           class="block bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            As Minhas Reservas
                        </a>
                        <a href="{{ route('disponiveis')}}"
                           class="block bg-green-600 text-white text-center py-3 rounded-lg hover:bg-green-700 transition duration-200">
                            Fazer Nova Reserva
                        </a>
                    </div>


            </div>
        </div>

    </div>
</x-app-layout>

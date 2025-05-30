<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Full-screen background container --}}
    <div class="min-h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y2FyJTIwd2FsbHBhcGVyfGVufDB8fDB8fHww');">

        {{-- Semi-transparent overlay container --}}
        <div class="bg-white/55 dark:bg-gray-800/55 min-h-screen flex justify-center items-center p-5">
            <div class="w-full max-w-sm">

                @if (session('success'))
                    <div
                        class="alert alert-success shadow-lg rounded-lg py-4 px-6 font-semibold text-green-800 bg-green-100 ring-1 ring-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('send.email') }}" method="POST"
                    class="mt-5 flex flex-col items-center space-y-2 p-4 border-2 border-gray-500 rounded-lg shadow-lg bg-gray-100 dark:bg-gray-900 dark:text-white">
                    @csrf
                    <label for="pickup" class="text-lg font-medium text-gray-700 dark:text-gray-300">
                        Local de levantamento da reserva:
                    </label>
                    <input type="text" id="pickup" name="pickup" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 text-white font-medium text-base md:text-lg rounded-full px-8 py-3 shadow-md hover:shadow-lg transition duration-300">
                        Enviar confirmação por e-mail
                    </button>
                </form>

            </div>
        </div>

    </div>
</x-app-layout>

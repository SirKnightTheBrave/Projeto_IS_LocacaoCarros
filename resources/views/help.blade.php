<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Knight's Carriage</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
</head>

<body class="font-sans antialiased dark:bg-black dark:text-blue">
    <div class="text-blue dark:bg-black dark:text-blue">
        <img id="background" class="absolute -left-20 top-0 max-w-[1990px]"
            src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y2FyJTIwd2FsbHBhcGVyfGVufDB8fDB8fHww"
            alt="Alpha" />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#4287f5] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
<header class="relative py-10">
    @if (Route::has('login'))
        <nav class="absolute top-0 right-0 space-x-4 p-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-hidden focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-white/90 dark:focus-visible:ring-white"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-hidden focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-white/90 dark:focus-visible:ring-white"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-hidden focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-white/90 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
                <main class="flex flex-col items-center justify-center gap-8 py-16 text-left">
                    <h1 class="text-5xl font-bold text-black dark:text-black">
                        The Knight's Carriage
                    </h1>
                    <p class="text-lg text-black dark:text-black bg-white dark:bg-white">
                        <span class="text-[#FF2D20]">F.A.Q.</span> <br>
                        <b>Q: </b> What is this website? <br>
                        <b>A: </b> This is a car rental website. <br>
                        <b>Q: </b> How do I rent a car? <br>
                        <b>A: </b> You need to register first. <br>
                        <b>Q: </b> How do I rent a car? <br>
                        <b>A: </b> After you log in, you can rent a car. <br>
                        <b>Q: </b> How do I pay? <br>
                        <b>A: </b> You can pay with a credit card or cash. <br>
                        <b>Q: </b> How do I cancel my reservation? <br>
                        <b>A: </b> You can cancel your reservation by logging in and going to your reservations. <br>
                        <b>Q: </b> How do I contact you? <br>
                        <b>A: </b> You can contact us by email or phone. <br>
                        <br>

                    </p>
                    <span class="text-[#FF2D20]">Rent your car now!</span>
                    <a href="{{ route('register') }}"
                        class="rounded-md bg-[#FF2D20] px-4 py-2 text-white transition hover:bg-[#FF2D20]/80 focus:outline-hidden focus-visible:ring-[#FF2D20] focus-visible:ring-offset-2 dark:bg-[#FF2D20] dark:hover:bg-[#FF2D20]/80 dark:focus-visible:ring-white">
                        Register Now
                    </a>

                    <footer>
                        <div class="flex items-center justify-center gap-2 py-4">
                            <a href="Contact" class="text-lg text-white dark:text-white">Contact</a>
                            <span class="text-lg text-white dark:text-white">|</span>
                            <a href="About" class="text-lg text-white dark:text-white">About</a>
                            <span class="text-lg text-white dark:text-white">|</span>
                            <a href="Privacy" class="text-lg text-white dark:text-white">Privacy</a>
                            <span class="text-lg text-white dark:text-white">|</span>
                            <a href="Terms" class="text-lg text-white dark:text-white">Terms</a>
                            <span class="text-lg text-white dark:text-white">|</span>
                            <a href="Help" class="text-lg text-white dark:text-white">Help</a>
                        </div>
                    </footer>




</body>

</html>

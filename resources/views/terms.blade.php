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
                        Terms and Conditions <br>
                        <span class="text-[#FF2D20]">The Knight's Carriage</span> is a car rental service that provides
                        customers with a wide range of vehicles for personal and business use. By using our service, you
                        agree to the following terms and conditions:
                        <br>

                        <b>MINIMUM RENTAL PERIOD</b><br>
                        The minimum rental period is one day (24 hours). The rental period begins when the vehicle is
                        picked up and ends when it is returned to the rental location. If the vehicle is not returned on
                        the agreed date and time, additional charges may apply. The rental period is limited to 1500 km
                        per month. If the vehicle is driven more than 1500 km in a month, an additional charge of €1.25
                        per km will apply. The rental period may be extended upon request, subject to availability and
                        additional charges. The customer must notify the rental location at least 24 hours in advance if
                        they wish to extend the rental period. The rental period may be shortened upon request, but no
                        refunds will be given for unused rental days.
                        <br>

                        <b>PAYMENT</b><br>

                        The customer must pay the rental fee in full at the time of booking. The rental fee includes the
                        cost of the vehicle, insurance coverage, and any additional charges. The rental fee does not
                        include fuel, tolls, parking fees, or any other charges incurred during the rental period. The
                        customer must pay any additional charges at the time of returning the vehicle. The rental fee is
                        non-refundable, except in the case of a cancellation made at least 48 hours before the scheduled
                        pick-up time. In the case of a cancellation made less than 48 hours before the scheduled pick-up
                        time, the customer will be charged a cancellation fee of 50% of the rental fee. <br>

                        <b>DRIVER</b><br>
                        The customer must be the primary driver of the vehicle during the rental period. The customer may
                        add additional drivers to the rental agreement, subject to approval by the rental location. The
                        additional drivers must meet the same requirements as the primary driver, including having a valid
                        driver's license and being at least 21 years old. The customer is responsible for any damage to the
                        vehicle caused by the additional drivers during the rental period.
                        <br>

                        <b>VEHICLE CONDITION</b><br>
                        The customer must inspect the vehicle before picking it up and report any damage or defects to the
                        rental location. The customer is responsible for any damage to the vehicle during the rental
                        period, including any damage caused by accidents, theft, or vandalism. The customer must return the
                        vehicle in the same condition as it was received, with a full tank of fuel and all accessories
                        included. If the vehicle is returned with less fuel than it was received, a refueling charge will
                        apply. The customer is responsible for any damage to the vehicle during the rental period, including
                        any damage caused by accidents, theft, or vandalism. The customer must report any damage to the
                        vehicle to the rental location immediately.
                        <br>


                       <b>TERRITORIALITY</b><br>

                        The customer must use the vehicle only within the territory of the country where it was rented. The
                        customer must not take the vehicle outside the territory of the country without prior written
                        permission from the rental location. The customer is responsible for any fines or penalties incurred
                        for taking the vehicle outside the territory of the country without prior written permission from
                        the rental location. The customer is responsible for any damage to the vehicle caused by taking it
                        outside the territory of the country without prior written permission from the rental location.
                        <br>


                        <b>LEGAL NOTICES</b><br>
                        The customer agrees to comply with all applicable laws and regulations when using the vehicle. The
                        customer agrees to indemnify and hold harmless The Knight's Carriage and its employees, agents, and
                        affiliates from any claims, damages, or losses arising from the customer's use of the vehicle.


                        <br>


</body>
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

</html>

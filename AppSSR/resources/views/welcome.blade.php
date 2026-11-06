<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ProjectHub | Gestión de proyectos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    {{-- NAVEGACIÓN --}}
    <header class="border-b border-slate-200 bg-white">
        <nav class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6">

            <a href="/" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600 text-xl font-bold text-white">
                    P
                </div>

                <span class="text-xl font-bold tracking-tight text-slate-900">
                    ProjectHub
                </span>
            </a>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('projects.index') }}"
                       class="inline-flex min-h-11 items-center justify-center rounded-lg bg-indigo-600 px-5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                        Mis proyectos
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex min-h-11 items-center justify-center rounded-lg px-5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-indigo-600">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}"
                       class="inline-flex min-h-11 items-center justify-center rounded-lg bg-indigo-600 px-5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                        Registrarse
                    </a>
                @endauth
            </div>

        </nav>
    </header>


    <main>

        {{-- PRESENTACIÓN --}}
        <section class="bg-white px-6 py-24 sm:py-28">

            <div class="mx-auto max-w-4xl text-center">

                <span class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700">
                    Gestión de proyectos y equipos
                </span>

                <h1 class="mt-8 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    Organiza tus proyectos.
                    <span class="block mt-2 text-indigo-600">
                        Trabaja mejor en equipo.
                    </span>
                </h1>

                <p class="mx-auto mt-7 max-w-2xl text-lg leading-8 text-slate-500">
                    Crea proyectos, gestiona participantes y controla el progreso
                    de cada trabajo desde una única plataforma.
                </p>

                <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">

                    @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex h-12 w-full items-center justify-center rounded-lg bg-indigo-600 px-8 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 sm:w-52">
                            Crear una cuenta
                        </a>

                        <a href="{{ route('login') }}"
                           class="inline-flex h-12 w-full items-center justify-center rounded-lg border border-slate-300 bg-white px-8 text-sm font-semibold text-slate-700 transition hover:border-indigo-300 hover:bg-slate-50 sm:w-52">
                            Iniciar sesión
                        </a>
                    @else
                        <a href="{{ route('projects.index') }}"
                           class="inline-flex h-12 w-full items-center justify-center rounded-lg bg-indigo-600 px-8 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 sm:w-52">
                            Acceder a proyectos
                        </a>
                    @endguest

                </div>

            </div>

        </section>


        {{-- VISTA PREVIA DE LA APLICACIÓN --}}
        <section class="px-6 pb-24">

            <div class="mx-auto max-w-5xl">

                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60">

                    {{-- Barra superior --}}
                    <div class="flex h-14 items-center justify-between border-b border-slate-200 px-6">

                        <div class="flex items-center gap-2">
                            <span class="h-3 w-3 rounded-full bg-red-400"></span>
                            <span class="h-3 w-3 rounded-full bg-yellow-400"></span>
                            <span class="h-3 w-3 rounded-full bg-green-400"></span>
                        </div>

                        <span class="text-sm font-medium text-slate-400">
                            Panel de proyectos
                        </span>

                        <div class="w-12"></div>

                    </div>


                    <div class="p-6 sm:p-8">

                        {{-- Cabecera del panel --}}
                        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                            <div>
                                <p class="text-sm text-slate-500">
                                    Espacio de trabajo
                                </p>

                                <h2 class="mt-1 text-2xl font-bold text-slate-900">
                                    Mis proyectos
                                </h2>
                            </div>

                            <span class="inline-flex h-10 items-center justify-center rounded-lg bg-indigo-50 px-4 text-sm font-semibold text-indigo-700">
                                Vista general
                            </span>

                        </div>


                        {{-- Tarjetas de ejemplo --}}
                        <div class="mt-8 grid gap-5 md:grid-cols-3">

                            {{-- Proyecto 1 --}}
                            <div class="rounded-xl border border-slate-200 p-5">

                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        Proyecto 01
                                    </span>

                                    <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                                </div>

                                <h3 class="mt-5 font-semibold text-slate-900">
                                    Diseño web
                                </h3>

                                <p class="mt-2 min-h-10 text-sm leading-5 text-slate-500">
                                    Desarrollo y diseño de una página web.
                                </p>

                                <div class="mt-6 h-2 rounded-full bg-slate-100">
                                    <div class="h-2 w-3/4 rounded-full bg-indigo-600"></div>
                                </div>

                                <p class="mt-2 text-right text-xs font-medium text-slate-500">
                                    En progreso
                                </p>

                            </div>


                            {{-- Proyecto 2 --}}
                            <div class="rounded-xl border border-slate-200 p-5">

                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        Proyecto 02
                                    </span>

                                    <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                                </div>

                                <h3 class="mt-5 font-semibold text-slate-900">
                                    Aplicación móvil
                                </h3>

                                <p class="mt-2 min-h-10 text-sm leading-5 text-slate-500">
                                    Creación de una aplicación para móviles.
                                </p>

                                <div class="mt-6 h-2 rounded-full bg-slate-100">
                                    <div class="h-2 w-2/5 rounded-full bg-amber-500"></div>
                                </div>

                                <p class="mt-2 text-right text-xs font-medium text-slate-500">
                                    Pendiente
                                </p>

                            </div>


                            {{-- Proyecto 3 --}}
                            <div class="rounded-xl border border-slate-200 p-5">

                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        Proyecto 03
                                    </span>

                                    <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                                </div>

                                <h3 class="mt-5 font-semibold text-slate-900">
                                    Gestión interna
                                </h3>

                                <p class="mt-2 min-h-10 text-sm leading-5 text-slate-500">
                                    Organización del trabajo del equipo.
                                </p>

                                <div class="mt-6 h-2 rounded-full bg-slate-100">
                                    <div class="h-2 w-full rounded-full bg-green-500"></div>
                                </div>

                                <p class="mt-2 text-right text-xs font-medium text-slate-500">
                                    Completado
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- CARACTERÍSTICAS --}}
        <section class="border-t border-slate-200 bg-white px-6 py-24">

            <div class="mx-auto max-w-6xl">

                <div class="mx-auto max-w-2xl text-center">

                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                        Todo lo que necesitas para organizarte
                    </h2>

                    <p class="mt-4 text-base leading-7 text-slate-500">
                        Herramientas sencillas para gestionar proyectos y colaborar con otras personas.
                    </p>

                </div>


                <div class="mt-14 grid gap-8 md:grid-cols-3">

                    {{-- Característica 1 --}}
                    <div class="flex flex-col items-center rounded-xl border border-slate-200 bg-white p-8 text-center">

                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-slate-900">
                            Gestión de proyectos
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Crea proyectos, modifica su información y controla sus fechas y estados.
                        </p>

                    </div>


                    {{-- Característica 2 --}}
                    <div class="flex flex-col items-center rounded-xl border border-slate-200 bg-white p-8 text-center">

                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m16-13a4 4 0 010 8m4 5v-2a4 4 0 00-3-3.87M14 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-slate-900">
                            Colaboración
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Añade participantes, asigna roles y organiza el trabajo en equipo.
                        </p>

                    </div>


                    {{-- Característica 3 --}}
                    <div class="flex flex-col items-center rounded-xl border border-slate-200 bg-white p-8 text-center">

                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-slate-900">
                            Seguimiento
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Consulta el estado de cada proyecto y las contribuciones de sus participantes.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- LLAMADA FINAL --}}
        @guest
            <section class="bg-slate-900 px-6 py-20">

                <div class="mx-auto max-w-3xl text-center">

                    <h2 class="text-3xl font-bold tracking-tight text-white">
                        ¿Empezamos?
                    </h2>

                    <p class="mt-4 text-base leading-7 text-slate-300">
                        Regístrate y empieza a organizar tus proyectos en un solo lugar.
                    </p>

                    <a href="{{ route('register') }}"
                       class="mt-8 inline-flex h-12 w-full max-w-52 items-center justify-center rounded-lg bg-indigo-500 px-8 text-sm font-semibold text-white transition hover:bg-indigo-400">
                        Crear una cuenta
                    </a>

                </div>

            </section>
        @endguest

    </main>


    {{-- PIE DE PÁGINA --}}
    <footer class="border-t border-slate-200 bg-white px-6 py-7">

        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 sm:flex-row">

            <span class="font-bold text-slate-800">
                ProjectHub
            </span>

            <p class="text-sm text-slate-500">
                Gestión de proyectos y colaboración.
            </p>

            <p class="text-sm text-slate-400">
                © {{ date('Y') }} ProjectHub
            </p>

        </div>

    </footer>

</body>
</html>
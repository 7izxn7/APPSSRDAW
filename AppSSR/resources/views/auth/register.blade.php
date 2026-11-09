
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registrarse - ProjectHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">

    <main class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

            {{-- Cabecera --}}
            <div class="text-center mb-8">

                <a href="/" class="text-2xl font-bold text-indigo-600">
                    ProjectHub
                </a>

                <h1 class="mt-6 text-3xl font-bold text-slate-900">
                    Crear cuenta
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Regístrate para comenzar a gestionar tus proyectos.
                </p>

            </div>

            {{-- Formulario --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nombre --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                        Nombre completo
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Introduce tu nombre"
                        class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Correo electrónico
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        placeholder="ejemplo@correo.com"
                        class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    >

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Contraseña
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Introduce una contraseña"
                        class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    >

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                        Confirmar contraseña
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Repite tu contraseña"
                        class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    >

                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botón --}}
                <button
                    type="submit"
                    class="w-full rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                >
                    Crear cuenta
                </button>

            </form>

            {{-- Login --}}
            <div class="mt-6 text-center text-sm text-slate-500">
                ¿Ya tienes una cuenta?

                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-indigo-600 hover:text-indigo-800"
                >
                    Inicia sesión
                </a>
            </div>

            {{-- Volver al inicio --}}
            <div class="mt-6 text-center">
                <a href="/" class="text-xs text-slate-400 hover:text-slate-600">
                    Volver al inicio
                </a>
            </div>

        </div>

    </main>

</body>
</html>

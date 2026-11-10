<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear proyecto | ProjectHub</title>
</head>
<body>
    <x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear nuevo proyecto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('projects.store') }}" method="POST">

                    @csrf

                    {{-- Título --}}
                    <div class="mb-4">
                        <label for="title" class="block font-medium text-gray-700">
                            Título del proyecto
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            maxlength="255"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-gray-700">
                            Descripción
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Fecha límite --}}
                    <div class="mb-4">
                        <label for="due_date" class="block font-medium text-gray-700">
                            Fecha límite
                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                        @error('due_date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="mb-4">
                        <label for="status" class="block font-medium text-gray-700">
                            Estado
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>
                                Pendiente
                            </option>

                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>
                                En progreso
                            </option>

                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                Completado
                            </option>
                        </select>

                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center gap-4 mt-6">

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Guardar proyecto
                        </button>

                        <a
                            href="{{ route('projects.index') }}"
                            class="text-gray-600 hover:underline"
                        >
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>
</body>
</html>

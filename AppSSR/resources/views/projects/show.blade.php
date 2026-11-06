<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del proyecto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                {{-- Título --}}
                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    {{ $project->title }}
                </h3>

                {{-- Descripción --}}
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">
                        Descripción
                    </h4>
                    <p class="text-gray-600 mt-1">
                        {{ $project->description ?? 'Sin descripción' }}
                    </p>
                </div>

                {{-- Fecha límite --}}
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">
                        Fecha límite
                    </h4>
                    <p class="text-gray-600 mt-1">
                        {{ $project->due_date ?? 'Sin fecha límite' }}
                    </p>
                </div>

                {{-- Estado --}}
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">
                        Estado
                    </h4>
                    <p class="text-gray-600 mt-1">
                        @switch($project->status)
                            @case('pending')
                                Pendiente
                                @break

                            @case('in_progress')
                                En progreso
                                @break

                            @case('completed')
                                Completado
                                @break

                            @default
                                {{ $project->status }}
                        @endswitch
                    </p>
                </div>

                {{-- Propietario --}}
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">
                        Creado por
                    </h4>
                    <p class="text-gray-600 mt-1">
                        {{ $project->user->name }}
                    </p>
                </div>


                {{-- Participantes --}}
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-700 mb-2">
                        Participantes
                    </h4>

                    @forelse ($project->participants as $participant)
                        <div class="border rounded p-3 mb-3">

                            <p class="font-semibold">
                                {{ $participant->name }}
                            </p>

                            @if ($project->user_id === auth()->id())

                                {{-- Formulario para modificar participante --}}
                                <form
                                    action="{{ route('projects.participants.update', [$project, $participant]) }}"
                                    method="POST"
                                    class="mt-3"
                                >
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label>Rol:</label>

                                        <input
                                            type="text"
                                            name="role"
                                            value="{{ $participant->pivot->role }}"
                                            class="border rounded p-2 w-full"
                                            required
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label>Horas trabajadas:</label>

                                        <input
                                            type="number"
                                            name="contribution_hours"
                                            value="{{ $participant->pivot->contribution_hours }}"
                                            min="0"
                                            step="0.5"
                                            class="border rounded p-2 w-full"
                                            required
                                        >
                                    </div>

                                    <button
                                        type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                    >
                                        Guardar cambios
                                    </button>
                                </form>

                            @else

                                {{-- Los participantes solo pueden consultar --}}
                                <p class="text-sm text-gray-600">
                                    Rol: {{ $participant->pivot->role }}
                                </p>

                                <p class="text-sm text-gray-600">
                                    Horas trabajadas:
                                    {{ $participant->pivot->contribution_hours }}
                                </p>

                            @endif

                        </div>
                    @empty
                        <p class="text-gray-600">
                            Este proyecto todavía no tiene participantes.
                        </p>
                    @endforelse
                </div>

                {{-- Formulario para añadir participantes (solo propietario) --}}
                @if ($project->user_id === auth()->id())
                    <div class="border-t pt-6 mt-6">
                        <h4 class="font-semibold text-gray-700 mb-4">
                            Añadir participante
                        </h4>

                        <form
                            action="{{ route('projects.participants.store', $project) }}"
                            method="POST"
                        >
                            @csrf

                            {{-- Correo electrónico --}}
                            <div class="mb-3">
                                <label for="email">
                                    Correo electrónico:
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="border rounded p-2 w-full"
                                    required
                                >

                                @error('email')
                                    <p class="text-red-500 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Rol --}}
                            <div class="mb-3">
                                <label for="role">
                                    Rol:
                                </label>

                                <input
                                    type="text"
                                    name="role"
                                    id="role"
                                    value="{{ old('role') }}"
                                    class="border rounded p-2 w-full"
                                    required
                                >

                                @error('role')
                                    <p class="text-red-500 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Horas de contribución --}}
                            <div class="mb-3">
                                <label for="contribution_hours">
                                    Horas de contribución:
                                </label>

                                <input
                                    type="number"
                                    name="contribution_hours"
                                    id="contribution_hours"
                                    value="{{ old('contribution_hours') }}"
                                    min="0"
                                    step="0.5"
                                    class="border rounded p-2 w-full"
                                    required
                                >

                                @error('contribution_hours')
                                    <p class="text-red-500 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Añadir participante
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Botones de navegación --}}
                <div class="flex items-center gap-4 mt-6">

                    {{-- Editar: solo el propietario --}}
                    @if ($project->user_id === auth()->id())
                        <a
                            href="{{ route('projects.edit', $project) }}"
                            class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                        >
                            Editar proyecto
                        </a>
                    @endif

                    <a
                        href="{{ route('projects.index') }}"
                        class="text-gray-600 hover:underline"
                    >
                        Volver al listado
                    </a>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
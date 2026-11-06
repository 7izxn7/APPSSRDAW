
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
                    <h4 class="font-semibold text-gray-700">Descripción</h4>
                    <p class="text-gray-600 mt-1">
                        {{ $project->description ?? 'Sin descripción' }}
                    </p>
                </div>

                {{-- Fecha límite --}}
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">Fecha límite</h4>
                    <p class="text-gray-600 mt-1">
                        {{ $project->due_date ?? 'Sin fecha límite' }}
                    </p>
                </div>

                {{-- Estado --}}
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">Estado</h4>
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
                    <h4 class="font-semibold text-gray-700">Creado por</h4>
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
                        <div class="border rounded p-3 mb-2">
                            <p>{{ $participant->name }}</p>
                            <p class="text-sm text-gray-600">
                                Rol: {{ $participant->pivot->role }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Horas de contribución:
                                {{ $participant->pivot->contribution_hours }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-600">
                            Este proyecto todavía no tiene participantes.
                        </p>
                    @endforelse
                </div>

                {{-- Botones --}}
                <div class="flex items-center gap-4">

                    <a href="{{ route('projects.edit', $project) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Editar proyecto
                    </a>

                    <a href="{{ route('projects.index') }}"
                       class="text-gray-600 hover:underline">
                        Volver al listado
                    </a>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>

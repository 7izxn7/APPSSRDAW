
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis proyectos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Mensaje de éxito --}}
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Botón para crear un proyecto --}}
                <div class="mb-6">
                    <a href="{{ route('projects.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Crear proyecto
                    </a>
                </div>

                {{-- Listado de proyectos --}}
                @forelse ($projects as $project)

                    <div class="border rounded-lg p-4 mb-4">

                        <h3 class="text-lg font-bold text-gray-800">
                            {{ $project->title }}
                        </h3>

                        <p class="text-gray-600 mt-2">
                            {{ $project->description }}
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Estado: {{ $project->status }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Fecha límite: {{ $project->due_date ?? 'Sin fecha' }}
                        </p>

                        {{-- Acciones --}}
                        <div class="mt-4 flex gap-3">

                            {{-- Todos pueden ver el proyecto --}}
                            <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:underline">
                                Ver
                            </a>

                            {{-- Solo el propietario puede editar o eliminar --}}
                            @if ($project->user_id === auth()->id())

                                <a href="{{ route('projects.edit', $project) }}" class="text-yellow-600 hover:underline">
                                    Editar
                                </a>

                                <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro que quieres eliminar este proyecto?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                @empty

                    <p class="text-gray-600">
                        Todavía no tienes proyectos creados.
                    </p>

                @endforelse

                {{-- Paginación --}}
                <div class="mt-6">
                    {{ $projects->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

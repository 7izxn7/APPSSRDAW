<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Listar proyectos creados por el usuario autenticado
    public function index()
    {
        $projects = Project::where(function ($query) {
        $query->where('user_id', auth()->id())
            ->orWhereHas('participants', function ($subQuery) {
                $subQuery->where('users.id', auth()->id());
            });
    })
    ->latest()
    ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('projects.create');
    }

    // Guardar un proyecto nuevo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        auth()->user()->createdProjects()->create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyecto creado correctamente.');
    }

    // Mostrar un proyecto
    public function show(Project $project)
    {
        $isOwner = $project->user_id === auth()->id();

        $isParticipant = $project->participants()
            ->where('users.id', auth()->id())
            ->exists();

        abort_unless($isOwner || $isParticipant, 403);

        $project->load('user', 'participants');

        return view('projects.show', compact('project'));
    }

    // Mostrar formulario de edición
    public function edit(Project $project)
    {
        abort_unless($project->user_id === auth()->id(), 403);

        return view('projects.edit', compact('project'));
    }

    // Actualizar un proyecto
    public function update(Request $request, Project $project)
    {
        abort_unless($project->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    // Eliminar un proyecto
    public function destroy(Project $project)
    {
        abort_unless($project->user_id === auth()->id(), 403);

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyecto eliminado correctamente.');
    }

    public function addParticipant(Request $request, Project $project)
    {
        // Comprobar que el usuario es el propietario
        abort_unless($project->user_id === auth()->id(), 403);

        // Validar los datos recibidos
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|string|max:100',
            'contribution_hours' => 'required|numeric|min:0',
        ]);

        // Buscar al usuario por su correo electrónico
        $participant = User::where('email', $validated['email'])->firstOrFail();

        // Evitar que el propietario se añada a sí mismo
        if ($participant->id === $project->user_id) {
            return back()->withErrors([
                'email' => 'El propietario ya pertenece al proyecto.'
            ])->withInput();
        }

        // Comprobar si ya es participante
        if ($project->participants()->where('users.id', $participant->id)->exists()) {
            return back()->withErrors([
                'email' => 'Este usuario ya participa en el proyecto.'
            ]);
        }

        // Añadir al participante a la tabla intermedia
        $project->participants()->attach($participant->id, [
            'role' => $validated['role'],
            'contribution_hours' => $validated['contribution_hours'],
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Participante añadido correctamente.');
    }

    public function updateParticipant(
        Request $request,
        Project $project,
        User $participant
    ) {
        // Solo el propietario puede modificar participantes
        abort_unless($project->user_id === auth()->id(), 403);

        // Comprobar que el usuario pertenece al proyecto
        abort_unless(
            $project->participants()
                ->where('users.id', $participant->id)
                ->exists(),
            404
        );

        // Validar los datos
        $validated = $request->validate([
            'role' => 'required|string|max:100',
            'contribution_hours' => 'required|numeric|min:0',
        ]);

        // Actualizar los datos en la tabla intermedia
        $project->participants()->updateExistingPivot(
            $participant->id,
            $validated
        );

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Participante actualizado correctamente.');
    }
}
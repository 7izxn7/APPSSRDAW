<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Listar proyectos creados por el usuario autenticado
    public function index()
    {
        $projects = auth()->user()
            ->createdProjects()
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
        abort_unless($project->user_id === auth()->id(), 403);

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
}
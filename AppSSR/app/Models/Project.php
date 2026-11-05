<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'status',
    ];

    // Usuario que ha creado el proyecto
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Usuarios que participan en el proyecto
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_project',
            'project_id',
            'user_id'
        )->withPivot('role', 'contribution_hours');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'start_date',
        'end_date'
    ];

    // Has Many Users
    public function project_users()
    {
        return $this->hasMany(ProjectUser::class, 'project_id', 'id');
    }

    // Has Many Tasks
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }
}

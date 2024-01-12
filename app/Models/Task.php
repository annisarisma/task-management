<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'priority',
    ];

    // Has Many Users
    public function taskusers()
    {
        return $this->hasMany(TaskUser::class, 'task_id', 'id');
    }
}

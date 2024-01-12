<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::whereHas('project_users', function ($query_projects) {
            $query_projects->where('user_id', auth()->id());
        })->get();

        return view('menu.task_index', [
            'title' => 'Project',
            'projects' => $projects,
            'tasks' => null,
            'project_selected' => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function filter($id)
    {
        $id = base64_decode($id);
        $tasks = Task::where('project_id', $id)->orderBy('priority','ASC')->get();
        $projects = Project::whereHas('project_users', function ($query_projects) {
            $query_projects->where('user_id', auth()->id());
        })->get();
        

        return view('menu.task_index', [
            'title' => 'Project',
            'projects' => $projects,
            'tasks' => $tasks,
            'project_selected' => $id,
        ]);
    }

    public function reorder(Request $request)
    {
        $id = base64_decode($request->project_id);
        $tasks = Task::where('project_id', $id)->get();

        foreach ($tasks as $task) {
            foreach ($request->order as $order) {
                if ($order['id'] == $task->id) {
                    $task->update([
                        'priority' => $order['position']
                    ]);
                }
            }
        }

        return response([
            'data' => $request->order,
            'status' => 'success'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}

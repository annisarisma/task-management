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
    public function create($id)
    {
        return view('menu.task_create', [
            'title' => 'Create Task',
            'project_id' => decrypt($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request->project_id;
        $last_task = Task::where('project_id', $request->project_id)->orderBy('priority','DESC')->first();
        Task::create([
            'name' => $request->name,
            'priority' => $last_task->priority + 1
        ]);
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
    public function edit($id)
    {
        $task = Task::findOrFail(decrypt($id));
        return view('menu.task_edit', [
            'title' => 'Edit',
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail(decrypt($id));
        $last_task = Task::where('project_id', $task->project_id)->orderBy('priority','DESC')->first();
        $task->update([
            'name' => $request->name,
        ]);

        // Query Data
        $projects = Project::whereHas('project_users', function ($query_projects) {
            $query_projects->where('user_id', auth()->id());
        })->get();
        $tasks = Task::where('project_id', $task->project_id)->orderBy('priority','ASC')->get();

        // Return
        return view('menu.task_index', [
            'title' => 'Edit',
            'projects' => $projects,
            'tasks' => $tasks,
            'project_selected' => $task->project_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail(decrypt($id));
        try {
            $task_name = $task->name;
            $task->delete();
            return back()->with('success-alert', [
                'title' => 'Delete Task Success',
                'message' => 'Task ' . $task_name . ' successfully deleted'
            ]);
        } catch (\Exception $e) {
            return back()->with('error-alert', [
                'title' => 'Delete Failed',
                'message' => 'Failed to delete task ' . $task_name
            ]);
        }
    }
}

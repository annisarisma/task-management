<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::whereHas('project_users', function ($query_projects) {
            $query_projects->where('user_id', auth()->id());
        })->get();

        return view('menu.project_index', [
            'title' => 'Project',
            'page' => 'project',
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('menu.project_create', [
            'title' => 'Create Project',
            'page' => 'project',
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate Request
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'member' => ['nullable'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        // Store Project
        $project = Project::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Store Member
        $arr_members = [];
        $arr_members[] = auth()->id();
        if ($request->newitem) {
            foreach ($request->newitem as $value) {
                foreach ($value['member'] as $member) {
                    $user = User::where('username', $member)->first();
        
                    $arr_members[] = $user->id;
                }
            }
        }

        foreach ($arr_members as $member) {
            ProjectUser::create([
                'user_id' => $member,
                'project_id' => $project->id
            ]);
        }

        // Store Task
        $tasks = $request->input('task');
        $number = 1;

        foreach ($tasks as $task) {
            Task::create([
                'name' => $task,
                'project_id' => $project->id,
                'priority' => $number,
            ]);

            $number += 1;
        }

        // Return
        return redirect('/project')->with('success-alert', [
            'message' => 'Create new project successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $project = Project::find(decrypt($id));
        $tasks = Task::where('project_id', decrypt($id))->orderBy('priority','ASC')->get();

        return view('menu.project_edit', [
            'title' => 'Update Project',
            'page' => 'project',
            'project' => $project,
            'users' => $users,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validate Request
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        $project = Project::findOrFail($request->project_id);

        // Store Project
        $project->update([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Store Member
        foreach ($request->newitem as $value) {
            $arr_members = [];
            $arr_members[] = auth()->id();

            foreach ($value['member'] as $member) {
                $user = User::where('username', $member)->first();
    
                $arr_members[] = $user->id;
            }

            foreach ($arr_members as $member) {
                ProjectUser::create([
                    'user_id' => $member,
                    'project_id' => $project->id
                ]);
            }
        }

        // Destroy Task
        Task::where('project_id', $request->project_id)->delete();

        // Store Task
        $tasks = $request->input('task');
        $number = 1;

        foreach ($tasks as $task) {
            Task::create([
                'name' => $task,
                'project_id' => $project->id,
                'priority' => $number,
            ]);
            $number += 1;
        }

        // Return
        return redirect('/project')->with('success-alert', [
            'message' => 'Update project successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail(decrypt($id));
        try {
            $project_name = $project->name;
            $project->delete();
            return back()->with('success-alert', [
                'title' => 'Delete Success',
                'message' => 'Task ' . $project_name . ' successfully deleted'
            ]);
        } catch (\Exception $e) {
            return back()->with('error-alert', [
                'message' => 'Failed to delete project ' . $project_name
            ]);
        }
    }
}

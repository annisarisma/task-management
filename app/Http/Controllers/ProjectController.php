<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
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
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('menu.project_create', [
            'title' => 'Project',
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

        // Return
        return redirect('/project')->with('success-alert', [
            'message' => 'Upload file successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}

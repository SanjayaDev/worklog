<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "projects" => Project::paginate(15)
        ];

        return view("admin.projects.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "users" => User::all(),
        ];

        return view("admin.projects.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $values = $request->validated();
        $list_user = $values["user_id"];
        unset($values["user_id"]);

        // dd($list_user);
        $project = Project::create($values);
        $project->users()->attach($list_user);

        Alert::success("Sukses!", "Sukses membuat project!");
        return \redirect("/dashboard/projects/$project->id");
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $data = [
            "project" => $project->with(["users", "assigments"])
        ];

        return view("admin.projects.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $data = [
            "project" => $project->with("users_pivot"),
        ];

        return view("admin.projects.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $values = $request->validated();
        $list_user = $values["user_id"];
        unset($values["user_id"]);

        $project->update($values);
        $project->users()->sync($list_user);

        Alert::success("Sukses!", "Sukses mengubah project!");
        return \redirect("/dashboard/projects/$project->id");
    }
}

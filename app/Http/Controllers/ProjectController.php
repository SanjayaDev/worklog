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

        return $this->view_admin("projects.index", "Projects Management", $data, TRUE);
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

        return $this->view_admin("projects.create", "Create Project", $data);
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
        $project = Project::create($values);

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
            "project" => $project->with(["owner"])->where("id", $project->id)->first(),
        ];
        // dd($data);

        return $this->view_admin("projects.show", "Detail Project", $data);
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
            "project" => $project,
            "users" => User::all()
        ];

        return $this->view_admin("projects.edit", "Edit Project", $data);
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
        $project->update($values);

        Alert::success("Sukses!", "Sukses mengubah project!");
        return \redirect("/dashboard/projects/$project->id");
    }
}

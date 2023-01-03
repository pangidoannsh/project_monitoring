<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Users;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Project::leftJoin("users", "users.id", "=", "project.leader")->select(
            "project.id",
            "project.name",
            "project.client",
            "users.id as leader_id",
            "users.name as leader_name",
            "users.email as leader_email",
            "users.photo as leader_photo",
            "project.start_date",
            "project.end_date",
            "project.progress",
        )->get();
        foreach ($data as $d) {
            $d->start_date = date('Y-m-d', strtotime($d->start_date));
            $d->end_date = date('Y-m-d', strtotime($d->end_date));
        }

        $users = Users::all();
        // dd($data);
        return view('project', [
            'section' => "Project Monitoring",
            'title' => "project",
            "datas" => $data,
            "users" => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            "project_name" => "required",
            "project_leader" => "required",
            "client" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "progress" => "required",
        ]);
        Project::create([
            "name" => $request->project_name,
            "leader" => $request->project_leader,
            "client" => $request->client,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "progress" => $request->progress
        ]);
        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Project::where("project.id", $id)
            ->leftJoin("users", "users.id", "=", "project.leader")->select(
                "project.id",
                "project.name",
                "project.client",
                "users.id as leader_id",
                "users.name as leader_name",
                "users.email as leader_email",
                "project.start_date",
                "project.end_date",
                "project.progress",
            )->get()->first();

        $data->start_date = date('Y-m-d', strtotime($data->start_date));
        $data->end_date = date('Y-m-d', strtotime($data->end_date));

        $users = Users::all();
        // dd($data);
        return view('project-edit', [
            'section' => "Edit Data Project Monitoring",
            'title' => "project",
            "data" => $data,
            "id_edit" => $id,
            "users" => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->validate([
            "project_name" => "required",
            "project_leader" => "required",
            "client" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "progress" => "required",
        ])) {
            return redirect("/project" . "/" . $id . "/edit");
        }

        Project::where("id", $id)->update([
            "name" => $request->project_name,
            "leader" => $request->project_leader,
            "client" => $request->client,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "progress" => $request->progress,
        ]);
        return redirect("/project");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::where("id", $id)->delete();
        return redirect("/project");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

// models
use App\Models\Project;
use App\Models\type;
use App\Models\Technology;

// help
use Illuminate\Support\Str;
// use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        if(array_key_exists('img', $data)){
            $imgPath = Storage::put('projects', $data['img']);
            $data['img'] = $imgPath;
        }

        $data['slug'] = Str::slug($data['title']);

        $newProject = Project::create($data);

        if(array_key_exists('technologies', $data)){
            foreach($data['technologies'] as $techId){
                $newProject->technologies()->attach($techId);
            }
        }

        return redirect()->route('admin.projects.show', $newProject->id)->with('success', 'nuovo progetto aggiunto!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if(array_key_exists('deleteImg', $data)){
            if($project->img){
                Storage::delete($project->img);
            }
        }
        else if(array_key_exists('img', $data)){
            $imgPath = Storage::put('projects', $data['img']);
            $data['img'] = $imgPath;

            if($project->img){
                Storage::delete($project->img);
            }
        }

        $data['slug'] = Str::slug($data['title']);

        $project->update($data);

        if(array_key_exists('technologies', $data)){
            $project->Technologies()->sync($data['technologies']);
        }
        else{
            $project->Technologies()->sync([]);
        }

        return redirect()->route('admin.projects.show', $project->id)->with('success', 'progetto modificato!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->img){
            Storage::delete($project->img);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'eliminazione avvenuta!');
    }
}

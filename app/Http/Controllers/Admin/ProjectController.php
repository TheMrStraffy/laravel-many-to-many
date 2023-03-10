<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
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
        $technologies = Technology::all();
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('name','like', "%$search%")->paginate(10);
        } else{

            $projects = Project::orderBy('id','desc')->paginate(10);
        }
        return view('admin.project.index',compact('projects','technologies'));
    }


    public function orderby(){
        $direction= 'desc' ? 'asc' : 'desc';

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.project.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        if(array_key_exists('cover_image', $form_data)){
            $form_data['image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image'] = Storage::put('uploads', $form_data['cover_image']);
        }

        $new_project = new Project();
        $form_data['slug'] = Project::slugGenerator($form_data['name']);

        // dd($new_project);
        $new_project->fill($form_data);
        $new_project->save();

        if(array_key_exists('technologies', $form_data)){
            $new_project->technologies()->attach($form_data['technologies']);
        };

        return redirect()->route('admin.project.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.project.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $technologies = Technology::all();
        $form_data = $request->all();
        if(array_key_exists('cover_image', $form_data)){
            if($project->cover_image){
                Storage::disk('public')->delete($project->cover_image);
            }
            $form_data['image_original_name'] =  $request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image'] = Storage::put('uploads', $form_data['cover_image']);
        }

        if($form_data['name'] != $project->title){
            $form_data['slug'] = Project::slugGenerator($form_data['name']);
        } else{
            $form_data['slug'] = $project->slug;
        }
        $project->update($form_data);

        if(array_key_exists('technologies', $form_data)){
            $project->technologies()->sync($form_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.project.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }
        $project->delete();
        return redirect()->route('admin.project.index');
    }
}

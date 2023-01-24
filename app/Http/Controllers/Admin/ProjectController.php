<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
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
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('name','like', "%$search%")->paginate(10);
        } else{

            $projects = Project::orderBy('id','desc')->paginate(10);
        }
        return view('admin.project.index',compact('projects'));
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
        $types = Type::all();
        return view('admin.project.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
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
        $types = Type::all();
        return view('admin.project.edit', compact('project','types'));
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

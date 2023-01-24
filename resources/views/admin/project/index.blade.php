@extends('layouts.app')

@section('content')
<div class="w-100 text-center mb-5">

    <a class="btn btn-primary" href="{{route('admin.project.create')}}">Create New Project</a>
</div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">
           <a href="">#</a>
        </th>
        <th scope="col">Project Name</th>
        <th scope="col">Client Name</th>
        <th scope="col">Type</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)

        <tr>
          <td>{{$project->id}}</td>
          <td>{{$project->name}}</td>
          <td>{{$project->client_name}}</td>
          <td>{{$project->type?->name}}</td>
          <td class="d-flex">
            <a href="{{route('admin.project.show', $project)}}" class="btn btn-primary me-2">
                <i class="fa-solid fa-circle-info"></i>
            </a>
            <a href="{{route('admin.project.edit', $project)}}" class="btn btn-info me-2">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>

            <form onsubmit="return confirm('Confermi l\'eliminazione di: {{$project->name}}?')"
              action="{{route('admin.project.destroy', $project)}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit" title="delete"><i class="fa-solid fa-delete-left"></i></button>
              </form>
          </td>
        </tr>
        @empty

        @endforelse
    </tbody>
  </table>
  {{$projects->links()}}


{{-- <div class="row justify-content-evenly">

        @foreach ($projects as $project)
            <div class="card mb-3" style="width: 18rem;">
            @if (!$project['image_original_name'])
            <img src="{{$project->cover_image= asset($project->cover_image)}}" class="card-img-top" alt="{{$project->name}}">
            @else
            <img src="{{asset('storage/'. $project['cover_image'])}}" class="card-img-top" alt="{{$project->name}}">
            @endif
            <div class="card-body overflow-y-scroll ">
              <h5 class="card-title">{{$project->name}}</h5>
              <p class="card-title">{{$project->client_name}}</p>
              <p class="card-text ">{{$project->summary}}</p>
              <a href="{{route('admin.project.show', $project)}}" class="btn btn-primary mb-2">More Info</a>
              <a href="{{route('admin.project.edit', $project)}}" class="btn btn-info mb-2">Edit Project</a>

              <form onsubmit="return confirm('Confermi l\'eliminazione di: {{$project->name}}?')"
                action="{{route('admin.project.destroy', $project)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" title="delete">Delete</button>
                </form>
            </div>
          </div>
        @endforeach --}}

    {{-- </div> --}}
@endsection

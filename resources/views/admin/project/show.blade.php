@extends('layouts.app')

@section('content')
<div class="container p-5">

    <div class="card mb-3 mx-auto" style="width: 18rem;">
        @if (!$project['image_original_name'])
        <img src="{{$project->cover_image= asset($project->cover_image)}}" class="card-img-top" alt="{{$project->name}}">
        @else
        <img src="{{asset('storage/'. $project['cover_image'])}}" class="card-img-top" alt="{{$project->name}}">
        @endif
        <div class="card-body overflow-y-scroll ">
          <h5 class="card-title">{{$project->name}}</h5>
          <p>
            @foreach ($project->technologies as $technology)
            <span class="badge text-bg-primary">{{$technology->name}}</span>

            @endforeach
          </p>
          <p class="card-title">{{$project->client_name}}</p>
          <p class="card-title">{{$project->type?->name}}</p>
          <p class="card-text ">{{$project->summary}}</p>
          <a href="{{route('admin.project.index')}}" class="btn btn-primary mb-2">Go To Projects</a>
          <a href="{{route('admin.project.edit', $project)}}" class="btn btn-warning me-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
          <a href="{{route('admin.types.index')}}" class="btn btn-info mb-2">Go To Group List</a>

          <form onsubmit="return confirm('Confermi l\'eliminazione di: {{$project->name}}?')"
          action="{{route('admin.project.destroy', $project)}}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" type="submit" title="delete">Delete</button>
          </form>

        </div>
      </div>
</div>
@endsection

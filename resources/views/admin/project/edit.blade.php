@extends('layouts.app')

@section('content')

    <div class="container">

        <div>
            <ul>

                @if ($errors->any())
                    @foreach ($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                @endif
            </ul>

        </div>

        <form class="mb-2" action="{{route('admin.project.update', $project)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name', $project->name)}}">
          </div>

          <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" value="{{old('client_name', $project->client_name)}}">
          </div>

          <div class="mb-3">
            <select class="form-control" name="type_id" id="type_id">
                <option value="">Choose Type</option>
                @foreach ($types as $type)
                    <option
                    @if ($type->id == old('type_id', $project->type?->id))  selected  @endif
                    value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3 row">
            @foreach ($technologies as $technology)
            <div class="col-12 col-lg-2">

                <input type="checkbox" name="technologies[]" id="technology{{$loop->iteration}}" value="{{$technology->id}}"
                @if (!$errors->all() && $project->technologies->contains($technology))
                checked
                @elseif($errors->all() && in_array($technology->id,old('technologies',[])))
                checked
                @endif
                >
                <label for="technology{{$loop->iteration}}">{{$technology->name}}</label>
            </div>
            @endforeach
          </div>

          <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea
            class="form-control" name="summary" id="summary" >{{old('summary', $project->summary)}}</textarea>
          </div>

            <div class="mb-3">
              <label for="cover_image" class="form-label">Image</label>
              <input onchange="showImage(event)" type="file" class="form-control" id="cover_image" name="cover_image">
              <img id="output-image" width="150" src="{{asset('storage/'.$project['cover_image'])}}" alt="">

            </div>


          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{route('admin.project.index')}}" class="btn btn-primary">Go To Projects</a>

        </form>

        <form onsubmit="return confirm('Confermi l\'eliminazione di: {{$project->name}}?')"
            action="{{route('admin.project.destroy', $project)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit" title="delete">Delete</button>
            </form>
    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#summary' ), {
                toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList']
            } )
            .catch( error => {
                console.error( error );
            } );

            function showImage(event){
            console.log(event.target.files.[0]);
            const tagImage = document.getElementById('output-image');
            tagImage.src = URL.createObjectURL(event.target.files.[0])
            }
    </script>
@endsection

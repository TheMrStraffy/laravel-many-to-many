@extends('layouts.app')

@section('content')

    <div class="container">

        <div>
            <ul>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                @endif
            </ul>

        </div>

        <form action="{{route('admin.project.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
          </div>

          <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" class="form-control" id="client_name" name="client_name" value="{{old('client_name')}}">
          </div>

          <div class="mb-3">
            <select class="form-control" name="type_id" id="type_id">
                <option selected value="">Choose Type</option>
                @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3 row">
            @foreach ($technologies as $technology)
            <div class="col-12 col-lg-2">

                <input type="checkbox" name="technologies[]" id="technology{{$loop->iteration}}" value="{{$technology->id}}"
                @if (in_array($technology->id, old('technologies',[])))
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
              class="form-control" name="summary" id="summary" value="{{old('summary')}}"></textarea>
            </div>

            <div class="mb-3">
              <label for="cover_image" class="form-label">Image</label>
              {{-- <input placeholder="URL" type="text" class="form-control" id="cover_image" name="cover_image" value="{{old('cover_image')}}"> --}}
              <input onchange="showImage(event)" type="file" name="cover_image" id="cover_image" class="form-control" value="{{old('cover_image')}}">
            </div>
            <div>
                <img width="150" id="output-image" src="" alt="">
            </div>

          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{route('admin.project.index')}}" class="btn btn-primary">Go To Projects</a>

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



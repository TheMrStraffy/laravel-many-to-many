@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @foreach ($types as $type)
        <h2>{{$type->name}}</h2>
        <ul>
            @foreach ($projects as $project)
                @if ($type->id == $project->type_id)
                    <li>
                        <a href="{{route('admin.project.show', $project)}}">
                            {{$project->name}}
                        </a>
                        </li>
                @endif
            @endforeach
        </ul>

    @endforeach
</div>
@endsection

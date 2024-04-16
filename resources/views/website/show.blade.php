@extends('layouts.main')
@section('content')
    <div>
        <div>{{$website->id}}. {{$website->url}}</div>
    </div>
    <div>
        <a href = "{{route('website.edit', $website->id)}}">Edit</a>
    </div>
    <div>
        <form action = "{{route('website.destroy', $website->id)}}" method = "post">
            @csrf
            @method('delete')
            <input type = "submit" value = "Delete" class = "btn btn-danger">
        </form>
    </div>
    <div>
        <a href = "{{route('website.index')}}">Back</a>
    </div>
@endsection


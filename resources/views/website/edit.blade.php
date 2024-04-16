@extends('layouts.main')
@section('content')
    <div>
        <form action = "{{route('website.update', $website->id)}}" method = 'post'>
            @csrf
            @method('patch')
            <div class="form-group mt-2 mb-3">
                <label for="url" class="form-control">URL</label>
                <input type="text" class="form-label" name = "url" id="url" placeholder="URL" value = "{{$website->url}}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection


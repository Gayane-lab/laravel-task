@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('website.store')}}" method='post'>
            @csrf
            <div class="form-group mt-2 mb-3">
                <label for="url" class="form-control">URL</label>
                <input type="text" class="form-label" name="url" id="url" placeholder="URL">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


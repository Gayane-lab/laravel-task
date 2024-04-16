@extends('layouts.main')
@section('content')
    <div>
        <div>
            <a href="{{route('website.create')}}" class="btn btn-primary mb-3">Create website</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">URL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($websites as $website)
                <tr>
                    <th scope="row">{{$website->id}}</th>
                    <td><a href="{{route('website.show', $website->id)}}">{{$website->url}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{$websites->links()}}
        </div>
    </div>
@endsection


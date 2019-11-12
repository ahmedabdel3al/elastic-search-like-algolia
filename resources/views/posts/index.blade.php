@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-title">
                <search />
            </div>
            <div class="card">

                <div class="card-header">Posts</div>
                <div class="card-body">

                    @foreach($posts as $post)
                    <div class="card-header"> title :{{$post->title}}</div>
                    <div class="card-body"> body :{{$post->body}}</div>
                    <hr>
                    @endforeach
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
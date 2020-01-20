@extends('layouts.app')

@section('content')
<script src="/js/delete.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$post->name}}</div>

                <div class="card-body">
                    @if (isset($post->post_image))
                        <img src="{{$post->post_image}}">
                        <br><br>
                    @endif
                    {{$post->text}}<br><br>
                    
                    Author: {{$user}}<br>
                    Created at: {{$post->created_at}}<br>
                    @if (isset($post->address))
                        Address: {{$post->address}}<br>
                    @endif

                    @can('update', $post)
                        <br><br>
                        <a href="/post/edit/{{$post->id}}"><input type="submit" value="Edit"></a>
                        <br>
                        <form method="delete" id="ajax_delete">
                            @csrf
                            <input type="submit" id="btn-delete" value="Delete">
                        </form>
                        <div id="result"></div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

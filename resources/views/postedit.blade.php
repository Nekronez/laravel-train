@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="/js/form.js"></script>

<div class="container" name="container-edit">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit post</div>

                <div class="card-body">
                    <form method="post" id="ajax_form" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Name:</label>
                        <input id="name" type="text" name="name" value="{{$post->name}}"><br>

                        <label for="text">Text:</label>
                        <textarea id="text" type="text" name="text">{{$post->text}}</textarea><br>

                        <label for="post_image" >Post Image:</label>
                        <input id="post_image" type="file" name="post_image" accept="image/jpeg">
                        <br>

                        <input type="submit" id="btn" value="Save">
                    </form>
                    <br>
                    <div id="result_form"></div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

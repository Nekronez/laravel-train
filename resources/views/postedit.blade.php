@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="/js/form.js"></script>
<iframe width="0" height="0" border="0" name="dummyframe" id="dummyframe"></iframe>
<div class="container" name="container-edit">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit post</div>

                <div class="card-body">
                    <form method="post" id="ajax_form" target="dummyframe">
                        @csrf
                        <label for="name">Name:</label>
                        <input id="name" type="text" name="name" value="{{$post->name}}"><br>

                        <label for="text">Text:</label>
                        <textarea id="text" type="text" name="text">{{$post->text}}</textarea><br>

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

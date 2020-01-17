@extends('layouts.app')

@section('content')
<script src="/js/form.js"></script>

<div class="container" name="container-create">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create post</div>

                <div class="card-body">
                    <form method="post" id="ajax_form" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Name:</label>
                        <input id="name" type="text" name="name"><br>

                        <label for="text">Text:</label>
                        <textarea id="text" type="text" name="text"></textarea><br>

                        <label for="post_image" >Post Image:</label>
                        <input id="post_image" type="file" name="post_image" accept="image/jpeg">
                        <br><br>
                        
                        <label for="lat">Latitude:</label>
                        <input id="lat" type="text" name="lat"><br>
                        <label for="lon">Longitude:</label>
                        <input id="lon" type="text" name="lon"><br><br>

                        <label>Type map:</label><br>
                        <input name="map" type="radio" value="google" checked>Google<br>
                        <input name="map" type="radio" value="yandex">Yandex<br><br>

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

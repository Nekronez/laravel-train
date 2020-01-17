<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exception;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->name = $request->name;
        $post->text = $request->text;
        $post->user_id = Auth::user()->id;

        if ($request->hasFile('post_image')) {
            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/uploads/images/';
            Image::make(Input::file('post_image'))
                ->resize(600, null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/images/'. $name. '.jpg'));
            $post->post_image = $folder. $name. '.jpg';
        }

        $post->save();

        return redirect()->action(
            'PostController@show', ['id' => $post->id]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = User::findOrFail($post->user_id);
        
        return view('post',['post' => $post,'user'=>$user->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (!Auth::user()->can('update', $post)) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('postedit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        
        $post->name = $request->name;
        $post->text = $request->text;

        if ($request->hasFile('post_image')) {
            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/uploads/images/';
            Image::make(Input::file('post_image'))
                ->resize(600, null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/images/'. $name. '.jpg'));
            $post->post_image = $folder. $name. '.jpg';
        }
        $post->save();

        return redirect()->action(
            'PostController@show', ['id' => $post->id]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([], 200); 
    }
}

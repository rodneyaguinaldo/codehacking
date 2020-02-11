<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;
use App\Category;
use App\Post;
use App\User;
use App\Http\Requests;
use App\Http\Requests\PostsCreateRequest; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(); 
        return view('admin.posts.index', compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.create', compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    { 
        $user = Auth::user();
        $input = $request->all() ;

        if($file = $request->file('photo_id') ) {
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);
            
            $photo = Photo::create([ 'file' => $name ]);
            $input['photo_id'] = $photo->id;
        }   

        $user->posts()->create($input);

        Session::flash('created_post','A post has been created!');

        return redirect('/admin/posts'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.posts.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
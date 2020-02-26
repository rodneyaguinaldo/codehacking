@extends('layouts.admin')

@section('content')

    @if(Session::has('created_post') )

    <p class="bg-success">{{ session('created_post') }} </p>
  
    @elseif(Session::has('deleted_post') )

    <p class="bg-success">{{ session('deleted_post') }} </p>

    @endif


    <h1>Posts</h1>
 

    <table class="table table-condensed">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>User</th>
            <th>Category</th> 
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody> 
            @if($posts)
                @foreach($posts as $post)

                    <tr>
                        <td>{{ $post->id }}</td> 
                        <td><img height="50" src="{{ $post->photo ? $post->photo->file : 'https:placehold.it/400x400' }}" alt=""></td> 
                        <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->user ? $post->user->name : 'N/A'  }}</a></td> 
                        <td>{{ $post->category ? $post->category->name : 'Category Does Not Exist' }}</td>  
                        <td>{{ $post->title }}</td>  
                        <td>{{ str_limit($post->body, 20) }}</td>  
                        <td>{{ $post->created_at->diffForHumans() }}</td> 
                        <td>{{ $post->updated_at ? $post->updated_at->diffForHumans() : 'N/A' }}</td> 
                        <td><a href="{{ route('home.post', $post->id) }}">View Post</a></td>
                        <td><a href="{{ route('admin.comments.show', $post->id) }}">View Comments</a></td>
                    </tr> 

                @endforeach
            @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $posts->render() }}
        </div>
    </div>

@stop
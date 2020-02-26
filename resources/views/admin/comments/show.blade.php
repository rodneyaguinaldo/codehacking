@extends('layouts.admin')


@section('content')
    
    @if($comments )
        <h1>Comments</h1>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>AUTHOR</th>
                    <th>EMAIL</th>
                    <th>BODY</th>
                    <th>POST</th>
                    <th>COMMENTS</th>
                    <th>UPDATED</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($comments as $comment) 
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ ucwords($comment->author) }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ str_limit($comment->body,10, ) }}</td>
                    <td><a href="{{ route('home.post', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                    <td><a href="{{ route('admin.comments.replies.show', $comment->id) }}">View Replies</a></td>
                    <td>{{ $comment->updated_at->diffForHumans() }}</td>
                    
                    <td>

                        @if($comment->is_active)

                            {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id] ]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">

                                {!! Form::submit('Un-approve', ['class'=>'btn-xs btn btn-info']) !!}

                            </div>

                            {!! Form::close() !!}

                        @else 

                            {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id] ]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">

                                {!! Form::submit('Approve', ['class'=>'btn-xs btn btn-success']) !!}

                            </div>

                            {!! Form::close() !!}

                        @endif

                        {!! Form::open(['method'=>'DELETE', 'action'=> ['PostCommentsController@destroy', $comment->id] ]) !!}
 

                        <div class="form-group">

                            {!! Form::submit('Delete', ['class'=>'btn-xs btn btn-danger']) !!}

                        </div>

                        {!! Form::close() !!}



                    </td>


                </tr>
                @endforeach
            </tbody>

        </table>
    @else 
        <h1><center>NO COMMENTS</center></h1>    
    @endif

@stop
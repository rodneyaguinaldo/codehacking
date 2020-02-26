@extends('layouts.admin')


@section('content')
    
    @if(count($replies) )
        <h1>Replies</h1>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>AUTHOR</th>
                    <th>EMAIL</th>
                    <th>BODY</th>
                    <th>POST</th>
                    <th>UPDATED</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>


                @if($replies)

                    @foreach ($replies as $reply) 
                    <tr>
                        <td>{{ $reply->id }}</td>
                        <td>{{ ucwords($reply->author) }}</td>
                        <td>{{ $reply->email }}</td>
                        <td>{{ str_limit($reply->body,10, ) }}</td>
                        <td><a href="{{ route('home.post', $reply->comment->post->id) }}">View Post</a></td>
                        <td>{{ $reply->updated_at->diffForHumans() }}</td>
                        
                        <td>

                            @if($reply->is_active)

                                {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentsRepliesController@update', $reply->id] ]) !!}

                                <input type="hidden" name="is_active" value="0">

                                <div class="form-group">

                                    {!! Form::submit('Un-approve', ['class'=>'btn-xs btn btn-info']) !!}

                                </div>

                                {!! Form::close() !!}

                            @else 

                                {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentsRepliesController@update', $reply->id] ]) !!}

                                <input type="hidden" name="is_active" value="1">

                                <div class="form-group">

                                    {!! Form::submit('Approve', ['class'=>'btn-xs btn btn-success']) !!}

                                </div>

                                {!! Form::close() !!}

                            @endif

                            {!! Form::open(['method'=>'DELETE', 'action'=> ['CommentsRepliesController@destroy', $reply->id] ]) !!}
    

                            <div class="form-group">

                                {!! Form::submit('Delete', ['class'=>'btn-xs btn btn-danger']) !!}

                            </div>

                            {!! Form::close() !!}



                        </td>


                    </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    @else 
        <h1><center>No replies</center></h1>    
    @endif

@stop
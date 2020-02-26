@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{ ucfirst($post->user->name) }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }} </p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" height="20" src="{{ $post->photo ? $post->photo->file : 'https:placehold.it/400x400'}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{ $post->body }}</p>

    <hr>

    @if(Session::has('comment_message'))

            {{ session('comment_message' ) }}

    @endif
    <!-- Blog Comments -->


    @if(Auth::check() )

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store' ] ) !!}

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="form-group"> 
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3] ) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit Content', ['class'=>'btn btn-primary']) !!}

                </div>

                {!! Form::close() !!}
        </div>
 
    @endif

    <hr>

    <!-- Posted Comments --> 

    @if($comments)

        @foreach ($comments as $comment)
            
            @if($comment->is_active == 1)

                <div class="media">
                    <a class="pull-left" href="#">
                    <img class="media-object" width="64" height="64" src="{{ $comment->photo ? Auth::user()->gravatar : 'http://placehold.it/64x64' }}" alt="">
                    {{-- <img class="media-object" width="64" height="64" src="{{ $comment->photo ? $comment->photo : 'http://placehold.it/64x64' }}" alt=""> --}}
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $comment->author }} 
                            <small>{{ $comment->created_at->format('F d, Y h:m A') }}</small>
                        </h4>
                        {{ $comment->body }}

                        @if($comment->replies) 

                             @foreach ($comment->replies as $reply)
                                
                                @if($reply->is_active)

                                    <div class="media nested-comment">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" width="64" height="64" src="{{ $reply->photo ? $reply->photo : 'http://placehold.it/64x64' }}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $reply->author }} 
                                                <small>{{ $reply->created_at->format('F d, Y h:m A') }}</small>
                                            </h4>
                                            {{ $reply->body }}
                                            
                                        </div>
                                    </div>

                                    <div class="commment-reply-container"> 
    
                                        <button class="toggle-reply btn-xs btn btn-primary pull-right">Reply</button>

                                        <div class="comment-reply">
    
                                            {!! Form::open(['method'=>'POST', 'action'=>'CommentsRepliesController@createReply']) !!}
                                            
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    
                                            {!! Form::textarea('body', null, ['class'=>'form-control d', 'rows'=>1 ] ) !!}
                    
                                            {!! Form::submit('Submit', ['class'=>'btn-xs btn btn-primary d' ]) !!}
                    
                                            {!! Form::close() !!}

                                        </div>
                                        
                                    </div>

                                @endif
   
                             @endforeach
 
                        
                        @endif
   
                    </div>
                </div>
 
            @endif

        @endforeach
  

    @endif
  
@stop

@section('scripts')

    <script>

        $(".commment-reply-container .toggle-reply").click(function(){
        // $(".commment-reply-container .toggle-reply").click(function(){
            
            $(this).next().slideToggle('slow')
            // $(this).next(".comment-reply").css("display","block")


        });

    </script>

@stop
 
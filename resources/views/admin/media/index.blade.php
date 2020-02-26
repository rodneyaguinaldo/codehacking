@extends('layouts.admin')


@section('content')
    
    <h1>Media</h1>

    @if($photos)

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($photos as $photo)
                        <tr>
                            <td>{{ $photo->id }}</td>
                            <td><img height="50" src="{{ $photo->file ? $photo->file : 'https:placehold.it/400x400' }}"></td>
                            <td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : 'N/A' }}</td>
                            <td>{{ $photo->updated_at ? $photo->updated_at->diffForHumans() : 'N/A' }}</td>
                            <td>
                                {!! Form::open([
                                    'method'=>'DELETE', 
                                    'action' => ['AdminMediasController@destroy', $photo->id] 
                                ]) !!}
                                 
                                    {!! Form::submit('Delete', ['class'=>'btn-xs btn btn-danger']) !!}
                               
                                

                                {!! Form::close() !!}

                            </td>
                        </tr>
                    
                @endforeach
            </tbody>

        </table>

    @endif

@stop
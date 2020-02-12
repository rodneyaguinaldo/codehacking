@extends('layouts.admin')

@section('content')
 
    <h1>Edit Categories</h1>
     
    {!! Form::model($categories, ['method'=>'PATCH', 'action'=>[ 'AdminCategoriesController@update', $categories->id ], 'files' => true ], ) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group"> 
        {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-6']) !!}
    </div>

    {!! Form::close() !!}

    {!! Form::open([ 'method'=>'DELETE', 'action'=>[ 'AdminCategoriesController@destroy', $categories->id]   ]) !!}
    <div class="form-group"> 
        {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-6']) !!}
    </div>

{!! Form::close() !!}


@stop
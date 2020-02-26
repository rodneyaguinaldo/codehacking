@extends('layouts.admin')

@section('styles')
    
        <style rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css"></style>

@stop

@section('content')
    
    <h1>Upload Media</h1>

    {!! Form::open(['method'=>'POST', 'action' => 'AdminMediasController@store', 'class'=>'dropzone']) !!}

    {!! csrf_field() !!}
 

    {!! Form::close() !!}
 

@stop

@section('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.js"></script>
 
@stop
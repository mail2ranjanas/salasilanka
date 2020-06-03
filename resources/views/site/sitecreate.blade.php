@extends('layouts.app')

@section('content')
    <h1>Create Site Form</h1>
    {!! Form::open(['action' => 'SiteController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('quantity', 'Site Name')}}
            {{Form::text('site', '', ['class' => 'form-control', 'placeholder' => 'Site Name'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('siteDesc', 'Site Description')}}
            {{Form::textarea('siteDesc', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Site Description'])}}
        </div>

    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
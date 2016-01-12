@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($settings, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.settings.update', $settings->id))) !!}

<div class="form-group">
    {!! Form::label('title', 'Title*', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('title', old('title',$settings->title), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('logo', 'Logo*', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('logo') !!}
        {!! Form::hidden('logo_w', 1024) !!}
        {!! Form::hidden('logo_h', 1024) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('copyright', 'Copyright', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('copyright', old('copyright',$settings->copyright), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('show_copyright', 'Show copyright', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('show_copyright','') !!}
        {!! Form::checkbox('show_copyright', 1, true) !!}
        <p class="help-block">Show copyright in footer</p>
    </div>
</div><div class="form-group">
    {!! Form::label('email', 'Email', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('email', old('email',$settings->email), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('linkedin', 'linkedin', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('linkedin', old('linkedin',$settings->linkedin), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('googleplus', 'googleplus', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('googleplus', old('googleplus',$settings->googleplus), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('twitter', 'twitter', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('twitter', old('twitter',$settings->twitter), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('contact_us_email', 'Contact us email', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('contact_us_email', old('contact_us_email',$settings->contact_us_email), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('contact_us_title', 'Contact us Title', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('contact_us_title', old('contact_us_title',$settings->contact_us_title), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    {!! Form::label('contact_us_text', 'Contact us Text', array('class'=>'col-md-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('contact_us_text', old('contact_us_text',$settings->contact_us_text), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.settings.index', 'Cancel', $settings->id, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
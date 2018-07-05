@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.seasons.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.seasons.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('season', trans('global.seasons.fields.season').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('season', old('season'), ['class' => 'form-control', 'placeholder' => 'ex. \"2017/2018\"', 'required' => '']) !!}
                    <p class="help-block">ex. "2017/2018"</p>
                    @if($errors->has('season'))
                        <p class="help-block">
                            {{ $errors->first('season') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


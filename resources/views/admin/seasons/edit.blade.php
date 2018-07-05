@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.seasons.title')</h3>
    
    {!! Form::model($season, ['method' => 'PUT', 'route' => ['admin.seasons.update', $season->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


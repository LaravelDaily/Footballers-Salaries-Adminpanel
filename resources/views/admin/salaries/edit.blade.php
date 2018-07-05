@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.salaries.title')</h3>
    
    {!! Form::model($salary, ['method' => 'PUT', 'route' => ['admin.salaries.update', $salary->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('player_id', trans('global.salaries.fields.player').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('player_id', $players, old('player_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('player_id'))
                        <p class="help-block">
                            {{ $errors->first('player_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('team_id', trans('global.salaries.fields.team').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('team_id', $teams, old('team_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('team_id'))
                        <p class="help-block">
                            {{ $errors->first('team_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('season_id', trans('global.salaries.fields.season').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('season_id', $seasons, old('season_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('season_id'))
                        <p class="help-block">
                            {{ $errors->first('season_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('salary', trans('global.salaries.fields.salary').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('salary', old('salary'), ['class' => 'form-control', 'placeholder' => 'in USD', 'required' => '']) !!}
                    <p class="help-block">in USD</p>
                    @if($errors->has('salary'))
                        <p class="help-block">
                            {{ $errors->first('salary') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


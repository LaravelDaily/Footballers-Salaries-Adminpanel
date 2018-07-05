@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.seasons.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.seasons.fields.season')</th>
                            <td field-key='season'>{{ $season->season }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#salaries" aria-controls="salaries" role="tab" data-toggle="tab">Salaries</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="salaries">
<table class="table table-bordered table-striped {{ count($salaries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.salaries.fields.player')</th>
                        <th>@lang('global.salaries.fields.team')</th>
                        <th>@lang('global.salaries.fields.season')</th>
                        <th>@lang('global.salaries.fields.salary')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($salaries) > 0)
            @foreach ($salaries as $salary)
                <tr data-entry-id="{{ $salary->id }}">
                    <td field-key='player'>{{ $salary->player->name or '' }}</td>
                                <td field-key='team'>{{ $salary->team->name or '' }}</td>
                                <td field-key='season'>{{ $salary->season->season or '' }}</td>
                                <td field-key='salary'>{{ $salary->salary }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.salaries.restore', $salary->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.salaries.perma_del', $salary->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('salary_view')
                                    <a href="{{ route('admin.salaries.show',[$salary->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('salary_edit')
                                    <a href="{{ route('admin.salaries.edit',[$salary->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('salary_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.salaries.destroy', $salary->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.seasons.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

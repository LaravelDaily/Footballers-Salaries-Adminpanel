@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.players.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.players.fields.name')</th>
                            <td field-key='name'>{{ $player->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.players.fields.birth-date')</th>
                            <td field-key='birth_date'>{{ $player->birth_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.players.fields.nationality')</th>
                            <td field-key='nationality'>{{ $player->nationality->title or '' }}</td>
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
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>@lang('global.salaries.fields.team')</th>
            <th>@lang('global.salaries.fields.season')</th>
            <th>@lang('global.salaries.fields.salary')</th>
        </tr>
    </thead>

    <tbody>
        @if (count($salaries) > 0)
            @foreach ($salaries as $salary)
                <tr data-entry-id="{{ $salary->id }}">
                    <td field-key='team'>{{ $salary->team->name or '' }}</td>
                    <td field-key='season'>{{ $salary->season->season or '' }}</td>
                    <td field-key='salary'>{{ $salary->salary }}</td>
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

            <a href="{{ route('admin.players.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

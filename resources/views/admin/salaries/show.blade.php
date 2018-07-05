@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.salaries.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.salaries.fields.player')</th>
                            <td field-key='player'>{{ $salary->player->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.salaries.fields.team')</th>
                            <td field-key='team'>{{ $salary->team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.salaries.fields.season')</th>
                            <td field-key='season'>{{ $salary->season->season or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.salaries.fields.salary')</th>
                            <td field-key='salary'>{{ $salary->salary }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.salaries.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

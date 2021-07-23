@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.topics.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($topics) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('quickadmin.topics.fields.title')</th>
                    <th>Start Date</th>
                    <th>Timer (seconds)</th>
                    <th>Timer Level</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @if (count($topics) > 0)
                    @foreach ($topics as $topic)
                        <tr data-entry-id="{{ $topic->id }}">
                            <td></td>
                            <td>{{ $topic->title }}</td>
                            <td>{{ $topic->start_date }}</td>
                            <td>{{ $topic->timer }}</td>
                            <td>{{ $topic->timer_level }}</td>
                            <td>
                                <a href="{{ route('tests.start',[$topic->id]) }}"
                                   class="btn btn-md btn-primary">Take Quiz</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
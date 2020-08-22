@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
            <small>{!! $crud->getSubheading() ?? 'Import Results for '.$crud->entity_name !!}.</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a>
            </li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">Import Result</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="container m-l-5 m-r-5" style="width: 100%;">
        <div class="row">
            @if (empty($errors))
                <h1 style="text-align: center; margin: 150px;">Imported successfully</h1>
            @else
                <div style="overflow: auto;">
                    <table class="box table table-striped table-hover display responsive nowrap m-t-0 dataTable">
                        <tr>
                            <td>Row Number</td>
                            <td>Error Messages</td>
                        </tr>
                        @foreach ($errors as $idx_1 => $error)
                            <tr>
                                <td>{{ $error['row_number'] }}</td>
                                <td>
                                    <ul style="padding-left: 15px;">
                                        @foreach($error['errors'] as $idx_2 => $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif

            <div style="float: left;">
                <a href="{{ route('admin.'.strtolower(str_replace(' ', '', $crud->entity_name)).'.import') }}" class="btn btn-primary">Import More</a>
            </div>
            <div style="float: right;">
                <a href="{{ url($crud->route) }}" class="btn btn-primary">Finished</a>
            </div>

        </div>
    </div>

@endsection

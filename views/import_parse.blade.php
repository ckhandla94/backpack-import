@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
            <small>{!! $crud->getSubheading() ?? 'Import Mapping for '.$crud->entity_name !!}.</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a>
            </li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">Import Mapping</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="container m-l-5 m-r-5" style="width: 100%;">
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ url($crud->route.'/import-process') }}">
                {{ csrf_field() }}
                <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}"/>

                <div style="overflow: auto; width: 100%;">
                    <table class="box table table-striped table-hover responsive nowrap m-t-0" style="width: 100%">
                        @foreach ($csv_data as $row)
                            <tr>
                                @foreach ($row as $key => $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            @foreach ($csv_data[0] as $key => $value)
                                <td>
                                    <select name="fields[{{ $key }}]" class="form-control select2">
                                        <option value="">Select mapping</option>
                                        @foreach ($import_fields as $key => $import_field)
                                            <option
                                                    @if ($import_field['name']===$value || $import_field['label']===$value)
                                                    selected
                                                    @endif
                                                    value="{{ $import_field['name'] }}">{{ $import_field['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>

                <div style="float: left;">
                    <a href="{{ route('admin.'.strtolower(str_replace(' ', '', $crud->entity_name)).'.import') }}" class="btn btn-primary">Back</a>
                </div>
                <div style="float: right;">
                    <button type="submit" class="btn btn-primary">Import Data</button>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('after_styles')
    <!-- DATA TABLES -->
    <link href="{{ asset('vendor/adminlte/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
          rel="stylesheet" type="text/css"/>

    <style>
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 35px;
            user-select: none;
            -webkit-user-select: none;
        }

        .select2-container {
            width: auto !important;
        }
    </style>

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_fields_styles')
@endsection

@section('after_scripts')

    <script src="{{ asset('vendor/adminlte/bower_components/select2/dist/js/select2.min.js') }}"></script>

    <style type="text/css">
        .select2-selection__clear::after {
            content: ' Clear';
        }
    </style>

    <script>
        $(document).ready(function () {
            $('select.select2').select2();
        });
    </script>

    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    @stack('crud_fields_scripts')
@endsection

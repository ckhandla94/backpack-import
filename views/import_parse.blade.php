@extends(backpack_view('blank'))


@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">Import Mapping for {!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection

@section('content')

    <div class="row mt-4">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ url($crud->route.'/import-process') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}"/>
                    <div class="mb-3"> 
                        <a href="{{ url($crud->route.'/import') }}" class="btn btn-default">Back</a>     
                        <button type="submit" class="btn ml-2 btn-primary">Import Data</button> 
                    </div>

                    <div class="responsive-table">
                        <table class="table table-striped table-hover responsive nowrap w-100">
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

                            @foreach ($csv_data as $row)
                                <tr>
                                    @foreach ($row as $key => $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                           
                        </table>
                    </div>

                    <div> 
                        <a href="{{ url($crud->route.'/import') }}" class="btn btn-default">Back</a>     
                        <button type="submit" class="btn ml-2 btn-primary">Import Data</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('after_styles')
    <style type="text/css">
        table tr th,
        table tr td {
            max-width: 400px;
            width: auto;
        }
    </style>
@endsection


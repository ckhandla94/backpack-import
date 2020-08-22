@extends(backpack_view('blank'))


@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">Import Results for {!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection

@section('content')

    <div class="row mt-4">
        <div class="card col-md-4">
            <div class="card-body">
                @if (empty($errors))
                <div class="alert alert-success text-center">
                    Imported successfully
                </div>
                @else
                    <div>
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

                <div class="mt-3 text-center">
                    <a href="{{ url($crud->route.'/import') }}" class="btn btn-primary">Import More</a>

                    <a href="{{ url($crud->route) }}" class="btn ml-2 btn-success">Finished</a>
                </div>
            </div>
        </div>
    </div>

@endsection

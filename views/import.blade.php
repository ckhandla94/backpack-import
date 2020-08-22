@extends(backpack_view('blank'))

@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">Import {!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">Import {!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection


@section('content')
    <div class="row mt-4">
        <div class="card col-md-6">
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ url($crud->route.'/import-parse') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                        <label for="csv_file" class="control-label">CSV file to import: </label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="csv_file" required id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>

                        @if ($errors->has('csv_file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('csv_file') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="csv_file" class="control-label">Instructions:</label>
                        <ol class="pl-3">
                            <li>Upload a CSV in the following format: <a href="{{ url($crud->route.'/import-format') }}">Download</a></li>
                            @foreach($instructions as $idx => $instruction)
                                <li>{{$instruction}}</li>
                            @endforeach
                        </ol>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection


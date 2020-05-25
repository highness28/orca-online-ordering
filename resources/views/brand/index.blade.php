@extends("layouts.app")

@section("css")
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section("breadCrumbTitle")
    Brand
@endsection

@section("breadCrumbSubTitle")
    List
@endsection

@section("breadCrumbList")
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@endsection

@section("content")
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          {!! Session::get('message') !!}

          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Brand List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/brand/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add New Brand</a>
              <table id="brand_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>BRAND NAME</th>
                    <th width="100">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->brand_name }}</td>
                        <td>
                            <a href="/brand/edit?id={{ $brand->id }}"><i class="ion ion-compose"></i> Edit</a>
                        </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>         
          </div>
        </div>
    </section>
@endsection

@section('js')
  <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      $('#brand_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      });
    });
  </script>
@endsection
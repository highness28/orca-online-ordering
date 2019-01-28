@extends("layouts.app")

@section("css")
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section("breadCrumbTitle")
    Inventory
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
              <h4 class="box-title">Product List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/inventory/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add Inventory</a>
              <table id="inventory_datable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>PRODUCT NAME</th>
                    <th>QUANTITY</th>
                    <th>DATE</th>
                    @if(Auth::user()->role == 1)
                      <th width="100">ACTION</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->id }}</td>
                        <td>{{ $inventory->product->product_name }}</td>
                        <td>{{ number_format($inventory->quantity) }}</td>
                        <td>{{ date('F d, Y', strtotime($inventory->created_at)) }}</td>
                        @if(Auth::user()->role == 1)
                          <td>
                              <a href="/inventory/edit?id={{ $inventory->id }}"><i class="ion ion-compose"></i> Edit</a>
                          </td>
                        @endif
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
      $('#inventory_datable').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : true
      });
    });
  </script>
@endsection
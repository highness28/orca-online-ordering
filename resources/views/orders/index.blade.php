@extends("layouts.app")

@section("css")
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section("breadCrumbTitle")
    Order
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
              <h4 class="box-title">Invoice List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- <a href="/brand/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add New Brand</a> -->
              <table id="brand_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="100">INVOICE #</th>
                    <th>CUSTOMER</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>TOTAL</th>
                    <th>DATE ORDERED</th>
                    <th>DELIVERY DATE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($invoice as $order)
                    <tr>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->customer->first_name . ' ' . $order->customer->last_name }}</td>
                      <td>{{ $order->customer->account->email }}</td>
                      <td>{{ $order->customer->phone_number }}</td>
                      <td>{{ 'Php ' . number_format($order->total, 2) }}</td>
                      <td>{{ date('F d, Y', strtotime($order->created_at)) }}</td>
                      <td>{{ $order->delivery_date ? date('F d, Y', strtotime($order->delivery_date)) : 'Not set' }}</td>
                      <td>{{ $order->status == 0 ? 'Inventory Check' : ($order->status == 1 ? 'Sales Check' : ($order->status == 2 ? 'For Delivery' : 'Delivered')) }}</td>
                      <td>
                        <a href="/orders/edit?id={{ $order->id }}"><i class="ion ion-compose"></i> Edit</a>
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
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : true
      });
    });
  </script>
@endsection
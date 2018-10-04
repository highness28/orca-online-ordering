@extends("layouts.app")

@section("css")
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section("breadCrumbTitle")
    Product
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
              <a href="/product/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add New Product</a>
              <table id="product_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Product Name</th>
                    <th>Item Code</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Critical Value</th>
                    <th width="100">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->item_code }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->brand->brand_name }}</td>
                        <td>{{ $product->product_prie }}</td>
                        <td>{{ $product->critical_value }}</td>
                        <td>
                            <a href="/product/edit?id={{ $product->id }}"><i class="ion ion-compose"></i> Edit</a>
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
      $('#product_table').DataTable({
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
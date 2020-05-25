@extends("layouts.app")

@section("css")
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <style>
    #add-product {
      color: white;
      text-decoration: none;
      padding: 7px;
    }
  </style>
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
              <form method="GET" action="/product/print">
                @foreach($products as $product)
                  <?php
                    $productObject = (object) [
                      'product_name'      => $product->product_name,
                      'item_code'         => $product->item_code,
                      'category'          => $product->category->category_name,
                      'brand'             => $product->brand->brand_name,
                      'price'             => $product->product_price,
                      'critical_value'    => $product->critical_value,
                      'quantity_left'     => getStock($product->id)
                    ];
                  ?>
                  <input type="hidden" name='products[]' value='{{ json_encode($productObject) }}'>
                @endforeach
                <a href="/product/add" class="btn-sm btn-success" id='add-product'><i class="fa fa-plus"></i>&nbsp; Add New Product</a>
                <button class="btn-sm btn-info"><i class="fa fa-print"></i>&nbsp; Print</button>
              </form>
              <form method="GET" action="/product/reorder/print">
                <button class="btn-sm btn-danger"><i class="fa fa-print"></i>&nbsp; Reorder Print</button>
              </form>
              <table id="product_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>PRODUCT NAME</th>
                    <th>ITEM CODE</th>
                    <th>CATEGORY</th>
                    <th>BRAND</th>
                    <th>PRICE</th>
                    <th>CRITICAL VALUE</th>
                    <th>QUANTITY LEFT</th>
                    <th width="100">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr {!! $product->critical_value >= getStock($product->id) ? 'class="danger"':'' !!}>
                        <td>
                          <a href="/product/edit?id={{ $product->id }}">
                            @if($product->image)
                              <img src="data:image/png;base64,{{ base64_encode($product->image) }}" alt="Product" style="width: 100%">
                            @else
                              <img src="{{ url('/img/products/default.png') }}" alt="Product" style="width: 100%">
                            @endif
                          </a>
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->item_code }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->brand->brand_name }}</td>
                        <td>{{ 'Php ' . number_format($product->product_price, 2) }}</td>
                        <td>{{ $product->critical_value }}</td>
                        <td>{{ getStock($product->id) }}</td>
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
@extends("layouts.app")

@section("css")
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section("breadCrumbTitle")
    Featured
@endsection

@section("breadCrumbSubTitle")
    Category
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
              <h4 class="box-title">Featured Category List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/featured-category/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add Category</a>
              <table id="featured-category" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>CATEGORY NAME</th>
                    <th>TITLE</th>
                    <th>STATS</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($featuredCategory as $category)
                    <tr>
                        <td>
                            <a href="/featured-category/edit?id={{ $category->id }}">
                                @if($category->image)
                                    <img src="data:image/png;base64,{{ base64_encode($category->image) }}" alt="category" style="width: 100%">
                                @else
                                    <img src="{{ url('/img/products/default.png') }}" alt="category" style="width: 100%">
                                @endif
                            </a>
                        </td>
                        <td>{{ $category->category->category_name }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->status == 0 ? 'Not Displayed' : 'Displayed' }}</td>
                        <td>
                            <a href="/featured-category/edit?id={{ $category->id }}"><i class="ion ion-compose"></i> Edit</a>
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
      $('#featured-category').DataTable({
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
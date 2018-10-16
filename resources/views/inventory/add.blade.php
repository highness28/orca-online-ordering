@extends('layouts.app')

@section("breadCrumbTitle")
    Inventory
@endsection

@section("breadCrumbSubTitle")
    add
@endsection

@section('css')
    <link rel="stylesheet" href="{{ url('bower_components/select2/dist/css/select2.min.css') }}">
    
@endsection

@section("breadCrumbList")
    <li><a href="/inventory"><i class="fa fa-line-chart"></i> Inventory</a></li>
    <li class="active">New</li>
@endsection

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">Inventory Information</h3></div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <select class="form-control select2" style="width: 100%;" multiple="multiple" data-placeholder="Select a Products" name="product[]" >
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('product') }}</i></div>
                                    </div>

                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-line-chart"></i>
                                            </span>
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="{{ old('quantity') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('quantity') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <button type="reset" id="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2()
        });
    </script>
@endsection
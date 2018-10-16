@extends('layouts.app')

@section("breadCrumbTitle")
    {{ $inventory->product->product_name }}
@endsection

@section("breadCrumbSubTitle")
    inventory
@endsection

@section("breadCrumbList")
    <li><a href="/inventory"><i class="fa fa-line-chart"></i> Inventory</a></li>
    <li class="active">{{ $inventory->product->product_name }}</li>
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
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" name="product" class="form-control" placeholder="Product" value="{{ $inventory->product->product_name }}" readonly>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('product') }}</i></div>
                                    </div>

                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-line-chart"></i>
                                            </span>
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="{{ $inventory->quantity }}">
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
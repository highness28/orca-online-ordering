@extends('layouts.app')

@section("breadCrumbTitle")
    {{ $category->category_name }}
@endsection

@section("breadCrumbSubTitle")
    category
@endsection

@section("breadCrumbList")
    <li><a href="/category"><i class="fa fa-list-alt"></i> Category</a></li>
    <li class="active">{{ $category->category_name }}</li>
@endsection

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">{{ $category->category_name }}</h3></div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" name="category_name" class="form-control" placeholder="Brand Name" value="{{ $category->category_name }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('category_name') }}</i></div>
                                    </div>
                                </div>
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
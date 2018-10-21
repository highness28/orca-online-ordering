@extends('layouts.app')

@section("breadCrumbTitle")
    Product
@endsection

@section("breadCrumbSubTitle")
    add
@endsection

@section("breadCrumbList")
    <li><a href="/product"><i class="fa fa-tag"></i> Product</a></li>
    <li class="active">New</li>
@endsection

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">Product Information</h3></div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image_preview">
                                            <label for="image"><i class="fa fa-camera"></i></label>
                                            <img src="{{ asset('img/products/default.png') }}" id="prodImgPrev">
                                        </div>
                                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('image') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{ old('product_name') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('product_name') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </div>
                                            <select name="brand" id="brand" class="form-control">
                                                <option value="" disabled selected>Select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand')==$brand->id? 'selected':'' }}>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('brand') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-list-alt"></i>
                                            </div>
                                            <select name="category" id="category" class="form-control">
                                                <option value="" disabled selected>Select category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category')==$category->id? 'selected':'' }}>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('category') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-code"></i>
                                            </span>
                                            <input type="text" name="item_code" class="form-control" placeholder="Item Code" value="{{ old('item_code') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('item_code') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-money"></i>
                                            </span>
                                            <input type="number" name="product_price" class="form-control" placeholder="Item Price" value="{{ old('product_price') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('product_price') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-line-chart"></i>
                                            </span>
                                            <input type="number" name="critical_value" class="form-control" placeholder="Critical Value" value="{{ old('critical_value') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('critical_value') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                
                                    <div class="col-xs-6">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">
                                                    Description
                                                </h3>
                                                <!-- tools box -->
                                                <div class="pull-right box-tools">
                                                    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                                            title="Collapse">
                                                    <i class="fa fa-minus"></i></button>
                                                </div>
                                                <!-- /. tools -->
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body pad">
                                                <textarea class="textarea" placeholder="Place input here"
                                                        name="description" required
                                                        style="width: 100%; height: 250px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                                                <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('description') }}</i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">
                                                    Specification
                                                </h3>
                                                <!-- tools box -->
                                                <div class="pull-right box-tools">
                                                    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                                            title="Collapse">
                                                    <i class="fa fa-minus"></i></button>
                                                </div>
                                                <!-- /. tools -->
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body pad">
                                                <textarea class="textarea" placeholder="Place input here"
                                                        name="specification" required
                                                        style="width: 100%; height: 250px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('specification') }}</textarea>
                                                <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('specification') }}</i></div>
                                            </div>
                                        </div>
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

@section('js')
    <script>
        $(document).ready(function(){
            $(document.getElementById('remove')).attr('style', 'cursor: pointer');
            $(document).on('click', '#remove', function() {
                $(this).closest('div').remove();
            });
            
            $('.imgFile').change(function(){
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];  

                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('.prodImgPrev').attr('src','{{ asset('img/products/default.png') }}');
                    return false;
                }
                    else
                {
                    var reader = new FileReader();  
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });

            function imageIsLoaded(e){
                $('#prodImgPrev').attr('src', e.target.result);
            }
            
            $('#reset').on('click', function() {
                $('#prodImgPrev').attr('src', '{{ asset('img/products/default.png') }}');
            });
        });
    </script>
@endsection
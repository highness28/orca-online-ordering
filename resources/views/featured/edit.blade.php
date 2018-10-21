@extends('layouts.app')

@section("breadCrumbTitle")
    {{ $selectedCategory->category->category_name }}
@endsection

@section("breadCrumbSubTitle")
    category
@endsection

@section("breadCrumbList")
    <li><a href="/featured-category"><i class="fa fa-tags"></i> Featured Category</a></li>
    <li class="active">{{ $selectedCategory->category_name }}</li>
@endsection

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">Featured Category Information</h3></div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image_preview">
                                            <label for="image"><i class="fa fa-camera"></i></label>
                                            @if($selectedCategory->image)
                                                <img src="data:image/png;base64,{{ base64_encode($selectedCategory->image) }}" alt="category" id="prodImgPrev">
                                            @else
                                                <img src="{{ url('/img/products/default.png') }}" alt="Pategory" id="prodImgPrev">
                                            @endif
                                        </div>
                                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('image') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <select class="form-control select2" style="width: 100%;" data-placeholder="Select a Category" name="category" >
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $selectedCategory->id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('category') }}</i></div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $selectedCategory->title }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('title') }}</i></div>
                                    </div>

                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <select class="form-control select2" style="width: 100%;" data-placeholder="Select a Status" name="status" >
                                            <option value="1" {{ $selectedCategory->status == 1 ? 'selected':''  }}>Displayed</option>
                                            <option value="0" {{ $selectedCategory->status == 0 ? 'selected':''  }}>Not Displayed</option>
                                        </select>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('status') }}</i></div>
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
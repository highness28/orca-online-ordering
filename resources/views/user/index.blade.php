@extends('layouts.app')

@section("breadCrumbTitle")
    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}'s
@endsection

@section("breadCrumbSubTitle")
    profile
@endsection

@section("breadCrumbList")
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@endsection

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                {!! Session::get('message') !!}
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">User Information</h3></div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image_preview">
                                            <label for="image"><i class="fa fa-camera"></i></label>
                                            @if(Auth::user()->avatar)
                                                <img src="data:image/png;base64,{{ base64_encode(Auth::user()->avatar) }}" class="prodImgPrev" id="prodImgPrev">
                                            @else
                                                <img src="{{ url('/img/users/default.png') }}" alt="Product" style="width: 100%" class="prodImgPrev" id="prodImgPrev">
                                            @endif
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
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}" autocomplete="off">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('email') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control" placeholder="Password" value="" autocomplete="off">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('password') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-mobile"></i>
                                            </span>
                                            <input type="number" name="mobile_number" class="form-control" placeholder="Mobile number" value="{{ Auth::user()->mobile_number }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('mobile_number') }}</i></div>
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
                                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ Auth::user()->first_name }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('first_name') }}</i></div>
                                    </div>
                                    
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="{{ Auth::user()->middle_name }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('middle_name') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ Auth::user()->last_name }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('last_name') }}</i></div>
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
                $('.prodImgPrev').attr('src', e.target.result);
            }
            
            $('#reset').on('click', function() {
                $('#image').val('');
                $('#prodImgPrev').attr('src', "{{ Auth::user()->avatar ? 'data:image/png;base64,'.base64_encode(Auth::user()->avatar) : url('img/users/default.png') }}");
            });
        });
    </script>
@endsection
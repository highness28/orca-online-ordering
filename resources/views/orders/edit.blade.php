@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section("breadCrumbTitle")
    Invoice #{{ $invoice->id }}
@endsection

@section("breadCrumbSubTitle")
    {{ $invoice->tracking_number }}
@endsection

@section("breadCrumbList")
    <li><a href="/orders"><i class="fa fa-list-alt"></i> Category</a></li>
    <li class="active">Invoice #{{ $invoice->id }}</li>
@endsection

@section('content')
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">Invoice Information</h3></div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        <div class="box-body">

                            <h3><strong>Customer Name:</strong> {{ $invoice->customer->first_name . ' ' . $invoice->customer->last_name }}</h3>
                            <ul>
                                <li><strong>Contact #:</strong> {{ $invoice->addressBook->phone_number }}</li>
                                <li><strong>Delivery Address</strong> {{ $invoice->addressBook->delivery_address }}</li>
                                <li><strong>Province</strong> {{ $invoice->addressBook->province }}</li>
                                <li><strong>City</strong> {{ $invoice->addressBook->city }}</li>
                                <li><strong>Barangay</strong> {{ $invoice->addressBook->barangay }}</li>
                            </ul>

                            <p><strong>Tacking number:</strong> {{ $invoice->tracking_number }}</p>
                            <p><strong>Date orderd:</strong> {{ date('F d, Y', strtotime($invoice->created_at)) }}</p>
                            <p><strong>Payment mode:</strong> {{ $invoice->payment_type == 0 ? "Cash on Delivery" : "Card" }}</p>

                            <div class="row">
                                <div class="col-xs-12">
                                    <span><strong>Products Ordered:</strong></span>
                                </div>

                                <div class="col-xs-3">
                                    <ol>
                                        @foreach($ordersList as $order)
                                            <li>
                                                @if($order->product->image)
                                                    <img src="data:image/png;base64,{{ base64_encode($order->product->image) }}" alt="Product" style="width: 20px;">
                                                @else
                                                    <img src="{{ url('/img/products/default.png') }}" alt="Product" style="width: 100%">
                                                @endif
                                                <strong>{{ $order->product->product_name }}</strong>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>

                                <div class="col-xs-3">
                                    <ul style="list-style-type:none">
                                        @foreach($ordersList as $order)
                                            <li>{{ $order->quantity }} x <em>{{ number_format($order->subtotal, 2) }}</em></li>
                                        @endforeach
                                        <li><strong>Total: </strong> {{ 'Php ' . number_format($invoice->total, 2) }}</li>
                                    </ul>
                                </div>
                            </div>

                            @if($invoice->status < 2)
                                @if(Auth::user()->role != 3 && $invoice->status != 0)
                                    <div class="row" style="margin-top: 50px;">
                                        <div class="form-group">
                                            <div class="col-lg-3 col-md-4 col-xs-12">
                                                <label>Delivery Date:</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="datepicker" name="delivery_date" value="{{ $invoice->delivery_date ? date('F d, Y', strtotime($invoice->delivery_date)) : date('F d, Y') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="form-group" style="margin-top: 10px;">
                                    <strong>Note:</strong> Submitting the form will
                                    @if(in_array(Auth::user()->role, [1,3]) && $invoice->status == 0)
                                        <em>set the order that it is ready for delivery and will be sent to sales personnel to set the delivery date.</em> 
                                    @else
                                        <em>set the order that it is ready for delivery on the date selected.</em>
                                    @endif
                                </div>
                            @endif
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        @if($invoice->status == 2)
                                            <a href="{{ url('/orders/deliver/'.$invoice->id) }}" class="btn btn-success"><i class="fa fa-calendar"></i> Set Delivered</a>
                                        @elseif($invoice->status != 3)
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Submit</button>
                                        @endif
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
    <script src="{{ url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function() {
            var currDate = new Date();
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'MM d, yyyy',
                minDate: 0,
                startDate : currDate
            });
        });
    </script>
@endsection
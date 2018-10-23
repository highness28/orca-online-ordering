@component('mail::layout')
{{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Orite Copier and Supplies
        @endcomponent
    @endslot
{{-- Body --}}
    <h1><strong>Hello,</strong> <span>{{ $customer->first_name . ' ' . $customer->last_name }}</span></h1>
    Thank you for shopping with us!

    Your orders:
    @foreach($orders as $order)
    {{ $order->product->product_name . '    x' . $order->quantity }} - {{ 'Php ' . number_format($order->quantity * $order->subtotal, 2) }}
    @endforeach

    Total: {{ 'Php ' . number_format($invoice->total, 2) }}
    
    Is now set for delivery on {{ date('F d, Y', strtotime($invoice->delivery_date)) }}

@component('mail::button', ['url' => 'orca-ordering.com/order/'.$invoice->id])
View order
@endcomponent

    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
@component('mail::message')
# Hello {{ $order->first_name ?? 'Customer' }},

Your order **#{{ $order->id }}** has been successfully placed! 🎉  
We’ll notify you when it’s on the way.

@component('mail::panel')
**Order Summary**  
Total: Rs {{ number_format($order->total, 2) }}  
Payment Method: {{ strtoupper($order->payment_method) }}
@endcomponent

Thank you for shopping with us!

@component('mail::button', ['url' => url('/orders/' . $order->id)])
View Your Order
@endcomponent

Thanks,  
Grocery Store
@endcomponent

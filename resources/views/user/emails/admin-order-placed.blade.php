@component('mail::message')
# New Order Received! 🛍️

A new order has just been placed on **{{ config('app.name') }}**.

@component('mail::panel')
**Order ID:** #{{ $order->id }}  
**Customer:** {{ $order->first_name }} {{ $order->last_name }}  
**Email:** {{ $order->email }}  
**Phone:** {{ $order->phone }}  
**Total:** Rs {{ number_format($order->total, 2) }}  
**Payment Method:** {{ strtoupper($order->payment_method) }}
@endcomponent

@component('mail::button', ['url' => url('/admin/orders/' . $order->id)])
View in Admin Panel
@endcomponent

Keep up the great work 🚀  
— {{ config('app.name') }} Notifications
@endcomponent

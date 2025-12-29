<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1, h2, h3 {
            margin: 0;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #00a86b;
            padding-bottom: 15px;
        }

        .company-info {
            text-align: right;
        }

        .company-info h2 {
            color: #00a86b;
            margin-bottom: 5px;
        }

        .order-meta {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #00a86b;
            color: #fff;
        }

        .total-section {
            margin-top: 30px;
            text-align: right;
        }

        .total-section table {
            width: 50%;
            float: right;
        }

        .total-section td {
            padding: 8px;
        }

        .grand-total {
            background: #00a86b;
            color: #fff;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div>
                <h1>Invoice</h1>
                <p>Order #{{ $order->id }}</p>
                <p>Date: {{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div class="company-info">
                <h2>GStore</h2>
                <p>Karachi, Pakistan</p>
                <p>support@gstore.com</p>
            </div>
        </div>

        <div class="order-meta">
            <h3>Billing & Shipping Info</h3>
            @php
                $address = $order->addresses->first(); // shipping address
            @endphp
            <p><strong>{{ $address->first_name }} {{ $address->last_name }}</strong></p>
            <p>{{ $address->address }}, {{ $address->city }}</p>
            <p>{{ $address->postal_code }}</p>
            <p>Email: {{ $address->email }}</p>
            <p>Phone: {{ $address->phone }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Qty</th>
                    <th>Price (PKR)</th>
                    <th>Total (PKR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->size?->name ?? '-' }}</td>
                        <td>{{ $item->color?->name ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td>{{ number_format($order->subtotal, 2) }} PKR</td>
                </tr>
                <tr>
                    <td>Shipping:</td>
                    <td>{{ number_format($order->shipping, 2) }} PKR</td>
                </tr>
                <tr>
                    <td>Discount:</td>
                    <td>-{{ number_format($order->discount, 2) }} PKR</td>
                </tr>
                <tr class="grand-total">
                    <td>Total:</td>
                    <td>{{ number_format($order->total, 2) }} PKR</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for shopping with GStore! 🛒</p>
            <p>This is a computer-generated invoice — no signature required.</p>
        </div>
    </div>
</body>
</html>

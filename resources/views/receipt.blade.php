<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details, .products {
            margin-bottom: 20px;
        }
        .products table {
            width: 100%;
            border-collapse: collapse;
        }
        .products table, .products th, .products td {
            border: 1px solid black;
        }
        .products th, .products td {
            padding: 8px;
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Receipt</h1>
        <p>Receipt Number: {{ $order->receipt }}</p>
    </div>

    <div class="details">
        <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
        <p><strong>WhatsApp:</strong> {{ $order->customer_whatsapp }}</p>
        <p><strong>City:</strong> {{ $order->customer_city }}</p>
        <p><strong>Postcode:</strong> {{ $order->customer_postcode }}</p>
        <p><strong>Address:</strong> {{ $order->customer_address }}</p>
    </div>

    <div class="products">
        <h2>Products</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['qty'] }}</td>
                    <td>Rp. {{ number_format($product['price'], 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($product['price'] * $product['qty'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <p>Total: Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
    </div>
</body>
</html>
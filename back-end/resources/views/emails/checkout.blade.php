<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Checkout completed!</title>
    <meta charset="utf-8" />
</head>
<body>
<h2>Checkout completed</h2>
<p>Dear {{ $user_name }}, your checkout was completed and is being processed.</p>
<p>These were the items bought:</p>
    <table>
        <thead>
            <th>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total Price</td>
            </th>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ floatval($item['price']) * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Final Price: {{ $total_price }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
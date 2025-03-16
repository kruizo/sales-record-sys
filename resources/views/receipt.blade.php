<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Adelflor</title>
</head>
<style>
    .receipt-body {
        margin: 0;
        box-sizing: border-box;
        height: 100%;
    }
    #receipt-container {
        width: 75mm;
        padding: 2mm;
        margin: 0 auto;
        background-color: #fff;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -70%);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        border-radius: 5px;
        margin-top: 10em;
    }
    #receipt-container h1, h2, h3, p {
        text-align: center;
    }
    #receipt-container h1 , #mid, table, #serial{
        color: #222;
    }
    #serial{
        font-size: 15px;
        margin-top: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    .tabletitle {
        background: #eee;
    }
    .tableitem p {
        text-align: center;
    }
    .legalcopy {
        text-align: center;
        font-size: 0.7em;
        margin-top: 10px;
    }
</style>

<body class="receipt-body">
    <div id="receipt-container" class="receipt-container" style="display: none;">
    <button id="close-receipt" style="float: right; border: none; background: none; font-size: 18px; cursor: pointer;">✖</button>
        <center id="top">
            <h1><b>Adelflor Water Refilling</b></h1>
            <p>Km.16 Fatima, Indangan</p>
            <p>Email: e.sinining.529446@umindanao.edu.ph</p>
            <p>Phone: 09774206138</p>
        </center>

        <div id="mid">
            @if(isset($order))
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                <p><strong>Payment Type:</strong> {{ $order->payment_type }}</p>
            @else
                <p><strong>Error:</strong> Order not found.</p>
            @endif

        </div>

        @if(isset($order) && $order->orderline->isNotEmpty())
            <table>
                <tr class="tabletitle">
                    <td>Item</td>
                    <td>Qty</td>
                    <td>Unit Price</td>
                    <td>Subtotal</td>
                </tr>
                @foreach ($order->orderline as $orderline)
                <tr class="tableitem">
                    <td>{{ $orderline->water->name ?? 'N/A' }}</td>
                    <td>{{ $orderline->quantity ?? '0' }}</td>
                    <td>₱{{ $orderline->water->cost ?? '0.00' }}</td>
                    <td>₱{{ $orderline->subtotal ?? '0.00' }}</td>
                </tr>
                @endforeach
                <tr class="tabletitle">
                    <td colspan="3">Delivery Fee</td>
                    <td>₱{{ $order->delivery_fee ?? '0.00' }}</td>
                </tr>
                <tr class="tabletitle">
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>₱{{ $order->total ?? '0.00' }}</strong></td>
                </tr>
            </table>
        @else
            <p style="color: red;">No order details available.</p>
        @endif

        <div class="legalcopy">
            <p><strong>** Thank you for choosing us **</strong></p>
            <p>This receipt is proof of your purchase. Please take a picture and present it to the cashier if needed.</p>
        </div>
        <p id="serial" class="serial-number">Serial: <span class="serial">b1234567883434</span> | Date: {{ now()->format('m/d/y H:i') }}</p>
    </div>

    <script src="../js/app.js"></script>
</body>
</html>

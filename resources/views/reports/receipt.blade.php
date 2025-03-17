<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>
    <style>
        .receipt-body {
            margin: 0;
            box-sizing: border-box;
            height: 100vh; /* Use full viewport height */
            display: flex;
            justify-content: center;
            overflow: hidden;
            align-items: center;
        }

        #container {
            width: 70mm;
            max-width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
            background-color: #fff;
            text-align: center;
        }

        #container h1 {
            font-size: 1.5em;
            color: #222;
        }

        #container h2 {
            font-size: 0.5em;
        }

        #container h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #container p {
            font-size: 0.5em;
            line-height: 1.2em;
            counter-reset: #666;
        }

        #container #top,
        #container #mid,
        #container #bot {
            border-bottom: 1px solid #eee;
        }

        #container #top {
            min-width: 100px;
        }

        #container #mid {
            min-width: 80px;
        }

        #container #bot {
            min-width: 50px;
        }

        #container .logo {
            height: 60px;
            width: 60px;
            background-image: url() no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #container .info {
            display: block;
            margin-left: 0;
            text-align: center;
        }

        #container .title {
            float: right;
        }

        #container .title p {
            text-align: right;
        }

        #container table {
            width: 100%;
            border-collapse: #eee;
        }

        #container .tabletitle {
            font-size: 1em;
            background: #eee;
        }

        #container .service {
            border-bottom: 1px solid #eee;
        }

        #container .item {
            width: 24mm;
        }

        #container .itemtext {
            font-size: 0.5em;
        }

        #container #legalcopy {
            margin-top: 5mm;
            text-align: center;
        }

        .serial-number {
            margin-top: 5mm;
            margin-bottom: 2mm;
            text-align: center;
            font-size: 12px;
        }

        .serial {
            font-size: 10px !important;
        }
    </style>

    <body class="receipt-body">
        <div id="container">
            <div id="printed content">
                <h1><b>Adelflor Water Refilling</b></h1>
                <p>Km.16 Fatima, Indangan</p>
                <p>Email: e.sinining.529446@umindanao.edu.ph</p>
                <p>Phone: 09774206138</p>
            </div>

            <div id="bot">
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="Item">
                                <h2>Item</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qty</h2>
                            </td>
                            <td class="Rate">
                                <h2>Unit</h2>
                            </td>
                            <td class="Rate">
                                <h2>Sub Total</h2>
                            </td>
                        </tr>

                        @foreach($order->orderline as $item)
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{ $item->water->name }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $item->quantity }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $item->water->cost }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $item->subtotal }}</p></td>
                        </tr>
                        @endforeach
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <p class="itemtext">DeliveryFee</p>
                            </td>
                            <td class="Payment">
                                <p class="itemtext">P 10</p>
                            </td>
                        </tr>
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>
                                <h2>{{ $order->total}} P</h2>
                            </td>
                        </tr>
                    </table>
                    <div class="legalcopy">
                        <p class="legal">
                            <strong>** Thank you for choosing us **</strong
                            ><br />
                            This receipt will serve as your proof of purchase to
                            our products and services.
                        </p>
                    </div>
                    <div class="serial-number">
                        Serial: <span class="serial">b1234567883434</span>
                        <span>24/02/24 &nbsp &nbsp 00: 45</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

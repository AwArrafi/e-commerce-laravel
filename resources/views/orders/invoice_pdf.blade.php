<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->invoice_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .row {
            width: 100%;
        }

        .left {
            float: left;
            width: 60%;
        }

        .right {
            float: right;
            width: 40%;
            text-align: right;
        }

        .clear {
            clear: both;
        }

        h1 {
            margin: 0 0 6px 0;
            font-size: 22px;
        }

        .muted {
            color: #666;
        }

        .box {
            border: 1px solid #ddd;
            padding: 14px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th,
        td {
            padding: 10px 6px;
            border-bottom: 1px solid #ddd;
        }

        th {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row td {
            border-bottom: none;
        }

        .total-label {
            text-align: right;
            font-weight: bold;
        }

        .total-value {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="box">
        <div class="row">
            <div class="left">
                <h1>Invoice</h1>
                <div class="muted">Nomor: {{ $order->invoice_number }}</div>
                <div class="muted">Tanggal: {{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>
            <div class="right">
                <div><b>Toko Alat Kesehatan Mitra</b></div>
                <div class="muted">Jl. Sangkuriang No. 123</div>
                <div class="muted">Telp: 0812-0000-0000</div>
            </div>
            <div class="clear"></div>
        </div>

        <br>

        <div>
            <div style="margin-bottom:6px;"><b>Kepada Yth.</b></div>
            <div>{{ $order->customer_name }}</div>
            @if ($order->customer_address)
                <div class="muted">{{ $order->customer_address }}</div>
            @endif
            @if ($order->customer_phone)
                <div class="muted">Telp: {{ $order->customer_phone }}</div>
            @endif
            @if ($order->customer_email)
                <div class="muted">Email: {{ $order->customer_email }}</div>
            @endif
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $it)
                    <tr>
                        <td>{{ $it->product->name ?? 'Produk' }}</td>
                        <td class="text-center">{{ $it->quantity }}</td>
                        <td class="text-right">Rp {{ number_format($it->unit_price, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($it->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" class="total-label">Total</td>
                    <td class="total-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <p class="muted" style="margin-top:14px;">
            Terima kasih telah berbelanja di Toko Alat Kesehatan.
        </p>
    </div>
</body>

</html>

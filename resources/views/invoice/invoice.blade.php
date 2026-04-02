<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }} - JajanSnack</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #1f2937;
            background: #fff;
        }

        .invoice-wrap {
            padding: 40px 48px;
        }

        /* Header */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 32px;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }

        .brand-name {
            font-size: 26px;
            font-weight: 700;
            color: #7f574c;
            letter-spacing: -0.5px;
        }

        .brand-tagline {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        .invoice-label {
            font-size: 22px;
            font-weight: 700;
            color: #7f574c;
        }

        .invoice-number {
            font-size: 13px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 2px solid #eadfd7;
            margin: 0 0 24px 0;
        }

        /* Meta row */
        .meta-table {
            width: 100%;
            margin-bottom: 28px;
        }

        .meta-table td {
            vertical-align: top;
            width: 50%;
        }

        .meta-title {
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 4px;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .meta-value-soft {
            font-size: 12px;
            color: #374151;
            margin-top: 2px;
        }

        /* Status badge */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-waiting {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-declined {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-canceled {
            background: #f3f4f6;
            color: #374151;
        }

        /* Items table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .items-table thead th {
            background: #7f574c;
            color: #fff;
            padding: 10px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
        }

        .items-table thead th:last-child {
            text-align: right;
        }

        .items-table thead th:nth-child(2),
        .items-table thead th:nth-child(3) {
            text-align: center;
        }

        .items-table tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #eadfd7;
            font-size: 13px;
        }

        .items-table tbody td:nth-child(2) {
            text-align: center;
        }

        .items-table tbody td:nth-child(3) {
            text-align: center;
        }

        .items-table tbody td:last-child {
            text-align: right;
            font-weight: 500;
        }

        .items-table tfoot td {
            padding: 10px 12px;
            font-weight: 700;
            font-size: 14px;
            text-align: right;
        }

        .items-table tfoot .total-label {
            text-align: left;
            color: #6b7280;
        }

        /* Footer */
        .footer {
            margin-top: 36px;
            border-top: 1px solid #eadfd7;
            padding-top: 16px;
        }

        .footer-text {
            font-size: 11px;
            color: #9ca3af;
            text-align: center;
        }

        .footer-text strong {
            color: #7f574c;
        }

        /* Note box */
        .note-box {
            background: #f7efe8;
            border-left: 4px solid #b45309;
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 24px;
            font-size: 12px;
            color: #374151;
        }
    </style>
</head>

<body>
    <div class="invoice-wrap">

        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <div class="brand-name">JajanSnack</div>
                <div class="brand-tagline">Kue &amp; Snack Homemade Berkualitas</div>
            </div>
            <div class="header-right">
                <div class="invoice-label">INVOICE</div>
                <div class="invoice-number">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <hr class="divider">

        <!-- Meta -->
        <table class="meta-table">
            <tr>
                <td>
                    <div class="meta-title">Tagihan Kepada</div>
                    <div class="meta-value">{{ $order->user->name }}</div>
                    <div class="meta-value-soft">{{ $order->user->email }}</div>
                    @if($order->user->phone_number ?? null)
                    <div class="meta-value-soft">{{ $order->user->phone_number }}</div>
                    @endif
                </td>
                <td style="text-align:right">
                    <div class="meta-title">Tanggal Order</div>
                    <div class="meta-value">{{ $order->created_at->format('d M Y') }}</div>
                    <div style="margin-top:10px">
                        <div class="meta-title">Tanggal Pengambilan</div>
                        <div class="meta-value">{{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</div>
                    </div>
                    <div style="margin-top:10px">
                        <div class="meta-title">Status</div>
                        @php
                        $statusLabels = [
                        'pending' => 'Menunggu Konfirmasi',
                        'waiting_verification' => 'Menunggu Verifikasi',
                        'paid' => 'Dibayar / Disetujui',
                        'declined' => 'Ditolak',
                        'canceled' => 'Dibatalkan',
                        ];
                        $statusClasses = [
                        'pending' => 'badge-pending',
                        'waiting_verification' => 'badge-waiting',
                        'paid' => 'badge-paid',
                        'declined' => 'badge-declined',
                        'canceled' => 'badge-canceled',
                        ];
                        @endphp
                        <span class="badge {{ $statusClasses[$order->status] ?? '' }}">
                            {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                        </span>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width:50%">Produk</th>
                    <th style="width:15%">Qty</th>
                    <th style="width:20%">Harga Satuan</th>
                    <th style="width:15%">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Produk dihapus' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total-label">Total Pembayaran</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Payment method note -->
        @if($order->payment_method === 'transfer')
        <div class="note-box">
            <strong>Metode Pembayaran:</strong> Transfer Bank &mdash;
            BCA No. Rekening <strong>1234567890</strong> a/n Jajan Snack Indonesia
        </div>
        @else
        <div class="note-box">
            <strong>Metode Pembayaran:</strong> Bayar di Toko saat pengambilan.
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">
                Terima kasih telah berbelanja di <strong>JajanSnack</strong>. &mdash;
                Invoice ini dibuat secara otomatis pada {{ now()->format('d M Y, H:i') }} WIB.
            </p>
        </div>

    </div>
</body>

</html>
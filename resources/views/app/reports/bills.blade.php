<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $reportTitle }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            position: relative;
            min-height: 100%;
        }
        .container {
            width: 100%;
            padding: 10px;
            padding-bottom: 30px; /* Reduced space for footer */
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        .date {
            font-size: 12px;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .summary-item {
            margin-bottom: 5px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 5px; /* Reduced padding */
            height: 25px; /* Reduced height */
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .status-pending {
            color: #856404;
            background-color: #fff3cd;
            padding: 2px 5px;
            border-radius: 3px;
        }
        .status-paid {
            color: #155724;
            background-color: #d4edda;
            padding: 2px 5px;
            border-radius: 3px;
        }
        .status-partially_paid {
            color: #0c5460;
            background-color: #d1ecf1;
            padding: 2px 5px;
            border-radius: 3px;
        }
        .status-overdue {
            color: #721c24;
            background-color: #f8d7da;
            padding: 2px 5px;
            border-radius: 3px;
        }
        /* Set page size for PDF */
        @page {
            size: a4;
            margin: 10mm 10mm 5mm 10mm; /* Reduced bottom margin */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">{{ $reportTitle }} {{ $dateRange }}</div>
            <div class="subtitle">{{ tenant()->name }}</div>
            <div class="date">Generated: {{ $generatedAt }}</div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Bill #</th>
                    <th>Patient</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bills as $bill)
                <tr>
                    <td>{{ $bill->bill_number }}</td>
                    <td>{{ $bill->patient->full_name }}</td>
                    <td>{{ $bill->service->name }}</td>
                    <td class="text-right">PHP {{ number_format($bill->amount, 2) }}</td>
                    <td class="text-right">PHP {{ number_format($bill->amount_paid, 2) }}</td>
                    <td class="text-right">PHP {{ number_format($bill->amount - $bill->amount_paid, 2) }}</td>
                    <td>{{ $bill->due_date->format('M d, Y') }}</td>
                    <td class="text-center">
                        <span class="status-{{ $bill->status }}">
                            {{ ucfirst(str_replace('_', ' ', $bill->status)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No bills found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="summary">
            <div class="summary-item"><strong>Total Bills:</strong> {{ $bills->count() }}</div>
            <div class="summary-item"><strong>Total Amount:</strong> PHP {{ number_format($totalAmount, 2) }}</div>
            <div class="summary-item"><strong>Total Paid:</strong> PHP {{ number_format($totalPaid, 2) }}</div>
            <div class="summary-item"><strong>Total Remaining:</strong> PHP {{ number_format($totalRemaining, 2) }}</div>
        </div>
        
        <div class="footer">
            This is an automatically generated report. {{ tenant()->name }} &copy; {{ date('Y') }}
        </div>
    </div>
</body>
</html> 
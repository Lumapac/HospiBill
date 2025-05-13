<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bill #{{ $bill->bill_number }}</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 10mm 15mm 10mm;
        }
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #3366cc;
            margin: 0;
            padding: 0;
        }
        .bill-details {
            margin-bottom: 30px;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .patient-details {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            font-size: 10pt;
            color: #777;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .text-right {
            text-align: right;
        }
        .payment-info {
            margin-top: 40px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 10pt;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HospiBill</h1>
        <p>Healthcare Billing System</p>
        <p>123 Hospital Street, Medical City, 12345</p>
        <p>Phone: (123) 456-7890 | Email: info@hospibill.com</p>
    </div>
    
    <div class="bill-details">
        <h2>BILL #{{ $bill->bill_number }}</h2>
        <table>
            <tr>
                <td><strong>Issue Date:</strong></td>
                <td>{{ $bill->created_at->format('F d, Y') }}</td>
                <td><strong>Due Date:</strong></td>
                <td>{{ $bill->due_date->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>{{ ucfirst($bill->status) }}</td>
                <td><strong>Amount Due:</strong></td>
                <td>PHP {{ number_format($bill->amount - $bill->amount_paid, 2) }}</td>
            </tr>
        </table>
    </div>
    
    <div class="patient-details">
        <h3>Patient Information</h3>
        <table>
            <tr>
                <td><strong>Name:</strong></td>
                <td>{{ $bill->patient->first_name }} {{ $bill->patient->last_name }}</td>
                <td><strong>Gender:</strong></td>
                <td>{{ ucfirst($bill->patient->gender) }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td>{{ $bill->patient->email }}</td>
                <td><strong>Phone:</strong></td>
                <td>{{ $bill->patient->phone }}</td>
            </tr>
            <tr>
                <td><strong>Address:</strong></td>
                <td colspan="3">{{ $bill->patient->address }}</td>
            </tr>
        </table>
    </div>
    
    <h3>Service Details</h3>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Description</th>
                <th>Category</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $bill->service->name }}</td>
                <td>{{ $bill->service->description ?: 'N/A' }}</td>
                <td>{{ $bill->service->category ?: 'General' }}</td>
                <td class="text-right">PHP {{ number_format($bill->amount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                <td class="text-right">PHP {{ number_format($bill->amount, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><strong>Amount Paid:</strong></td>
                <td class="text-right">PHP {{ number_format($bill->amount_paid, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>Amount Due:</strong></td>
                <td class="text-right">PHP {{ number_format($bill->amount - $bill->amount_paid, 2) }}</td>
            </tr>
        </tbody>
    </table>
    
    @if($bill->notes)
    <div>
        <h3>Notes</h3>
        <p>{{ $bill->notes }}</p>
    </div>
    @endif
    
    <div class="payment-info">
        <h3>Payment Information</h3>
        <p>Please make payment by the due date to avoid late fees.</p>
        <p><strong>Payment Methods:</strong></p>
        <ul>
            <li>Cash payment at our facility</li>
            <li>Bank transfer to Account #: 1234-5678-9012</li>
            <li>Online payment through our patient portal</li>
        </ul>
        <p>For any questions regarding this bill, please contact our billing department at billing@hospibill.com or call (123) 456-7890.</p>
    </div>
    
    <div class="footer">
        <p>Thank you for choosing HospiBill for your healthcare needs.</p>
        <p>&copy; {{ date('Y') }} HospiBill. All rights reserved.</p>
    </div>
</body>
</html> 
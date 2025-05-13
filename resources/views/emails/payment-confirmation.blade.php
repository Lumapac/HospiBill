<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation - HospiBill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            margin-bottom: 30px;
        }
        .footer {
            border-top: 1px solid #eee;
            padding-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        h1 {
            color: #3366cc;
        }
        .payment-info {
            background-color: #f0f7ff;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #3366cc;
        }
        .bill-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .success-message {
            color: #28a745;
            font-weight: bold;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .payment-table th, .payment-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .payment-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>HospiBill</h1>
        </div>
        
        <div class="content">
            <p>Dear {{ $patient->first_name }} {{ $patient->last_name }},</p>
            
            <p>Thank you for your payment. We're confirming that we have received your payment for Bill #{{ $bill->bill_number }}.</p>
            
            <div class="payment-info">
                <h3>Payment Details</h3>
                <p><strong>Amount Paid:</strong> PHP {{ number_format($payment->amount, 2) }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
                <p><strong>Payment Date:</strong> {{ $payment->created_at->format('F d, Y h:i A') }}</p>
                @if($payment->reference_number)
                <p><strong>Reference Number:</strong> {{ $payment->reference_number }}</p>
                @endif
            </div>
            
            <div class="bill-info">
                <h3>Bill Status</h3>
                <p><strong>Bill Number:</strong> {{ $bill->bill_number }}</p>
                <p><strong>Service:</strong> {{ $bill->service->name }}</p>
                <p><strong>Total Amount:</strong> PHP {{ number_format($bill->amount, 2) }}</p>
                <p><strong>Amount Paid to Date:</strong> PHP {{ number_format($bill->amount_paid, 2) }}</p>
                <p><strong>Remaining Balance:</strong> PHP {{ number_format($bill->amount - $bill->amount_paid, 2) }}</p>
                <p><strong>Status:</strong> 
                    @if($bill->status === 'paid')
                    <span class="success-message">Fully Paid</span>
                    @else
                    <span>{{ ucfirst($bill->status) }}</span>
                    @endif
                </p>
            </div>
            
            @if(count($bill->payments) > 1)
            <h3>Payment History</h3>
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Reference #</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill->payments as $billPayment)
                    <tr>
                        <td>{{ $billPayment->created_at->format('M d, Y') }}</td>
                        <td>PHP {{ number_format($billPayment->amount, 2) }}</td>
                        <td>{{ ucfirst($billPayment->payment_method) }}</td>
                        <td>{{ $billPayment->reference_number ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            
            <p>We have attached an updated bill to this email which includes your recent payment and payment history.</p>
            
            <p>For any questions regarding your bill, please contact our billing department at billing@hospibill.com or call us at (123) 456-7890.</p>
            
            <p>Thank you for choosing our services.</p>
            
            <p>Sincerely,<br>
            The HospiBill Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} HospiBill. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this email address.</p>
        </div>
    </div>
</body>
</html> 
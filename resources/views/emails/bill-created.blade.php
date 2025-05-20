<!DOCTYPE html>
<html>
<head>
    <title>Your Bill From {{ $tenant ? $tenant->name : 'HospiBill' }}</title>
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
        .bill-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $tenant ? $tenant->name : 'HospiBill' }}</h1>
        </div>
        
        <div class="content">
            <p>Dear {{ $patient->first_name }} {{ $patient->last_name }},</p>
            
            <p>We hope this email finds you well. Please see the attached PDF receipt for a summary of the services you availed during your visit to our facility.</p>
            
            <div class="bill-info">
                <p><strong>Bill Number:</strong> {{ $bill->bill_number }}</p>
                <p><strong>Service:</strong> {{ $bill->service->name }}</p>
                <p><strong>Total Amount:</strong> PHP {{ number_format($bill->amount, 2) }}</p>
                <p><strong>Due Date:</strong> {{ $bill->due_date->format('F d, Y') }}</p>
            </div>
            
            <p>For any questions regarding your bill, please contact our billing department at billing@{{ $domain }} or call us at (123) 456-7890.</p>
            
            <p>Thank you for choosing our services.</p>
            
            <p>Sincerely,<br>
            The {{ $tenant ? $tenant->name : 'HospiBill' }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $tenant ? $tenant->name : 'HospiBill' }}. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this email address.</p>
        </div>
    </div>
</body>
</html> 
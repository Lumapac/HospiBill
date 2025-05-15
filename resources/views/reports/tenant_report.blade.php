<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $reportTitle }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            font-size: 12px;
        }
        .header {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        .subtitle {
            font-size: 14px;
            color: #666;
        }
        .date {
            margin-top: 5px;
            font-size: 12px;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
        .status-approved {
            color: #28a745;
            font-weight: bold;
        }
        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }
        .status-rejected {
            color: #dc3545;
            font-weight: bold;
        }
        .summary {
            margin: 20px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #eee;
        }
        .summary-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .summary-item {
            display: inline-block;
            margin-right: 20px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $reportTitle }}</div>
        <div class="subtitle">{{ $dateRange }}</div>
        <div class="date">Generated on: {{ $generatedAt }}</div>
    </div>
    
    <div class="summary">
        <div class="summary-title">Summary:</div>
        <div class="summary-item">Total Tenants: {{ $tenants->count() }}</div>
        <div class="summary-item">Approved: {{ $tenants->where('status', 'approved')->count() }}</div>
        <div class="summary-item">Pending: {{ $tenants->where('status', 'pending')->count() }}</div>
        <div class="summary-item">Rejected: {{ $tenants->where('status', 'rejected')->count() }}</div>
    </div>
    
    @if ($tenants->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Tenant</th>
                    <th>Domain</th>
                    <th>Status</th>
                    <th>Contact</th>
                    <th>Registered On</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                    <tr>
                        <td>
                            <strong>{{ $tenant->name }}</strong><br>
                            {{ $tenant->email }}
                        </td>
                        <td>
                            @foreach ($tenant->domains as $domain)
                                {{ $domain->domain }}{{ $loop->last ? '' : ', ' }}
                            @endforeach
                        </td>
                        <td class="status-{{ $tenant->status }}">
                            {{ ucfirst($tenant->status) }}
                        </td>
                        <td>
                            {{ $tenant->contact_person ?? 'N/A' }}<br>
                            {{ $tenant->phone_number ?? 'N/A' }}
                        </td>
                        <td>{{ $tenant->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tenant records found matching the selected criteria.</p>
    @endif
    
    <div class="footer">
        <p>HospiBill - Tenant Management System | Copyright &copy; {{ date('Y') }}</p>
    </div>
</body>
</html> 
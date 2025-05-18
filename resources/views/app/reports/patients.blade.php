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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Service</th>
                    <th>Registration Date</th>
                    <th>Total Bills</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->full_name }}</td>
                    <td>{{ ucfirst($patient->gender) }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->contact_number }}</td>
                    <td>{{ $patient->service->name }}</td>
                    <td>{{ $patient->created_at->format('M d, Y') }}</td>
                    <td class="text-center">{{ $patient->bills->count() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No patients found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="summary">
            <div class="summary-item"><strong>Total Patients:</strong> {{ $patients->count() }}</div>
            <div class="summary-item"><strong>Total Bills:</strong> {{ $patients->sum(function($patient) { return $patient->bills->count(); }) }}</div>
        </div>
        
        <div class="footer">
            This is an automatically generated report. {{ tenant()->name }} &copy; {{ date('Y') }}
        </div>
    </div>
</body>
</html> 
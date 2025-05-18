@extends('app.layouts.sidebar')

@section('title', 'Generate Reports')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    @include('layouts.navbar', ['title' => 'Generate Reports'])
    
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-3">
                        <h5 class="mb-0">Generate Reports</h5>
                        <p class="text-sm mb-0">Generate detailed reports in various formats for analysis and record-keeping.</p>
                    </div>
                    <div class="card-body p-3">
                        @if(session('error'))
                        <div class="alert alert-danger text-white" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        
                        <form method="POST" action="{{ route('tenant.reports.generate') }}" id="report-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="report_type" class="form-control-label">Report Type</label>
                                        <select class="form-control" id="report_type" name="report_type" required>
                                            <option value="bills">Bills Report</option>
                                            <option value="payments">Payments Report</option>
                                            <option value="patients">Patients Report</option>
                                            <option value="services">Services Report</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="date_from" class="form-control-label">Date From</label>
                                        <input class="form-control" type="date" id="date_from" name="date_from">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="date_to" class="form-control-label">Date To</label>
                                        <input class="form-control" type="date" id="date_to" name="date_to">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group" id="status-group">
                                        <label for="status" class="form-control-label">Bill Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="all">All Statuses</option>
                                            <option value="pending">Pending</option>
                                            <option value="partially_paid">Partially Paid</option>
                                            <option value="paid">Paid</option>
                                            <option value="overdue">Overdue</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="service_id" class="form-control-label">Service</label>
                                        <select class="form-control" id="service_id" name="service_id">
                                            <option value="">All Services</option>
                                            @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn bg-gradient-primary">Generate PDF Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Report Types Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Report Type</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Filters Available</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Bills Report</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Comprehensive breakdown of all billing information.</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Date Range, Status, Service</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Payments Report</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Details of all payments received.</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Date Range, Service</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Patients Report</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">List of all patients and their details.</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Date Range, Service</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Services Report</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Analysis of services offered and their performance.</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Date Range, Specific Service</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reportTypeSelect = document.getElementById('report_type');
        const statusGroup = document.getElementById('status-group');
        
        // Show/hide status dropdown based on report type
        reportTypeSelect.addEventListener('change', function() {
            if (this.value === 'bills') {
                statusGroup.style.display = 'block';
            } else {
                statusGroup.style.display = 'none';
            }
        });
        
        // Initial check
        if (reportTypeSelect.value !== 'bills') {
            statusGroup.style.display = 'none';
        }
    });
</script>
@endpush 
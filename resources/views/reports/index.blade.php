@extends('layouts.sidebar')
@section('title', 'Generate Reports')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    @include('layouts.navbar', ['title' => 'Reports'])

    <div class="container-fluid py-2">
        <div class="row">
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Generate Tenant Reports</h3>
                <p class="mb-4">
                    Generate detailed tenant reports in PDF format for analysis and record-keeping
                </p>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-3 pb-0">
                        <h5 class="mb-0">Report Options</h5>
                        <p class="text-sm mb-0">Configure the report parameters</p>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form method="POST" action="{{ route('reports.generate') }}" id="report-form">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger text-white" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="report_type" class="ms-0">Report Type</label>
                                        <select class="form-control" id="report_type" name="report_type" required>
                                            <option value="all">All Tenants</option>
                                            <option value="pending">Pending Tenants</option>
                                            <option value="approved">Approved Tenants</option>
                                            <option value="rejected">Rejected Tenants</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="date_from">From Date (Optional)</label>
                                        <input type="date" class="form-control" id="date_from" name="date_from">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="date_to">To Date (Optional)</label>
                                        <input type="date" class="form-control" id="date_to" name="date_to">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card bg-gradient-light">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <h5 class="mb-0 text-dark font-weight-bold">PDF Report Preview</h5>
                                                        <p class="text-sm mb-0 text-dark">
                                                            The report will include tenant details such as name, email, domain, status, contact information, and registration date.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                        <i class="material-symbols-rounded opacity-10 text-white">picture_as_pdf</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn bg-gradient-primary">
                                    <i class="material-symbols-rounded me-1">download</i>
                                    Generate PDF Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Date validation
        const dateFrom = document.getElementById('date_from');
        const dateTo = document.getElementById('date_to');
        
        dateTo.addEventListener('change', function() {
            if (dateFrom.value && dateTo.value && new Date(dateTo.value) < new Date(dateFrom.value)) {
                alert('To Date must be after From Date');
                dateTo.value = '';
            }
        });
        
        dateFrom.addEventListener('change', function() {
            if (dateFrom.value && dateTo.value && new Date(dateTo.value) < new Date(dateFrom.value)) {
                dateTo.value = '';
            }
        });
    });
</script>
@endsection 
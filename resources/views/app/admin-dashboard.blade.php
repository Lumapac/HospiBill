@extends('app.layouts.sidebar')
@section('title', 'Admin Dashboard')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('layouts.navbar', ['title' => 'Admin Dashboard'])
        
        <div class="container-fluid py-4">         
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">personal_injury</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Patients</p>
                                <h4 class="mb-0">{{ $totalPatients }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Registered patients in the system</p>
                                <i class="material-symbols-rounded text-success ms-auto">arrow_upward</i>
                                <span class="text-success text-sm font-weight-bolder">+3%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">medical_services</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Services</p>
                                <h4 class="mb-0">{{ $totalServices }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">Available medical services</p>
                                <i class="material-symbols-rounded text-info ms-auto">inventory_2</i>
                                <span class="text-info text-sm font-weight-bolder">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-symbols-rounded opacity-10">people</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Users</p>
                                <h4 class="mb-0">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex">
                                <p class="mb-0 text-sm">System users across all roles</p>
                                <i class="material-symbols-rounded text-primary ms-auto">person_add</i>
                                <span class="text-primary text-sm font-weight-bolder">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Recent Patients Table -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Recent Patients</h6>
                                <a href="{{ route('patient.index') }}" class="btn btn-link text-dark px-3 mb-0">
                                    <i class="material-symbols-rounded text-sm me-1">visibility</i>View All
                                </a>
                            </div>
                            <p class="text-sm mb-0 text-muted">Recently registered patients</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Patient</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Service</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date</th>
                                            <th 
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentPatients as $patient)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="avatar avatar-sm me-3 bg-gradient-success rounded-circle">
                                                            <span class="text-white text-uppercase">{{ substr($patient->first_name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $patient->first_name }}
                                                                {{ $patient->last_name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $patient->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gradient-info">
                                                        {{ $patient->service ? $patient->service->name : 'No service' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $patient->created_at->format('M d, Y') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('patient.show', $patient->id) }}"
                                                        class="btn btn-link text-dark px-3 mb-0">
                                                        <i class="material-symbols-rounded text-sm me-1">visibility</i>View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Statistics Table -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Service Statistics</h6>
                                <a href="{{ route('services.index') }}" class="btn btn-link text-dark px-3 mb-0">
                                    <i class="material-symbols-rounded text-sm me-1">visibility</i>View All
                                </a>
                            </div>
                            <p class="text-sm mb-0 text-muted">Patient distribution by service</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Service</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Patient Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($serviceStats as $service)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="icon icon-sm icon-shape shadow text-center border-radius-md me-2 d-flex align-items-center justify-content-center">
                                                            <i class="material-symbols-rounded opacity-10 text-primary">medical_services</i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $service->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $service->category }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="me-2 text-sm font-weight-bold">{{ $service->patients_count }}</span>
                                                        <div>
                                                            <div class="progress" style="width: 100px; height: 5px;">
                                                                <div class="progress-bar bg-gradient-info" role="progressbar"
                                                                    aria-valuenow="{{ $service->patients_count }}"
                                                                    aria-valuemin="0"
                                                                    style="width: {{ min(100, $service->patients_count * 5) }}%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart JS scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx1 = document.getElementById("service-distribution-chart").getContext("2d");
            var ctx2 = document.getElementById("patient-activity-chart").getContext("2d");
            
            // Service Distribution Chart (Pie Chart)
            var serviceDistributionChart = new Chart(ctx1, {
                type: "doughnut",
                data: {
                    labels: [@foreach($serviceStats as $service) "{{ $service->name }}", @endforeach],
                    datasets: [{
                        label: "Patients",
                        backgroundColor: [
                            "#43A047", "#26A69A", "#29B6F6", "#5C6BC0", "#EC407A", "#AB47BC", "#EF5350"
                        ],
                        data: [@foreach($serviceStats as $service) {{ $service->patients_count }}, @endforeach]
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                        }
                    },
                    cutout: '70%'
                }
            });
            
            // Patient Activity Chart (Bar Chart)
            var patientActivityChart = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                        label: "New Patients",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#43A047",
                        data: [50, 40, 30, 45, 65, 35],
                        maxBarThickness: 10,
                    }, {
                        label: "Returning Patients",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#2196F3",
                        data: [30, 20, 40, 30, 20, 45],
                        maxBarThickness: 10,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 10,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#9e9e9e"
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#9e9e9e',
                                padding: 10,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
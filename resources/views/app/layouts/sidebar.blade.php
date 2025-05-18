<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        {{ tenant() ? tenant()->name : config('app.name') }}
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
    
    <!-- Custom CSS for premium features indicators -->
    <style>
        .nav-item {
            position: relative;
        }
        
        .premium-badge {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ffc107, #fd7e14);
            border: 1.5px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 2;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover .premium-badge {
            transform: translateY(-50%) scale(1.1);
        }
        
        .premium-badge i {
            font-size: 10px !important;
            line-height: 1;
            color: #fff;
        }
        
        .premium-feature {
            position: relative;
            overflow: hidden;
        }
        
        .premium-feature::after {
            content: 'Premium';
            position: absolute;
            top: 0.25rem;
            right: -1.5rem;
            transform: rotate(45deg);
            padding: 0.15rem 1.5rem;
            background: linear-gradient(45deg, #ffc107, #fd7e14);
            color: white;
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 1;
            pointer-events: none;
        }
        
        .tooltip.premium-tooltip .tooltip-inner {
            background-color: #fd7e14;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .tooltip.premium-tooltip .tooltip-arrow::before {
            border-top-color: #fd7e14;
        }
        
        #premium-feature-alert {
            border-left: 4px solid #ffc107;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <div class="navbar-brand m-0 p-3 d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="32" height="32"
                            alt="main_logo">
                        <span class="ms-2 font-weight-bold text-dark">{{ tenant() ? tenant()->name : config('app.name') }}</span>
                    </div>
                    <p class="text-xs text-secondary mb-0 mt-1">{{ tenant() ? tenant()->name : config('app.name') }} Management System</p>
                </div>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('dashboard') }}">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-5">dashboard</i>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </div>
                    </a>
                </li>

                @role('admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{route('users.index')}}">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-5">table_view</i>
                            <span class="nav-link-text ms-1">Users</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{route('services.index')}}">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-5">receipt_long</i>
                            <span class="nav-link-text ms-1">Services</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex {{ request()->routeIs('tenant.reports.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" 
                       href="{{ route('tenant.reports.index') }}"
                       @if(tenant() && tenant()->subscription !== 'premium') 
                       data-bs-toggle="tooltip" 
                       data-bs-placement="right" 
                       data-bs-custom-class="premium-tooltip" 
                       title="Premium feature - Generate financial and operational reports" 
                       @endif>
                        <div class="d-flex align-items-center flex-grow-1">
                            <i class="material-symbols-rounded opacity-5">summarize</i>
                            <span class="nav-link-text ms-1">Reports</span>
                        </div>
                        @if(tenant() && tenant()->subscription !== 'premium')
                        <span class="premium-badge d-flex align-items-center justify-content-center">
                            <i class="material-symbols-rounded">crown</i>
                        </span>
                        @endif
                    </a>
                </li>
                @endrole

                @role('doctor')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('patient.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{  route('patient.index') }}">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-5">personal_injury</i>
                            <span class="nav-link-text ms-1">Patients</span>
                        </div>
                    </a>
                </li>
                @endrole

                @role('cashier')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('patient.bill') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('patient.bill') }}">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-5">receipt</i>
                            <span class="nav-link-text ms-1">Billing</span>
                        </div>
                    </a>
                </li>
                @endrole

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('profile.edit') }}">
                        <div class="d-flex align-items-center">
                            <i class="material-symbols-rounded opacity-5">person</i>
                            <span class="nav-link-text ms-1">Profile</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                        @csrf
                        <a class="nav-link text-dark" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                            <div class="d-flex align-items-center">
                                <i class="material-symbols-rounded opacity-5">logout</i>
                                <span class="nav-link-text ms-1">Logout</span>
                            </div>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </aside>
    @yield('content')
    
    <div class="fixed-plugin">
        @if(tenant() && tenant()->subscription === 'free')
        <!-- Show disabled UI configurator button with premium badge for free subscription users -->
        <a class="fixed-plugin-button text-secondary position-fixed px-3 py-2" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="premium-tooltip" title="Available in premium plans">
            <div class="premium-badge">
                <i class="material-symbols-rounded">crown</i>
            </div>
            <i class="material-symbols-rounded py-2">settings</i>
        </a>
        @else
        <!-- Regular UI configurator button for non-free subscription users -->
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-symbols-rounded py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Page UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-symbols-rounded">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark active" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark"
                        onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2  active ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
            </div>
        </div>
        @endif
    </div>
    
    <!--   Core JS Files   -->
    <script src={{ asset("../assets/js/core/popper.min.js") }}></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
    
    <!-- Make sure Bootstrap JS is properly loaded -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Initialize tooltips and handle free subscription limitations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check and apply saved theme preference (dark/light mode)
            const darkModeCheckbox = document.getElementById('dark-version');
            if (darkModeCheckbox) {
                // Apply saved theme on page load
                const savedTheme = localStorage.getItem('darkMode');
                if (savedTheme === 'dark') {
                    document.body.classList.add('dark-version');
                    darkModeCheckbox.checked = true;
                    
                    // Apply dark theme to sidebar and navbar
                    const sidenavMain = document.getElementById('sidenav-main');
                    if (sidenavMain) {
                        sidenavMain.classList.remove('bg-white');
                        sidenavMain.classList.add('bg-dark');
                    }
                    
                    // Update premium badges for dark mode
                    const premiumBadges = document.querySelectorAll('.premium-badge');
                    premiumBadges.forEach(badge => {
                        badge.style.borderColor = '#344767';
                    });
                }
                
                // Save preference when user changes theme
                darkModeCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        localStorage.setItem('darkMode', 'dark');
                        
                        // Update premium badges for dark mode
                        const premiumBadges = document.querySelectorAll('.premium-badge');
                        premiumBadges.forEach(badge => {
                            badge.style.borderColor = '#344767';
                        });
                    } else {
                        localStorage.setItem('darkMode', 'light');
                        
                        // Update premium badges for light mode
                        const premiumBadges = document.querySelectorAll('.premium-badge');
                        premiumBadges.forEach(badge => {
                            badge.style.borderColor = 'white';
                        });
                    }
                });
            }
            
            // Initialize tooltips with better styling
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    delay: { show: 300, hide: 100 },
                    html: true
                });
            });
            
            // Handle UI configurator for free subscription
            @if(tenant() && tenant()->subscription === 'free')
            var freeSubConfigButtons = document.querySelectorAll('.fixed-plugin-button');
            freeSubConfigButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Show existing tooltip if any
                    var tooltip = bootstrap.Tooltip.getInstance(button);
                    if (tooltip) {
                        tooltip.show();
                    }
                    
                    // Show subscription upgrade message
                    if (!document.getElementById('premium-feature-alert')) {
                        var alertHtml = '<div class="alert alert-warning alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert" id="premium-feature-alert">' +
                            '<span class="alert-icon me-2"><i class="material-symbols-rounded opacity-10">crown</i></span>' +
                            '<div>' +
                            '<strong>Premium Feature</strong><br>' +
                            '<span class="text-sm">UI Customization is available in Standard and Premium plans</span>' +
                            '</div>' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>';
                        
                        var alertContainer = document.createElement('div');
                        alertContainer.className = 'position-fixed top-0 end-0 p-3';
                        alertContainer.style.zIndex = '1080';
                        alertContainer.innerHTML = alertHtml;
                        document.body.appendChild(alertContainer);
                        
                        // Add animation
                        setTimeout(function() {
                            var alert = document.querySelector('#premium-feature-alert');
                            if (alert) {
                                alert.classList.add('animate__animated', 'animate__fadeInRight');
                            }
                        }, 10);
                        
                        // Automatically remove after 5 seconds
                        setTimeout(function() {
                            var alert = document.querySelector('#premium-feature-alert');
                            if (alert) {
                                alert.classList.add('animate__fadeOutRight');
                                setTimeout(function() {
                                    alertContainer.remove();
                                }, 500);
                            }
                        }, 5000);
                    }
                });
            });
            @endif
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        HospiBill - @yield('title')
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
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <div class="navbar-brand m-0 p-3 d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="32" height="32"
                            alt="main_logo">
                        <span class="ms-2 font-weight-bold text-dark">HospiBill</span>
                    </div>
                    <p class="text-xs text-secondary mb-0 mt-1">Tenant Management System</p>
                </div>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('dashboard') }}">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tenants.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('tenants.index') }}">
                        <i class="material-symbols-rounded opacity-5">business</i>
                        <span class="nav-link-text ms-1">Tenants</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reports.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('reports.index') }}">
                        <i class="material-symbols-rounded opacity-5">description</i>
                        <span class="nav-link-text ms-1">Reports</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('profile.edit') }}">
                        <i class="material-symbols-rounded opacity-5">person</i>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                        @csrf
                        <a class="nav-link text-dark" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                            <i class="material-symbols-rounded opacity-5">logout</i>
                            <span class="nav-link-text ms-1">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </aside>
    @yield('content')
    <div class="fixed-plugin">
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
    </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Views",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#43A047",
                    data: [50, 45, 22, 28, 50, 60, 76],
                    barThickness: 'flex'
                },],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                            color: "#737373"
                        },
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
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
                datasets: [{
                    label: "Sales",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: "#43A047",
                    pointBorderColor: "transparent",
                    borderColor: "#43A047",
                    backgroundColor: "transparent",
                    fill: true,
                    data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            title: function (context) {
                                const fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                return fullMonths[context[0].dataIndex];
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 12,
                                lineHeight: 2
                            },
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
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 12,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Tasks",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: "#43A047",
                    pointBorderColor: "transparent",
                    borderColor: "#43A047",
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#737373',
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
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
    
    <script>
        // Check for saved theme preference or respect OS preference
        document.addEventListener("DOMContentLoaded", function() {
            const darkModeSetting = localStorage.getItem('darkMode');
            const darkModeToggle = document.getElementById('dark-version');
            
            // Apply dark mode if previously saved or if OS preference is dark
            if (darkModeSetting === 'enabled' || (darkModeSetting === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.body.classList.add('dark-version');
                if (darkModeToggle) darkModeToggle.checked = true;
            }
            
            // Apply saved sidenav type preference
            const sidenavTypeSetting = localStorage.getItem('sidenavType');
            const sidenav = document.querySelector('.sidenav');
            
            if (sidenavTypeSetting) {
                // Remove all potential classes first
                sidenav.classList.remove('bg-white', 'bg-transparent', 'bg-gradient-dark');
                
                // Add the saved class
                sidenav.classList.add(sidenavTypeSetting);
                
                // Update the buttons to show the correct active state
                const sidenavButtons = document.querySelectorAll('[data-class]');
                sidenavButtons.forEach(button => {
                    button.classList.remove('active');
                    if (button.getAttribute('data-class') === sidenavTypeSetting) {
                        button.classList.add('active');
                    }
                });
            }
        });
        
        // Override the default darkMode function from material-dashboard.js
        function darkMode(el) {
            const body = document.getElementsByTagName('body')[0];
            const hr = document.querySelectorAll('div:not(.sidenav) > hr');
            const sidebar = document.querySelector('.sidenav');
            const sidebarWhite = document.querySelectorAll('.sidenav.bg-white');
            const hr_card = document.querySelectorAll('div:not(.bg-gradient-dark) hr');
            const text_btn = document.querySelectorAll('button:not(.btn) > .text-dark');
            const text_span = document.querySelectorAll('span.text-dark, .breadcrumb .text-dark');
            const text_span_white = document.querySelectorAll('span.text-white');
            const text_strong = document.querySelectorAll('strong.text-dark');
            const text_strong_white = document.querySelectorAll('strong.text-white');
            const text_nav_link = document.querySelectorAll('a.nav-link.text-dark');
            const secondary = document.querySelectorAll('.text-secondary');
            const bg_gray_100 = document.querySelectorAll('.bg-gray-100');
            const bg_gray_600 = document.querySelectorAll('.bg-gray-600');
            const btn_text_dark = document.querySelectorAll('.btn.btn-link.text-dark, .btn .ni.text-dark');
            const btn_text_white = document.querySelectorAll('.btn.btn-link.text-white, .btn .ni.text-white');
            const card_border = document.querySelectorAll('.card.border');
            const card_border_dark = document.querySelectorAll('.card.border.border-dark');
            const svg = document.querySelectorAll('g');
            const navbarBrand = document.querySelector('.navbar-brand-img');
            const navbarBrandImg = navbarBrand.src;
            const navLinks = document.querySelectorAll('.navbar-main .nav-link, .navbar-main .breadcrumb-item, .navbar-main .breadcrumb-item a, .navbar-main h6');
            const cardNavLinksIcons = document.querySelectorAll('.card .nav .nav-link i');
            const cardNavSpan = document.querySelectorAll('.card .nav .nav-link span');
            
            if (!el.checked) {
                body.classList.remove('dark-version');
                localStorage.setItem('darkMode', 'disabled');
                
                // Rest of your original code for light mode
                for (var i = 0; i < hr.length; i++) {
                    if (hr[i].classList.contains('light')) {
                        hr[i].classList.add('dark');
                        hr[i].classList.remove('light');
                    }
                }
                
                for (var i = 0; i < hr_card.length; i++) {
                    if (hr_card[i].classList.contains('light')) {
                        hr_card[i].classList.add('dark');
                        hr_card[i].classList.remove('light');
                    }
                }
                
                for (var i = 0; i < text_btn.length; i++) {
                    if (text_btn[i].classList.contains('text-white')) {
                        text_btn[i].classList.remove('text-white');
                        text_btn[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < text_span.length; i++) {
                    if (text_span[i].classList.contains('text-white')) {
                        text_span[i].classList.remove('text-white');
                        text_span[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < text_strong.length; i++) {
                    if (text_strong[i].classList.contains('text-white')) {
                        text_strong[i].classList.remove('text-white');
                        text_strong[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < text_nav_link.length; i++) {
                    if (text_nav_link[i].classList.contains('text-white')) {
                        text_nav_link[i].classList.remove('text-white');
                        text_nav_link[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < secondary.length; i++) {
                    if (secondary[i].classList.contains('text-white')) {
                        secondary[i].classList.remove('text-white');
                        secondary[i].classList.add('text-secondary');
                    }
                }
                
                for (var i = 0; i < bg_gray_100.length; i++) {
                    if (bg_gray_100[i].classList.contains('bg-gray-600')) {
                        bg_gray_100[i].classList.remove('bg-gray-600');
                        bg_gray_100[i].classList.add('bg-gray-100');
                    }
                }
                
                for (var i = 0; i < btn_text_dark.length; i++) {
                    if (btn_text_dark[i].classList.contains('text-white')) {
                        btn_text_dark[i].classList.remove('text-white');
                        btn_text_dark[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < sidebarWhite.length; i++) {
                    if (sidebarWhite[i].classList.contains('bg-dark')) {
                        sidebarWhite[i].classList.remove('bg-dark');
                        sidebarWhite[i].classList.add('bg-white');
                    }
                }
                
                for (var i = 0; i < card_border.length; i++) {
                    if (card_border[i].classList.contains('border-dark')) {
                        card_border[i].classList.remove('border-dark');
                        card_border[i].classList.add('border');
                    }
                }
                
                if (navbarBrandImg.includes('logo-ct-dark.png')) {
                    var new_src = navbarBrandImg.replace("logo-ct-dark", "logo-ct");
                    navbarBrand.src = new_src;
                }
                
                for (var i = 0; i < navLinks.length; i++) {
                    if (navLinks[i].classList.contains('text-white')) {
                        navLinks[i].classList.remove('text-white');
                        navLinks[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < cardNavLinksIcons.length; i++) {
                    if (cardNavLinksIcons[i].classList.contains('text-white')) {
                        cardNavLinksIcons[i].classList.remove('text-white');
                        cardNavLinksIcons[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < cardNavSpan.length; i++) {
                    if (cardNavSpan[i].classList.contains('text-white')) {
                        cardNavSpan[i].classList.remove('text-white');
                        cardNavSpan[i].classList.add('text-dark');
                    }
                }
                
                for (var i = 0; i < svg.length; i++) {
                    if (svg[i].hasAttribute('fill')) {
                        svg[i].setAttribute('fill', '#252f40');
                    }
                }
                
                if (svg.length) {
                    svg.forEach(function(item, index) {
                        if (item.hasAttribute('stroke')) {
                            item.setAttribute('stroke', '#252f40');
                        }
                    })
                }
            } else {
                body.classList.add('dark-version');
                localStorage.setItem('darkMode', 'enabled');
                
                // Rest of your original code for dark mode
                for (var i = 0; i < hr.length; i++) {
                    if (hr[i].classList.contains('dark')) {
                        hr[i].classList.remove('dark');
                        hr[i].classList.add('light');
                    }
                }
                
                for (var i = 0; i < hr_card.length; i++) {
                    if (hr_card[i].classList.contains('dark')) {
                        hr_card[i].classList.remove('dark');
                        hr_card[i].classList.add('light');
                    }
                }
                
                for (var i = 0; i < text_btn.length; i++) {
                    if (text_btn[i].classList.contains('text-dark')) {
                        text_btn[i].classList.remove('text-dark');
                        text_btn[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < text_span.length; i++) {
                    if (text_span[i].classList.contains('text-dark')) {
                        text_span[i].classList.remove('text-dark');
                        text_span[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < text_strong.length; i++) {
                    if (text_strong[i].classList.contains('text-dark')) {
                        text_strong[i].classList.remove('text-dark');
                        text_strong[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < text_nav_link.length; i++) {
                    if (text_nav_link[i].classList.contains('text-dark')) {
                        text_nav_link[i].classList.remove('text-dark');
                        text_nav_link[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < secondary.length; i++) {
                    if (secondary[i].classList.contains('text-secondary')) {
                        secondary[i].classList.remove('text-secondary');
                        secondary[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < bg_gray_100.length; i++) {
                    if (bg_gray_100[i].classList.contains('bg-gray-100')) {
                        bg_gray_100[i].classList.remove('bg-gray-100');
                        bg_gray_100[i].classList.add('bg-gray-600');
                    }
                }
                
                for (var i = 0; i < btn_text_dark.length; i++) {
                    btn_text_dark[i].classList.remove('text-dark');
                    btn_text_dark[i].classList.add('text-white');
                }
                
                for (var i = 0; i < sidebarWhite.length; i++) {
                    sidebarWhite[i].classList.remove('bg-white');
                    sidebarWhite[i].classList.add('bg-dark');
                }
                
                for (var i = 0; i < card_border.length; i++) {
                    card_border[i].classList.add('border-dark');
                }
                
                if (navbarBrandImg.includes('logo-ct.png')) {
                    var new_src = navbarBrandImg.replace("logo-ct", "logo-ct-dark");
                    navbarBrand.src = new_src;
                }
                
                for (var i = 0; i < navLinks.length; i++) {
                    if (navLinks[i].classList.contains('text-dark')) {
                        navLinks[i].classList.remove('text-dark');
                        navLinks[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < cardNavLinksIcons.length; i++) {
                    if (cardNavLinksIcons[i].classList.contains('text-dark')) {
                        cardNavLinksIcons[i].classList.remove('text-dark');
                        cardNavLinksIcons[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < cardNavSpan.length; i++) {
                    if (cardNavSpan[i].classList.contains('text-dark')) {
                        cardNavSpan[i].classList.remove('text-dark');
                        cardNavSpan[i].classList.add('text-white');
                    }
                }
                
                for (var i = 0; i < svg.length; i++) {
                    if (svg[i].hasAttribute('fill')) {
                        svg[i].setAttribute('fill', '#fff');
                    }
                }
                
                if (svg.length) {
                    svg.forEach(function(item, index) {
                        if (item.hasAttribute('stroke')) {
                            item.setAttribute('stroke', '#fff');
                        }
                    })
                }
            }
        }

        // Override the default sidebarType function to save preference
        function sidebarType(el) {
            const parent = el.parentElement.children;
            const sidenavType = el.getAttribute("data-class");
            const body = document.querySelector("body");
            const bodyWhite = document.querySelector("body:not(.dark-version)");
            const bodyDark = document.querySelector("body.dark-version");
            
            // Save preference to localStorage
            localStorage.setItem('sidenavType', sidenavType);

            // Remove active class from all buttons
            for (let i = 0; i < parent.length; i++) {
                parent[i].classList.remove('active');
            }
            
            // Add active class to clicked button
            el.classList.add('active');

            // Remove all sidenav types
            const sidenav = document.querySelector('.sidenav');
            sidenav.classList.remove('bg-transparent');
            sidenav.classList.remove('bg-white');
            sidenav.classList.remove('bg-gradient-dark');

            // Apply the sidenav type
            sidenav.classList.add(sidenavType);
            
            // Adjust text color based on sidenav type and theme mode
            if (sidenavType === 'bg-transparent' && bodyDark) {
                sidenav.classList.add('text-white');
            } else if (sidenavType === 'bg-transparent' && bodyWhite) {
                sidenav.classList.add('text-dark');
            } else if (sidenavType === 'bg-white' && bodyDark) {
                sidenav.classList.remove('text-dark');
            } else if (sidenavType === 'bg-gradient-dark') {
                sidenav.classList.add('text-white');
            }
        }
    </script>
</body>

</html>
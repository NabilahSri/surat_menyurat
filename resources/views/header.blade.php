<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="/dashboard" class="navbar-brand">

            <!--Logo start-->
            <div class="logo-main">
                <div class="logo-normal">
                    <img width="40%" src="https://web.smk-ypc.sch.id/wp-content/uploads/2022/02/Logo-we.png"
                        alt="">
                </div>
                <div class="logo-mini">
                    <img width="40%" src="https://web.smk-ypc.sch.id/wp-content/uploads/2022/02/Logo-we.png"
                        alt="">
                </div>
            </div>
            <!--logo End-->
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
            </i>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="mt-2 navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="User-Profile"
                            class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                        <div class="caption ms-3 d-none d-md-block ">
                            <h6 class="mb-0 caption-title">{{ Auth()->user()->name }}</h6>
                            <p class="mb-0 caption-sub-title text-end">{{ auth()->user()->unitkerja->nama_unit_kerja }}
                            </p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="/profile">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.2124 7.76241C14.2124 10.4062 12.0489 12.5248 9.34933 12.5248C6.6507 12.5248 4.48631 10.4062 4.48631 7.76241C4.48631 5.11865 6.6507 3 9.34933 3C12.0489 3 14.2124 5.11865 14.2124 7.76241ZM2 17.9174C2 15.47 5.38553 14.8577 9.34933 14.8577C13.3347 14.8577 16.6987 15.4911 16.6987 17.9404C16.6987 20.3877 13.3131 21 9.34933 21C5.364 21 2 20.3666 2 17.9174ZM16.1734 7.84875C16.1734 9.19506 15.7605 10.4513 15.0364 11.4948C14.9611 11.6021 15.0276 11.7468 15.1587 11.7698C15.3407 11.7995 15.5276 11.8177 15.7184 11.8216C17.6167 11.8704 19.3202 10.6736 19.7908 8.87118C20.4885 6.19676 18.4415 3.79543 15.8339 3.79543C15.5511 3.79543 15.2801 3.82418 15.0159 3.87688C14.9797 3.88454 14.9405 3.90179 14.921 3.93246C14.8955 3.97174 14.9141 4.02253 14.9396 4.05607C15.7233 5.13216 16.1734 6.44206 16.1734 7.84875ZM19.3173 13.7023C20.5932 13.9466 21.4317 14.444 21.7791 15.1694C22.0736 15.7635 22.0736 16.4534 21.7791 17.0475C21.2478 18.1705 19.5335 18.5318 18.8672 18.6247C18.7292 18.6439 18.6186 18.5289 18.6333 18.3928C18.9738 15.2805 16.2664 13.8048 15.5658 13.4656C15.5364 13.4493 15.5296 13.4263 15.5325 13.411C15.5345 13.4014 15.5472 13.3861 15.5697 13.3832C17.0854 13.3545 18.7155 13.5586 19.3173 13.7023Z"
                                        fill="currentColor"></path>
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="confirmLogout()">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.89535 11.23C9.45785 11.23 9.11192 11.57 9.11192 12C9.11192 12.42 9.45785 12.77 9.89535 12.77H16V17.55C16 20 13.9753 22 11.4724 22H6.51744C4.02471 22 2 20.01 2 17.56V6.45C2 3.99 4.03488 2 6.52762 2H11.4927C13.9753 2 16 3.99 16 6.44V11.23H9.89535ZM19.6302 8.5402L22.5502 11.4502C22.7002 11.6002 22.7802 11.7902 22.7802 12.0002C22.7802 12.2002 22.7002 12.4002 22.5502 12.5402L19.6302 15.4502C19.4802 15.6002 19.2802 15.6802 19.0902 15.6802C18.8902 15.6802 18.6902 15.6002 18.5402 15.4502C18.2402 15.1502 18.2402 14.6602 18.5402 14.3602L20.1402 12.7702H16.0002V11.2302H20.1402L18.5402 9.6402C18.2402 9.3402 18.2402 8.8502 18.5402 8.5502C18.8402 8.2402 19.3302 8.2402 19.6302 8.5402Z"
                                        fill="currentColor"></path>
                                </svg>
                                Logout
                            </a>
                        </li>
                        <script>
                            function confirmLogout() {
                                var isLogoutConfirmed = confirm("Are you sure you want to logout?");
                                if (isLogoutConfirmed) {
                                    // Redirect to the logout URL or perform logout action
                                    window.location.href = "/logout/{{ Auth()->user()->id }}";
                                }
                            }
                        </script>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

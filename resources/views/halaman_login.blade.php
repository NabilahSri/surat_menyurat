<!doctype html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Halaman Login | SMK YPC TASIKMALAYA</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="../../assets/images/ypc-removebg-preview.png">

        <!-- Library / Plugin Css Build -->
        <link rel="stylesheet" href="../../assets/css/core/libs.min.css">


        <!-- Hope Ui Design System Css -->
        <link rel="stylesheet" href="../../assets/css/hope-ui.min.css?v=4.0.0">

        <!-- Custom Css -->
        <link rel="stylesheet" href="../../assets/css/custom.min.css?v=4.0.0">

        <!-- Dark Css -->
        <link rel="stylesheet" href="../../assets/css/dark.min.css">

        <!-- Customizer Css -->
        <link rel="stylesheet" href="../../assets/css/customizer.min.css">

        <!-- RTL Css -->
        <link rel="stylesheet" href="../../assets/css/rtl.min.css">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('loginError'))
                    // Display alert for failed login attempts
                    alert("{{ session('loginError') }}");
                @endif
            });
        </script>

    </head>

    <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
        <!-- loader Start -->
        <div id="loading">
            @if (session('loginError'))
            @else
                <div class="loader simple-loader">
                    <div class="loader-body">
                    </div>
                </div>
            @endif
        </div>
        <!-- loader END -->

        <div class="wrapper">
            <section class="login-content">
                <div class="row m-0 align-items-center bg-white">
                    <div class="col-md-6">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div
                                    class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                    <div class="card-body">
                                        <a href="https://web.smk-ypc.sch.id/" target="_blank" class="navbar-brand mb-3">
                                            <!--Logo start-->
                                            <div class="logo-main">
                                                <div class="logo-normal">
                                                    <img src="https://web.smk-ypc.sch.id/wp-content/uploads/2022/07/YPC-250-no-border.png"
                                                        alt="" style="width: 15%">
                                                </div>
                                                <div class="logo-mini">
                                                    <img src="https://web.smk-ypc.sch.id/wp-content/uploads/2022/07/YPC-250-no-border.png"
                                                        alt="" style="width: 15%">
                                                </div>
                                            </div>
                                            <!--logo End-->
                                        </a>
                                        <h2 class="mb-2 text-center">Login</h2>
                                        <p class="text-center">Selamat Datang di Aplikasi Surat Menyurat SMK YPC
                                            Tasikmalaya</p>
                                        <form action="/actionlogin" method="POST">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" aria-describedby="username" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" aria-describedby="password" placeholder=" ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center mt-3">
                                                <button type="submit" class="btn btn-primary"
                                                    style="width: 100%">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                        <img src="../../assets/images/auth/01.png" class="img-fluid gradient-main animated-scaleX"
                            alt="images">
                    </div>
                </div>
            </section>
        </div>

        <!-- Library Bundle Script -->
        <script src="../../assets/js/core/libs.min.js"></script>

        <!-- External Library Bundle Script -->
        <script src="../../assets/js/core/external.min.js"></script>

        <!-- Widgetchart Script -->
        <script src="../../assets/js/charts/widgetcharts.js"></script>

        <!-- mapchart Script -->
        <script src="../../assets/js/charts/vectore-chart.js"></script>
        <script src="../../assets/js/charts/dashboard.js"></script>

        <!-- fslightbox Script -->
        <script src="../../assets/js/plugins/fslightbox.js"></script>

        <!-- Settings Script -->
        <script src="../../assets/js/plugins/setting.js"></script>

        <!-- Slider-tab Script -->
        <script src="../../assets/js/plugins/slider-tabs.js"></script>

        <!-- Form Wizard Script -->
        <script src="../../assets/js/plugins/form-wizard.js"></script>

        <!-- AOS Animation Plugin-->

        <!-- App Script -->
        <script src="../../assets/js/hope-ui.js" defer></script>


    </body>

</html>

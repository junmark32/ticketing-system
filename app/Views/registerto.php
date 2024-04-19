<?= $this->include('include/header') ?>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Login Tab Content -->
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-6 col-lg-5 login-left">
                                    <img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Login">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Login <span>DWCC Events</span></h3>
                                    </div>
                                    <div>
                                        <h4>Register as:</h4>
                                        <div class="text-center">
                                            <a class="btn btn-primary btn-lg mb-3" href="<?php echo base_url('Student/Register'); ?>">Student</a><br>
                                            <a class="btn btn-primary btn-lg mb-3" href="<?php echo base_url('Alumni/Register'); ?>">Alumni</a><br>
                                            <a class="btn btn-primary btn-lg mb-3" href="<?php echo base_url('Outsider/Register'); ?>">Outsider</a><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Login Tab Content -->

                    </div>
                </div>

            </div>

        </div>
    
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

</body>

<!-- doccure/login.html  30 Nov 2019 04:12:20 GMT -->
</html>

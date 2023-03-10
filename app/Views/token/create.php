<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sofri Card Tokenization</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo str_replace('/index.php','',base_url()); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo str_replace('/index.php','',base_url()); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class=" col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <!-- <div class="row"> -->
                            <!-- <div class="col-lg-6"> -->
                                <div class="p-5">
                                    <div class="text-center">
                                        <!-- <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1> -->
                                        <img src="<?php echo str_replace('/index.php','',base_url()); ?>/img/Sofri-logo.png" alt="Sofri logo" width="200">
                                        <!-- <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1> -->
                                        <p>Use the button below to add a repayment instrument</P><br/>
                                    </div>
       
                                        <a href="<?= $paystack_url ?>" class="btn btn-primary btn-user btn-block">
                                            Continue
                                        </a>
                                </div>
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo str_replace('/index.php','',base_url()); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo str_replace('/index.php','',base_url()); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo str_replace('/index.php','',base_url()); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo str_replace('/index.php','',base_url()); ?>/js/sb-admin-2.min.js"></script>

</body>

</html>






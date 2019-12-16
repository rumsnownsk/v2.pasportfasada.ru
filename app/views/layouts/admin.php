<?php dump($_SESSION) ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin_ПаспортФасада</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Ionicons -->
    <link href="/css/admin/ionicons.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href="/css/admin/main-admin.css" rel="stylesheet" type="text/css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body>




<!-- Main Content -->
<!--<section id="wrapper">-->

    <!-- Main Header -->
    <header class="header">
        <?= $this->insert('inc/header-admin') ?>
<!--      <?php //$this->getPart('inc/header-admin') ?> -->
    </header>

    <div id="content">
        <!-- Left side column. contains the logo and sidebar -->
            <div class="sidebar">
                <?= $this->insert('inc/sidebar-admin', [
                        'auth' => $auth
                ]) ?>
            </div>

            <div class="dataContent">
                <?= $this->section('content') ?>
            </div>
    </div>

    <footer id="footer" class="footer">
        <!-- To the right -->
        <div>
            Anything you want
        </div>
        <!-- Default to the left -->
        <div class="footer__copyright">Copyright &copy; <?= date("Y") ?> <a href="#">Company</a>.</div>
        <div>
            All rights reserved.
        </div>
    </footer>

<!--</section>-->




<!-- Main Footer -->


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/js/admin/main-admin.js"></script>
<!-- Bootstrap 3.3.7 -->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"-->
<!--        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"-->
<!--        crossorigin="anonymous"></script>-->
<!-- AdminLTE App -->
<!--<script src="/js/admin/adminlte.min.js"></script>-->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
<?php dump($_SESSION) ?>

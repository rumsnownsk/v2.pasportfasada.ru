<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Вход в админку</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link href="/css/font-awesome.min.css" rel='stylesheet' type='text/css'/>


    <link rel="stylesheet" href="/css/auth/auth.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="loginPage">

<div class="loginBox">
    <div class="loginBox__logo">
        <p><b>Паспорт Фасада</b><br>Админка</p>
    </div>
    <!-- /.login-logo -->
    <div class="loginBox__body">
        <p class="loginBox__body__msg">Вход в админку</p>

        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'];
                unset($_SESSION['error']) ?>
            </div>
        <?php endif; ?>

        <form action="/auth" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="username">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <i class="fa fa-lock" aria-hidden="true"></i>

            </div>
            <!--            <div class="form-group form-check">-->
            <div class="form-group signIn">
                <div class="inputCheckbox">
                    <input name="remember" type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>

        </form>


        <!--        <a href="#">I forgot my password</a><br>-->
        <!--        <a href="register.html" class="text-center">Register a new membership</a>-->

    </div>
    <!-- /.login-box-body -->
</div>

<!-- jQuery 3 -->
<script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script><!-- iCheck -->

</body>
</html>
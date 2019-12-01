<?php //unset($_SESSION['error']) ?>

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

        <form action="/auth/login" method="post">
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
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $meta['description'] ?>">
    <meta name="keywords" content="<?= $meta['keywords'] ?>">

    <!-- Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
<!--          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">

    <title><?= $meta['title'] ?></title>
</head>
<body>
<div class="container">

    <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
        <?php if (!\app\models\User::isLogin()) : ?>
        <li class="nav-item"><a class="nav-link" href="/user/signup">Singup</a></li>
        <li class="nav-item"><a class="nav-link" href="/user/login">Login</a></li>
        <?php else : ?>
        <li class="nav-item"><a class="nav-link" href="/user/logout">Logout</a></li>
        <?php endif; ?>
    </ul>

    <h1>Heelloow, default</h1>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']) ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']) ?>
        </div>
    <?php endif; ?>

    <?php dump($_SESSION) ?>

    <?= $content ?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="/bootstrap/js/jquery-3.4.1.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"-->
<!--        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"-->
<!--        crossorigin="anonymous"></script>-->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!--<script src="/bootstrap/js/bootstrap.min.js"></script>-->
</body>
</html>
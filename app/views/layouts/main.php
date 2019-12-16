<!doctype html>
<html lang="RU-ru">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <!--    <link href="/css/jquery.mCustomScrollbar.css" rel='stylesheet' type='text/css' />-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link href="/css/font-awesome.min.css" rel='stylesheet' type='text/css'/>
    <link href="/css/magnific-popup.css" rel='stylesheet' type='text/css'/>
    <link href="/css/callbackme.css" rel='stylesheet' type='text/css'/>
    <link href="/css/main.css" rel='stylesheet' type='text/css'/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html"/>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?= $this->e($title) ?></title>

    <!----webfonts---->
    <link href='https://fonts.googleapis.com/css?family=Oswald:100,400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic' rel='stylesheet'
          type='text/css'>
    <!----//webfonts---->


</head>
<body>


<!---header---->
<header id="header" class="header">

    <div class="container">
        <div class="row">


            <?php if (isset($auth)) $this->insert('inc/adminButton', [
                'auth' => $auth
            ]) ?>
        </div>
        <div class="row bgColor pt25">

            <div class="col-lg-2">
                <a href="/">
                    <img src="/images/logo.png" class="logo" title="Паспорт фасада новосибирск"/>
                </a>
                <div id="menuShow">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="mainHeader">
                    <h1 class="">паспорт фасадов</h1>
                    <p>Разработка. Согласование. Получение&nbsp;документов</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="headerContact">
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i><span>Новосибирск</span></p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i><span>223-77-49</span></p>
                    <p><i class="fa fa-mobile" aria-hidden="true"></i><span>8-913-944-88-50</span></p>
                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <span>
                            <a href="mailto:pfnsk@list.ru?subject=У_меня_вопрос">pfnsk@list.ru</a>
                            </span>
                    </p>
                </div>
            </div>

        </div>
        <div class="row bgColor pt25">
            <div class="col-lg-12">
                <nav id="main-nav" class="main-nav">

                    <div id="classicMenu">
                        <ul class="menu">
                            <li class="menu__item"><a href="/">ГЛАВНАЯ</a></li>
                            <li class="menu__item menu-item-has-children">
                                <a href="/works" class="list_categories">ОБЪЕКТЫ</a>
                                <ul class="sub-menu">

                                    <?php foreach ($categories as $category) : ?>
                                        <li><a href="/works/<?= $category->id ?>"><?= $category->title ?></a></li>
                                    <?php endforeach; ?>

                                </ul>
                            </li>
                            <li class="menu__item"><a href="/thanks">БЛАГОДАРНОСТИ</a></li>
                            <li class="menu__item"><a href="/law">ЗАКОН</a></li>
                            <li class="menu__item"><a href="/contact">КОНТАКТЫ</a></li>
                            <li class="menu__item"><a href="/about">О&nbsp;НАС</a></li>
                            <li class="menu__item"><a href="/map">КАРТА</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
</header>
<!--/header-->
<section id="content" class="content">
    <div class="container h100">
        <div class="row bgColor ptContent">
            <div class="col-lg-9">
                <div class="content__block">

                    <div class="content__notice">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error'];
                                unset($_SESSION['error']) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success">
                                <?= $_SESSION['success'];
                                unset($_SESSION['success']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?= $this->section('content') ?>

                </div>
            </div>
            <div class="col-lg-3">
                <!--                <div id="currentTime"></div>-->

                <div class="recall">
                    <a href="#callback" class="popup-callbackme callbackme">Обратный звонок</a>
                </div>

                <div class="hidden">
                    <div class="mfp-container mfp-inline-holder">
                        <div class="mfp-content">
                            <form class="popup-form callback zoom-anim-dialog" id="callback">
                                <div class="success"><p><span class="sencs">Спасибо за заявку!</span><br>
                                        Наши менеджеры свяжутся с вами в ближайшее время</p>
                                </div>

                                <p class="zakaz">Обратный звонок</p>
                                <label>
                                    <!--                                    <span>Ваше имя:</span>-->
                                    <input type="text" name="name" placeholder="Введите ваше имя..."
                                           required="required">
                                </label>
                                <label>
                                    <!--                                    <span>Ваше телефон:</span>-->
                                    <input id="phone" type="text"
                                           name="phone" placeholder="Введите ваш телефон..."
                                           required="required">
                                </label>
                                <label class="label_code">
                                    <!--                                    <span>Код:</span>-->
                                    <input id="code" type="text"
                                           name="code" placeholder="Код с картинки..."
                                           required="required">
                                    <img src="" alt="">
                                </label>
                                <div class="button-center">
                                    <button class="button">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="include">

                    <?= $this->insert('inc/sidebar', [
                        'recentWorks' => $recentWorks
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="footer">
    <div class="container">
        <div class="row bgColor">

            <div class="col-lg-12">
                <p class="footer-content">Главный по тарелочкам с 2008 года | Громов Г.Ю.</p>
            </div>


        </div>
    </div>
</section>


<!---->

<!--script-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"-->
<!--        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"-->
<!--        crossorigin="anonymous"></script>-->
<script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>

<!---->
<!--<script type="text/javascript" src="/js/jquery.maskedinput.min.js"></script>-->

<!--<script src="/js/main.js"></script>-->

</body>
</html>



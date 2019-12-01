<p  class="sidebar__header">Привет!!</p>
<!-- Sidebar user panel (optional) -->
<div class="sidebar__user">
    <img src="<?= $auth->getImage() ?>" class="img-circle" alt="User Image">
    <p><?= $auth->fio ?></p>
</div>

<p  class="sidebar__header">навигация</p>
<ul class="sidebar__nav">
    <li>
        <a href="/admin"><i class="fa fa-folder-open-o" aria-hidden="true"></i> <span>Работы</span></a>
    </li>
    <li>
        <a href="/admin/thank"><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Благодарности</span></a>
    </li>
    <li>
        <a href="/admin/category"><i class="fa fa-tasks" aria-hidden="true"></i> <span>Категории</span></a>
    </li>

    <?php if ($auth->role <= 1) : ?>
    <li>
        <a href="/admin/user"><i class="fa fa-users" aria-hidden="true"></i> <span>Работники</span></a>
    </li>
    <?php endif; ?>

    <li>
        <br>
        <br>
    </li>
    <li>
        <a href="/"><i class="fa fa-reply" aria-hidden="true"></i> <span>Вернуться на сайт</span></a>
    </li>
    <li>
        <hr>
    </li>
    <li>
        <a href="/auth/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Выйти</span></a>
    </li>
</ul>
<!-- /.sidebar-menu -->
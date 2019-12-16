<?= $this->layout('layouts/admin', compact('title', 'auth')) ?>

<div class="listUsers flex-column">

    <div class="listUsers__header">
        <h2 class="box-title">Все пользователи</h2>
        <a href="/admin/user/create" class="btn btn-success btn-sm">Добавить</a>

    </div>
    <?= $msg->display(); ?>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 50px;">№</th>
            <th style="width: 100px;">Аватар</th>
            <th>Логин</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($users as $user) : ?>
            <tr class="admin-work_item">
                <td><?= $user->id ?></td>
                <td class="td__photo">
                    <div class="myHover" >
                        <img src="<?= $user->getImage() ?>" alt="">
                        <div class="getLarge">
                            <img src="<?= $user->getImage() ?>"
                                 class="getLarge__img" alt="">
                        </div>
                    </div>

                </td>
                <td><?= $user->username ?></td>
                <td><?= $user->fio ?> <br> <?= $user->phone ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->getRole() ?></td>
                <td class="indexTable">
                    <a href="/admin/user/<?=$user->id?>/edit" class="btn btn-warning btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a onclick="return confirm('Вы уверены?');" href="/admin/user/<?=$user->id?>/destroy" class="btn btn-danger btn-sm">
                        <i class="fa fa-close"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>

    </table>
</div>
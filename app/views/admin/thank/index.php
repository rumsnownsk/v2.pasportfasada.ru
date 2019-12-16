<?= $this->layout('layouts/admin', compact('title', 'auth')) ?>

<div class="listThanks flex-column">

    <div class="listWorks__header">
        <h2 class="box-title">Имеющиеся благодарности</h2>
        <a href="/admin/thank/create" class="btn btn-success btn-sm">Добавить</a>

    </div>
    <?= $msg->display(); ?>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 50px;">№</th>
            <th style="width: 100px;">Изображение</th>
            <th>Название</th>
            <th>Создано</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($thanks as $thank) : ?>
            <tr class="admin-work_item">
                <td><?= $thank->id ?></td>
                <td class="td__photo">
                    <div class="myHover">
                        <img src="<?= $thank->getImage() ?>" alt="">
                        <div class="getLarge">
                            <img src="<?= $thank->getImage() ?>"
                                 class="getLarge__img" alt="">
                        </div>
                    </div>

                </td>
                <td> <?= $thank->title ?> </td>
                <td> <?= $thank->created_at ?> </td>
                <td class="indexTable">
                    <a href="/admin/thank/<?= $thank->id ?>/edit" class="btn btn-warning btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a onclick="return confirm('Вы уверены?');" href="/admin/thank/<?= $thank->id ?>/destroy"
                       class="btn btn-danger btn-sm">
                        <i class="fa fa-close"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>

    </table>
</div>
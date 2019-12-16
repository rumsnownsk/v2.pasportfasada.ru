<?= $this->layout('layouts/admin', compact('title', 'auth')) ?>

<div class="listCategories flex-column">

    <div class="listCategories__header">
        <h2 class="box-title">Список категорий</h2>
        <a href="/admin/category/create" class="btn btn-success btn-sm">Добавить</a>
    </div>
    <?= $msg->display(); ?>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 50px;">№</th>
            <th>Название</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($categories as $category) : ?>
            <tr class="admin-work_item">
                <td><?= $category->id ?></td>
                <td> <?= $category->title ?> </td>
                <td class="indexTable">
                    <a href="/admin/category/<?= $category->id ?>/edit" class="btn btn-warning btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a onclick="return confirm('Вы уверены?');" href="/admin/category/<?= $category->id ?>/destroy"
                       class="btn btn-danger btn-sm">
                        <i class="fa fa-close"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>

    </table>
</div>
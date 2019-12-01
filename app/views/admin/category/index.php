<div class="listCategories flex-column">

    <div class="listCategories__header">
        <h2 class="box-title">Список категорий</h2>
        <a href="/admin/category/create" class="btn btn-success btn-sm">Добавить</a>

    </div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 50px;">№</th>
            <th>Название</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($cats as $cat) : ?>
            <tr class="admin-work_item">
                <td><?= $cat->id ?></td>
                <td> <?= $cat->title ?> </td>
                <td class="indexTable">
                    <a href="/admin/category/edit?id=<?= $cat->id ?>" class="btn btn-warning btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a onclick="return confirm('Вы уверены?');" href="/admin/category/destroy?id=<?= $cat->id ?>"
                       class="btn btn-danger btn-sm">
                        <i class="fa fa-close"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>

    </table>
</div>
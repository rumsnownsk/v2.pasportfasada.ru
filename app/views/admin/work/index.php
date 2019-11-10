<div class="listWorks flex-column">

    <div class="listWorks__header">
        <h2 class="box-title">Все выполненые работы</h2>
        <a href="/admin/work/create" class="btn btn-success btn-sm">Добавить</a>

    </div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Изображение</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Этап</th>
            <th>Публикация</th>
            <th>Завершено</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($works as $work) : ?>
            <tr class="admin-work_item">
                <td><?= $work->id ?></td>
                <td>
                    <img src="<?= $work->getImage() ?>" alt="">
                </td>
                <td>
                    <a href="#"><?= $work->title ?></a>
                </td>
                <td><?= $work->getCategoryTitle() ?></td>
                <td><?= $work->getStageTitle() ?></td>
                <td><?= $work->getPublishInfo() ?></td>
                <td><?= $work->getFinishDate() ?></td>
                <td class="indexTable">
                    <a href="#" class="btn btn-warning btn-sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>

<!--        <tfoot>-->
<!--        <tr>-->
<!--            <th></th>-->
<!--            <th>Изображение</th>-->
<!--            <th>Название</th>-->
<!--            <th>Категория</th>-->
<!--            <th>Этап</th>-->
<!--            <th>Публикация</th>-->
<!---->
<!--            <th>Завершено:</th>-->
<!---->
<!--            <th>Действия</th>-->
<!--        </tr>-->
<!--        </tfoot>-->

    </table>
</div>
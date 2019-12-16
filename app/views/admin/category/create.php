<?= $this->layout('layouts/admin', compact('title', 'auth')) ?>

<div class="crud">
    <h2>Добавить категорию</h2>

    <?= $msg->display('e'); ?>

    <form action="/admin/category/create" method="post">

        <div class="form-group">
            <div class="form-group__label">
                <label for="inputTitleCategory">Название</label>
            </div>
            <div class="form-group__data">
                <input name="title" id="inputTitleCategory" type="text" class="form-control" value="<?= oldInfo('title') ?>" title="">
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Добавить</button>
            <a href="/admin" class="btn btn-info" style="margin-left: 50px">На главную</a>
        </div>

    </form>
</div>



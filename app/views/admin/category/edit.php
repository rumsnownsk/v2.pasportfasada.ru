<?= $this->layout('layouts/admin', compact('title', 'auth')) ?>

<div class="crud">
    <h2>Редактирование категории № <?= $category->id ?></h2>

    <?= $msg->display('e'); ?>

    <form action="/admin/category/<?= $category->id?>/edit" method="post">


        <div class="form-group">
            <div class="form-group__label">
                <label for="inputTitleCategory">Название</label>
            </div>
            <div class="form-group__data">
                <input name="title" id="inputTitleCategory" type="text" class="form-control" value="<?= $category->title ?>" title="" >
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Редактировать</button>
            <a href="/admin/category" class="btn btn-info" style="margin-left: 50px">Все благодарности</a>
        </div>
    </form>
</div>



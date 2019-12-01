<div class="crud">
    <h2>Редактирование категории № <?= $category->id ?></h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'];
            unset($_SESSION['error']) ?>
        </div>
    <?php endif; ?>

    <form action="/admin/category/edit" method="post">

        <input type="hidden" name="id" value="<?= $category->id?>">

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
<!--    --><?php //unset($_SESSION['oldData']); ?>
</div>



<div class="crud">
    <h2>Редактирование объекта № <?= $work->id ?></h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'];
            unset($_SESSION['error']) ?>
        </div>
    <?php endif; ?>

    <form action="/admin/work/edit" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $work->id?>">
        <div class="form-group form-group__correct">
            <div class="form-group__label">
                <label for="inputFileWork">Фотография объекта</label>
                <p class="help-block">(только одна картинка!!!)</p>
            </div>
            <div class="form-group__data">
                <img src="/images/works/<?= $work->photoName ?>" alt="" style="width: 300px;">

                <input name="photo" id="inputFileWork" type="file" >
                <p class="help-block redMarker">При выборе другого изображения текущая фотография будет утрачена</p>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label for="inputTitleWork">Название объекта</label>
                <p class="help-block">(улица, номер дома)</p>
            </div>
            <div class="form-group__data">
                <input name="title" id="inputTitleWork" type="text" class="form-control" value="<?= $work->title ?>" title="" >
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>


        <div class="form-group">
            <div class="form-group__label">
                <label for="selectCategoryIdWork">Категория</label>
            </div>
            <div class="form-group__data">
                <select name="category_id" id="selectCategoryIdWork" title="">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>" <?= oldSelect($category, "category_id", $work) ?> >
                            <?= $category->title ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>




        <div class="form-group">
            <div class="form-group__label">
                <label for="selectStageIdWork">Этап работы:</label>
            </div>
            <div class="form-group__data">
                <select name="stage_id" id="selectStageIdWork" title="">
                    <?php foreach ($stages as $stage) : ?>
                        <option value="<?= $stage->id ?>" <?= oldSelect($stage, "stage_id", $work) ?> >
                            <?= $stage->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label for="inputDateWork">Дата создания:</label>
            </div>
            <div class="form-group__data" style="width: 300px;">

                <input name="timeCreate" id="inputDateWork" type="date" class="form-control" value="<?= oldDate("timeCreate", $work) ?>"
                       title="">
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label for="inputPublishWork">Разместить на сайте?</label>
            </div>
            <div class="form-group__data">
                <input name="publish" id="inputPublishWork" type="checkbox" <?= oldChecked("publish", $work) ?> class="form-control" title="">
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label for="taDescWork">Краткое описание</label>
            </div>
            <div class="form-group__data">
                <textarea name="description" id="taDescWork" class="form-control" title="" placeholder="<?= oldInfo('description')?>"><?= $work->description ?></textarea>
            </div>

        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Редактировать</button>
            <a href="/admin" class="btn btn-info" style="margin-left: 50px">На главную</a>
        </div>
    </form>
<!--    --><?php //unset($_SESSION['oldData']); ?>
</div>



<div class="crud">
    <h2>Редактирование благодарности № <?= $thank->id ?></h2>

<!--    --><?php //$thank->getErrors() ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'];
            unset($_SESSION['error']) ?>
        </div>
    <?php endif; ?>

    <form action="/admin/thank/edit" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $thank->id?>">
        <div class="form-group form-group__correct">
            <div class="form-group__label">
                <label for="inputFileThank">Фотография</label>
                <p class="help-block">(только одна картинка!!!)</p>
            </div>
            <div class="form-group__data">
                <img src="/images/thanks/<?= $thank->imageName ?>" alt="" style="width: 300px;">

                <input name="photo" id="inputFileThank" type="file" >
                <p class="help-block redMarker" style="color:limegreen;">при выборе другого изображения текущая фотография будет утрачена</p>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label for="inputTitleThank">Название</label>
                <p class="help-block">(От кого, за какие работы)</p>
            </div>
            <div class="form-group__data">
                <input name="title" id="inputTitleThank" type="text" class="form-control" value="<?= $thank->title ?>" title="" >
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Редактировать</button>
            <a href="/admin/thank" class="btn btn-info" style="margin-left: 50px">Все благодарности</a>
        </div>
    </form>
<!--    --><?php //unset($_SESSION['oldData']); ?>
</div>



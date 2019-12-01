<?php dump($_SESSION) ?>
<div class="crud">
    <h2>Добавить благодарность</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'];
            unset($_SESSION['error']) ?>
        </div>
    <?php endif; ?>

    <form action="/admin/thank/create" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <div class="form-group__label">
                <label for="exampleInputFile">Фотография</label>
                <p class="help-block">(только одна картинка!!!)</p>
            </div>
            <div class="form-group__data">
                <input name="photo" type="file" >
<!--                <p class="help-block redMarker">обязательное поле</p>-->
            </div>
        </div>

        <div class="form-group">
            <div class="form-group__label">
                <label for="exampleInputEmail1">Название</label>
                <p class="help-block">(От кого, за какие работы)</p>
            </div>
            <div class="form-group__data">
                <input name="title" type="text" class="form-control" value="<?= oldInfo('title') ?>" title="">
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Добавить</button>
            <a href="/admin" class="btn btn-info" style="margin-left: 50px">На главную</a>
        </div>

    </form>
    <?php unset($_SESSION['oldData']); ?>
</div>



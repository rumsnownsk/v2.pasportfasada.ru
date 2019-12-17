<?= $this->layout('layouts/admin', compact('title', 'auth')) ?>

<div class="crud">
    <h2>Добавить благодарность</h2>

    <?= $msg->display('e'); ?>

    <form action="/admin/thank/create" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <div class="form-group__label">
                <label for="exampleInputFile">Фотография</label>
                <p class="help-block">(только одна картинка!!!)</p>
            </div>
            <div class="form-group__data">
                <input name="image" type="file" >
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
</div>



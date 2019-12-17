<?= $this->layout('layouts/admin', compact('title', 'auth')) ?>

<div class="crud">
    <h2>Профиль работника: <?= $user->fio?></h2>

    <?= $msg->display(); ?>

    <form action="/admin/user/<?= $user->id?>/edit" method="post" enctype="multipart/form-data">

        <!--        INPUT AVATAR    -->
        <div class="form-group form-group__correct">
            <div class="form-group__label">
                <label for="inputFileThank">Фотография</label>
                <p class="help-block">(только одна картинка!!!)</p>
            </div>
            <div class="form-group__data">
                <img src="<?= $user->getImage() ?>" alt="" style="width: 300px;">

                <input name="avatar" id="inputFileThank" type="file" >
                <p class="help-block redMarker" style="color:limegreen;">при выборе другого изображения текущая фотография будет утрачена</p>
            </div>
        </div>

        <!--        INPUT USERNAME     -->
        <div class="form-group">
            <div class="form-group__label">
                <label for="inputUsername">Логин</label>
                <p class="help-block">(одно слово)</p>
            </div>
            <div class="form-group__data">
                <input name="username" id="inputUsername" type="text" class="form-control" value="<?= oldInfo('username', $user) ?>"
                       title="">
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>

        <!--        INPUT PASSWORD-->
        <div class="form-group">
            <div class="form-group__label">
                <label for="inputPassword">Пароль</label>
                <!--                <p class="help-block"></p>-->
            </div>
            <div class="form-group__data">
                <input name="password" id="inputPassword" type="text" class="form-control"
                       value=""
                       title="">
                <p class="help-block redMarker">обязательное поле. Одно слово на латинице. Больше 6 символов</p>
            </div>
        </div>

        <!--        SELECT ROLE-->
        <div class="form-group">
            <div class="form-group__label">
                <label for="selectRoleUser">Статус:</label>
            </div>
            <div class="form-group__data">
                <select name="role" id="selectRoleUser" title="">
                    <option value="2" <?= roleSelect('role', 'user', $user) ?> > Работник </option>
                    <option value="1" <?= roleSelect('role', 'boss', $user) ?> > Директор </option>
                </select>
                <p class="help-block redMarker">обязательное поле</p>
            </div>
        </div>

        <!--        INPUT EMAIL-->
        <div class="form-group">
            <div class="form-group__label">
                <label for="inputEmail">Email</label>
                <!--                <p class="help-block"></p>-->
            </div>
            <div class="form-group__data">
                <input name="email" id="inputEmail" type="email" class="form-control"
                       value="<?= oldInfo('email', $user) ?>"
                       title="" >
            </div>
        </div>

        <!--        INPUT FIO-->
        <div class="form-group">
            <div class="form-group__label">
                <label for="inputFio">Фамилия Имя</label>
                <!--                <p class="help-block"></p>-->
            </div>
            <div class="form-group__data">
                <input name="fio" id="inputFio" type="text" class="form-control"
                       value="<?= oldInfo('fio', $user) ?>"
                       title="" >
            </div>
        </div>

        <!--        INPUT PHONE-->
        <div class="form-group">
            <div class="form-group__label">
                <label for="inputFio">Номер телефона</label>
                <!--                <p class="help-block"></p>-->
            </div>
            <div class="form-group__data">
                <input name="phone" id="inputFio" type="text" class="form-control"
                       value="<?= oldInfo('phone', $user) ?>"
                       title="" >
            </div>
        </div>


        <div class="form-group">
            <button class="btn btn-success" type="submit">Редактировать</button>
            <a href="/admin" class="btn btn-info" style="margin-left: 50px">На главную</a>
        </div>
    </form>
</div>



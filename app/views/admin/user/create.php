<?php //dump($_SESSION); ?>

<div class="crud">
    <h2>Добавить нового работника</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'];
            unset($_SESSION['error']) ?>
        </div>
    <?php endif; ?>

    <form action="/admin/user/create" method="post">

        <!--        INPUT LOGIN-->
        <div class="form-group">
            <div class="form-group__label">
                <label for="inputUsername">Логин</label>
                <p class="help-block">(одно слово)</p>
            </div>
            <div class="form-group__data">
                <input name="username" id="inputUsername" type="text" class="form-control" value="<?= oldInfo('username') ?>"
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
                       value="<?= oldInfo('password') ?>"
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
                    <option value="2" selected > Работник </option>
                    <option value="1" > Директор </option>
                </select>
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



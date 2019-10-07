<br>


    <h1><?= $title ?></h1>
    <?php if (!empty($works)) : ?>
        <ul>Таблица постов (всего <?= $total ?>):</ul>
        <table>
            <?php foreach ($works as $work) : ?>
                <tr>
                    <td><?= $work->id ?></td>
                    <td><?= $work->name ?></td>
                    <td><?= $work->address ?></td>
                </tr>
<!--                <div class="panel panel-default">-->
<!--                    <div class="panel-heading">--><?//= $post['title'] ?><!--</div>-->
<!--                    <div class="panel-body">-->
<!--                        --><?//= $post['text'] ?>
<!--                    </div>-->
<!--                </div>-->

            <?php endforeach; ?>
            <dir class="text-center">
                <?php if ($pagination->countPages > 1) : ?>
                    <?= $pagination; ?>
                <?php endif; ?>
            </dir>
        </table>

    <?php endif; ?>

<!--<script>-->
<!--   -->
<!--</script>-->

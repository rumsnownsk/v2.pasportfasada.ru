<br>

<div class="container">

    <h1><?= $title ?></h1>
    <?php if (!empty($works)) : ?>
        <ul>Таблица постов:</ul>
        <table>
            <?php foreach ($works as $work) : ?>
                <tr>
                    <td><?= $work->id ?></td>
                </tr>
<!--                <div class="panel panel-default">-->
<!--                    <div class="panel-heading">--><?//= $post['title'] ?><!--</div>-->
<!--                    <div class="panel-body">-->
<!--                        --><?//= $post['text'] ?>
<!--                    </div>-->
<!--                </div>-->

            <?php endforeach; ?>
        </table>

    <?php endif; ?>
</div>

<!--<script>-->
<!--   -->
<!--</script>-->

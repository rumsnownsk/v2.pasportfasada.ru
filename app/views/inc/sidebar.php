<div class="recent">
    <h3 class="recent__header">Последние завершённые <br> работы:</h3>

    <?php foreach ($recentWorks as $recentWork) : ?>
    <div class="recent__item layer">
        <img src="<?= $recentWork->getImage() ?>"/>
        <div class="recent__title">
            <p><?= $recentWork->title ?></p>
            <p>Выполнено: <?= $recentWork->timeCreate ?></p>
        </div>

    </div>
    <?php endforeach; ?>

</div>

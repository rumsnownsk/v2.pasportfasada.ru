<div class="recent">
    <h3 class="recent__header">Последние завершённые <br> работы:</h3>
    <?php foreach ($this->data['recentWorks'] as $recentWork) : ?>

        <div class="recent__item layer">
            <img src="images/works/<?= $recentWork->photoName ?>"/>
            <div class="recent__title">
                <p><?= $recentWork->title ?></p>
                <p>Выполнено: <?= dateDMY($recentWork->finishDate) ?></p>
            </div>

        </div>
    <?php endforeach; ?>
</div>

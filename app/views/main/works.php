<?php if (!empty($works)) : ?>
    <h1 class="h1_header"><?= $category->name ?></h1>
    <div class="works">

        <?php foreach ($works as $work): ?>

            <div class="work layer">
                <img src="/images/works/<?= $work->photoName ?>" alt=""/>
                <div class="work__info">
                    <p><?= $work->title ?></p>
                    <p>Выполнено: <?= $work->finishDate ?></p>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

    <div class="text-center">
        <?php if ($pagination->countPages > 1) : ?>
            <?= $pagination; ?>
        <?php endif; ?>
    </div>

<?php else: ?>
    <div class="categories_list">
        <?php foreach ($categories as $category) : ?>

            <a href="/works?cat_id=<?= $category->id ?>"><?= $category->name ?></a>

        <?php endforeach; ?>
    </div>
<?php endif; ?>


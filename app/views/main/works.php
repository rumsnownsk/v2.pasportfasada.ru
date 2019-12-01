<?php if (!empty($works)) : ?>
    <div class="works">
        <h1 class="h1_header"><?= $category->title ?></h1>
        <div class="works__content">
            <?php foreach ($works as $work): ?>

                <div class="work layer">
                    <img src="<?= $work->getImage() ?>" alt=""/>
                    <div class="work__info">
                        <p><?= $work->title ?></p>
                        <p>Выполнено: <?= $work->finishDate ?></p>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>



        <?php if ($pagination->countPages > 1) : ?>
            <div class="works__pagination">
                <?= $pagination; ?>
            </div>
        <?php endif; ?>
    </div>


<?php else: ?>
    <div class="categories_list">
        <?php foreach ($categories as $category) : ?>

            <a href="/works?cat_id=<?= $category->id ?>"><?= $category->title ?></a>

        <?php endforeach; ?>
    </div>
<?php endif; ?>


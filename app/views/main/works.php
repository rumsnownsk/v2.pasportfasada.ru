<?= $this->layout('layouts/main', compact('title', 'recentWorks', 'categories', 'auth')) ?>

<?php if (!empty($works)) : ?>
    <div class="works">
        <h2><?= $categoryName ?></h2>
        <div class="works__content">
            <?php foreach ($works as $work): ?>

                <div class="work layer">
                    <img src="<?= $work->getImage() ?>" alt=""/>
                    <div class="work__info">
                        <p><?= $work->id ?></p>
                        <p>Выполнено: <?= $work->finishDate ?></p>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

        <?php if ($paginator->getNumPages() > 1) : ?>
            <div class="works__pagination">
                <?php getPagination($paginator) ?>
            </div>
        <?php endif; ?>
    </div>


<?php else: ?>
    <div class="categories_list">
        <?php foreach ($categories as $category) : ?>

            <a href="/works/<?= $category->id ?>"><?= $category->title ?></a>

        <?php endforeach; ?>
    </div>
<?php endif; ?>


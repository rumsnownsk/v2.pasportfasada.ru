<h1 class="h1_header">Слова благодарности наших клиентов</h1>
<div class="thanks gallery">

    <?php foreach ($thanks as $thank) : ?>
        <div class="thanks__content layer">
            <a href="/images/thanks/<?= $thank->imageName ?>">
                <img src="/images/thanks/<?= $thank->imageName ?>" class="thanks-image" title="<?= $thank->title ?>" alt="">
            </a>
            <p><?= $thank->title ?></p>
        </div>
    <?php endforeach; ?>

</div>



<?= $this->layout('layouts/main', compact('title','recentWorks','categories')) ?>

<h2>Слова благодарности наших клиентов</h2>
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



<h1 class="h1_header">Слова благодарности наших клиентов</h1>
<div class="thanks gallery">

    <?php foreach ($thanks as $thank) : ?>
        <div class="thanks__content layer">
            <a href="/images/thanks/<?= $thank->image ?>">
                <img src="/images/thanks/<?= $thank->image ?>" class="thanks-image" title="<?= $thank->name ?>" alt="">
            </a>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
        </div>
    <?php endforeach; ?>

</div>



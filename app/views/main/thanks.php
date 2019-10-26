<h1 class="h1_header">Слова благодарности наших клиентов</h1>
    <div class="thanks">

        <?php foreach ($thanks as $thank) : ?>
            <div class="thanks__content layer">
                <img src="/images/thanks/<?= $thank->image ?>" class="thanks-image" alt="" title="<?= $thank->name ?>">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
            </div>
        <?php endforeach; ?>

    </div>



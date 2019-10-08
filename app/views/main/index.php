<?php if (!empty($works)) : ?>

<?php foreach ($works as $work): ?>

        <div class="content-grid-info">
            <img src="/blog/images/post1.jpg" alt=""/>
            <div class="post-info">
                <h4>
                    <a href="<?= $work->id ?>">
                        <?= $work->name ?>
                    </a>  July 30, 2014 / 27 Comments
                </h4>
                <p><?= $work->address ?></p>
                <a href="single.html"><span></span><?php __('read_more') ?></a>
            </div>
        </div>

<?php endforeach; ?>

<div class="text-center">
    <?php if ($pagination->countPages > 1) : ?>
        <?= $pagination; ?>
    <?php endif; ?>
</div>

<?php else: ?>
    <h3>Posts not found</h3>
<?php endif; ?>
<code><?= __FILE__ ?></code>
<h1>Admin panel</h1>
<ul>
    <?php foreach ($works as $work) :?>

        <li><?= $work->name ?></li>

    <?php endforeach; ?>
</ul>
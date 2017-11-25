<?php require 'header.php'; ?>

<h1>All links</h1>
<ul>
    <?php foreach($routes as $route) { ?>
        <li>
            <a href="<?=$route?>"><?=$route?></a>
        </li>
    <?php } ?>
</ul>

<?php require 'footer.php'; ?>

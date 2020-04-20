<?php

/**
 * @var $page base\Page;
 */

$path = new base\routing\Path();
?>

<!doctype html>
<html lang="ru">

<head>
    <?php echo $page->scripts; ?>
    <?php include $page->meta; ?>
    <?php echo $page->styles; ?>
    <title><?= $page->title; ?></title>

    <?php if ($page->description != '') : ?>
        <meta name="description" content="<?= $page->description; ?>">
    <?php endif; ?>

    <?php if ($page->keywords != '') : ?>
        <meta name="keywords" content="<?= $page->keywords; ?>">
    <?php endif; ?>
</head>

<body>
    <div class="body">
        <header class="header">
            <?php include $page->getHeader(); ?>
        </header>

        <div class="content">
            <?php
            if (!empty($page->getContent()))
                echo $page->getContent();
            ?>
        </div>

        <?php if (file_get_contents($page->getFooter())) : ?>
            <footer>
                <?php include $page->getFooter(); ?>
            </footer>
        <?php endif; ?>
    </div>
</body>

</html>
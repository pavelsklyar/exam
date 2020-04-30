<?php

/**
 * @var $item
 * @var $parent_name
 * @var $type
 */

?>

<div class="block block-big block-3 mb-3 d-flex flex-column justify-content-between">
    <div class="block-top d-flex justify-content-between">

        <div class="width-25 m-1">
            <p class="h5 font-weight-light"><a href="/<?= $type ?>/<?= $item['id'] ?>">#<?= $item['id'] ?></a></p>
        </div>

        <?php if (isset($item['code'])) : ?>
        <div class="m-1">
            <p class="h5 font-weight-light"><?= $item['code'] ?></p>
        </div>
        <?php endif; ?>

        <div class="d-flex">
            <div class="width-25 m-1">
                <a href="/<?= $type ?>/edit/<?= $item['id']; ?>">
                    <img class="icons-100" src="/svg/edit.svg" alt="редактировать">
                </a>
            </div>
            <div class="width-25 m-1">
                <a href="/<?= $type ?>/delete/?id=<?= $item['id']; ?>">
                    <img class="icons-100" src="/svg/delete.svg" alt="удалить">
                </a>
            </div>
        </div>

    </div>

    <div>
        <p class="h4"><?= $item['name'] ?></p>
    </div>

    <div class="block-bottom">
        <p class="mb-0"><?= $item[$parent_name]; ?></p>
    </div>
</div>
<?php

/**
 * @var $item
 * @var $type
 */

?>

<div class="block col-12 mb-3 d-flex flex-column justify-content-center">
    <div class="d-flex justify-content-between">

        <div class="width-25 height-25 m-1">
            <p class="h5 font-weight-light"><a href="/<?= $type ?>/<?= $item['id'] ?>">#<?= $item['id'] ?></a></p>
        </div>

        <?php if (isset($item['email'])) : ?>
            <div class="m-1 height-25">
                <p class="h5 font-weight-light"><?= $item['email'] ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($item['surname'])) : ?>
            <div class="m-1 height-25">
                <p class="h5 font-weight-light"><?= $item['surname'] ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($item['name'])) : ?>
            <div class="m-1 height-25">
                <p class="h5 font-weight-light"><?= $item['name'] ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($item['fathername'])) : ?>
            <div class="m-1 height-25">
                <p class="h5 font-weight-light"><?= $item['fathername'] ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($item['status'])) : ?>
            <div class="m-1 height-25">
                <p class="h5 font-weight-light"><?= $item['status'] ?></p>
            </div>
        <?php endif; ?>

        <div class="d-flex height-25">
            <div class="width-23 mr-1 ml-1">
                <a href="/<?= $type ?>/edit/<?= $item['id']; ?>">
                    <img class="icons-100" src="/svg/edit.svg" alt="редактировать">
                </a>
            </div>
            <div class="width-23 mr-1 ml-1">
                <a href="/<?= $type ?>/delete/?id=<?= $item['id']; ?>">
                    <img class="icons-100" src="/svg/delete.svg" alt="удалить">
                </a>
            </div>
        </div>

    </div>
</div>
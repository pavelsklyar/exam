<?php

/**
 * @var $item
 */

?>

<div class="block block-big block-3 mb-3 d-flex flex-column justify-content-between">
    <div class="block-top d-flex justify-content-between">


        <div class="m-1">
            <p class="h5 font-weight-light"><?= $item['full_name'] ?></p>
        </div>

        <div class="d-flex">
            <div class="width-25 m-1">
                <a href="/schedule/edit/<?= $item['id']; ?>">
                    <img class="icons-100" src="/svg/edit.svg" alt="редактировать">
                </a>
            </div>
            <div class="width-25 m-1">
                <a href="/schedule/delete/?id=<?= $item['id']; ?>">
                    <img class="icons-100" src="/svg/delete.svg" alt="удалить">
                </a>
            </div>
        </div>

    </div>

    <div>
        <p class="h4">
            <?= $item['subject'] ?>
        </p>
        <p class="mb-0"><?= $item['type'] ?></p>
    </div>

    <div class="block-bottom d-flex justify-content-between">
        <p class="mb-0"><?= $item['date'] ?></p>
        <p class="mb-0"><?= $item['time_start'] ?> - <?= $item['time_end'] ?></p>
        <p class="mb-0"><?= $item['classroom'] ?></p>
    </div>
</div>

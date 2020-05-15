<?php

/**
 * @var $type
 * @var $value
 */

?>

<div class="d-flex justify-content-between col-8 ml-auto mr-auto mt-4 mb-3">
    <div class="col-4">
        <a href="/schedule/groups/" class="col-12 btn <?php if (isset($type) && $type === "groups") : ?>btn-danger<?php else : ?>btn-primary<?php endif; ?>">По группам</a>
    </div>
    <div class="col-4">
        <a href="/schedule/teachers/" class="col-12 btn <?php if (isset($type) && $type === "teachers") : ?>btn-danger<?php else : ?>btn-primary<?php endif; ?>">По преподавателям</a>
    </div>
    <div class="col-4">
        <a href="/schedule/add/" class="col-12 btn <?php if (isset($type) && $type === "add") : ?>btn-danger<?php else : ?>btn-primary<?php endif; ?>">Добавить</a>
    </div>
</div>

<?php if (isset($type)) : ?>
    <div class="d-flex justify-content-between col-8 ml-auto mr-auto mt-4 mb-3 search_box">
        <form class="col-12" name="search_form" method="post" action="
    <?php if ($type === "groups") : ?>
        /schedule/groups/
    <?php elseif ($type === "teachers") : ?>
        /schedule/teachers/
    <?php endif; ?>
    ">
            <input id="<?php if ($type === "groups") : ?>searchGroups<?php elseif ($type === "teachers") : ?>searchTeachers<?php endif; ?>"
                   class="col-12 p-1 form-control text-center" name="search" type="text"
                   placeholder="
            <?php if ($type === "groups") : ?>
                Введите номер группы
            <?php elseif ($type === "teachers") : ?>
                Введите ФИО преподавателя
            <?php endif; ?>
            " <?php if (isset($value)) : ?>value="<?= $value ?>"<?php endif;?> autocomplete="off">
        </form>
        <div id="search_box-result"></div>
    </div>
<?php endif; ?>

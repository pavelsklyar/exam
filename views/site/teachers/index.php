<?php

/**
 * @var $page base\Page;
 * @var array $teachers
 */

use base\View\Element;

$page->title = "Список преподавателей";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список преподавателей</h2>
    </div>
    <div>
        <a href="/teachers/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($teachers)) : ?>
    <?php new Element("no_items", ['page_name' => 'teachers']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($teachers as $teacher) : ?>
            <?php new Element("3_blocks", ['item' => $teacher, 'parent_name' => 'department_name', 'type' => 'teachers']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
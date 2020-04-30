<?php

/**
 * @var $page base\Page;
 * @var array $subjects
 */

use base\View\Element;

$page->title = "Список предметов";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список предметов</h2>
    </div>
    <div>
        <a href="/subjects/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($subjects)) : ?>
    <?php new Element("no_items", ['page_name' => 'subjects']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($subjects as $subject) : ?>
            <?php new Element("3_blocks", ['item' => $subject, 'parent_name' => 'department_name', 'type' => 'subjects']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
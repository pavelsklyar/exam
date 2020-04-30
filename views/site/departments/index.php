<?php

/**
 * @var $page base\Page;
 * @var array $departments
 */

use base\View\Element;

$page->title = "Список кафедр";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список кафедр</h2>
    </div>
    <div>
        <a href="/departments/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($departments)) : ?>
    <?php new Element("no_items", ['page_name' => 'departments']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($departments as $department) : ?>
            <?php new Element("2_blocks", ['item' => $department, 'type' => 'departments']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php

/**
 * @var $page base\Page;
 * @var array $directions
 */

use base\View\Element;

$page->title = "Список направлений обучения";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список направлений обучения</h2>
    </div>
    <div>
        <a href="/directions/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($directions)) : ?>
    <?php new Element("no_items", ['page_name' => 'directions']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($directions as $direction) : ?>
            <?php new Element("3_blocks", ['item' => $direction, 'parent_name' => 'faculty_name', 'type' => 'directions']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
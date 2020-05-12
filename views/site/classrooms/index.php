<?php

/**
 * @var $page base\Page;
 * @var array $classrooms
 */

use base\View\Element;

$page->title = "Список аудиторий";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список аудиторий</h2>
    </div>
    <div>
        <a href="/classrooms/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($classrooms)) : ?>
    <?php new Element("no_items", ['page_name' => 'classrooms']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($classrooms as $classroom) : ?>
            <?php new Element("2_blocks", ['item' => $classroom, 'type' => 'classrooms']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
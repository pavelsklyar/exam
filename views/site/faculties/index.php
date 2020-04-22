<?php

/**
 * @var $page base\Page;
 * @var array $faculties
 */

use base\View\Element;

$page->title = "Список факультетов";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список факультетов</h2>
    </div>
    <div>
        <a href="/faculties/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($faculties)) : ?>
    <?php new Element("no_items", ['page_name' => 'faculties']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($faculties as $faculty) : ?>
            <?php new Element("2_blocks", ['item' => $faculty, 'type' => 'faculties']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
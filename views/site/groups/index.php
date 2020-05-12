<?php

/**
 * @var $page base\Page;
 * @var array $groups
 */

use base\View\Element;

$page->title = "Список учебных групп";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список учебных групп</h2>
    </div>
    <div>
        <a href="/groups/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($groups)) : ?>
    <?php new Element("no_items", ['page_name' => 'groups']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($groups as $group) : ?>
            <?php new Element("2_blocks", ['item' => $group, 'type' => 'groups']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
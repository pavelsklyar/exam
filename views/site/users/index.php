<?php

/**
 * @var $page base\Page;
 * @var array $users
 */

use base\View\Element;

$page->title = "Список пользователей";

?>

<div class="d-flex justify-content-between mt-4 mb-3">
    <div>
        <h2>Список пользователей</h2>
    </div>
    <div>
        <a href="/users/add/" class="btn btn-primary">Добавить</a>
    </div>
</div>

<?php if (empty($users)) : ?>
    <?php new Element("no_items", ['page_name' => 'users']) ?>
<?php else : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($users as $user) : ?>
            <?php new Element("users_blocks", ['item' => $user, 'type' => 'users']) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
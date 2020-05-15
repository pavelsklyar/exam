<?php

/**
 * @var $type
 */

if (!isset($type)) {
    $type = null;
}

?>

<?php new \base\View\Element("schedule_menu", ['type' => $type]) ?>
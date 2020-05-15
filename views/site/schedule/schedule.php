<?php

/**
 * @var $type string
 * @var $schedule array
 */

if ($type === 'groups') {
    if (is_array($schedule)) {
        $value = $schedule[0]['group_number'];
    }
    else {
        $value = '';
    }
}
else {
    if (is_array($schedule)) {
        $value = $schedule[0]['full_name'];
    }
    else {
        $value = '';
    }
}

?>

<?php new \base\View\Element("schedule_menu", ['type' => $type, 'value' => $value]) ?>

<?php if (is_array($schedule)) : ?>
    <div class="d-flex flex-row flex-wrap justify-content-between">
        <?php foreach ($schedule as $item) : ?>
            <?php new \base\View\Element("schedule", ['item' => $item]); ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
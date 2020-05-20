<?php

/**
 * @var $type string
 * @var $schedule array
 * @var $number
 */

if ($type === 'groups') {
    if (is_array($schedule)) {
        $value = $schedule[0]['group_number'];
    }
    else {
        $value = $number;
    }
}
else {
    if (is_array($schedule)) {
        $value = $schedule[0]['full_name'];
    }
    else {
        $value = $number;
    }
}

?>

<?php if (is_array($schedule)) : ?>
<?php new \base\View\Element("schedule_menu", ['type' => $type, 'value' => $value]) ?>

<div class="d-flex flex-row flex-wrap justify-content-between">
    <?php foreach ($schedule as $item) : ?>
        <?php new \base\View\Element("schedule", ['item' => $item]); ?>
    <?php endforeach; ?>
</div>
<?php else : ?>
    <?php new \base\View\Element("schedule_menu", ['type' => $type, 'value' => $value]) ?>
<p class="text-center mt-3">Расписания пока нет</p>
<?php endif; ?>
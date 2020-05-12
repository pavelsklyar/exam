<?php

/**
 * @var $page base\Page;
 * @var $data array
 * @var $edit bool
 * @var $error
 */

$isset = isset($data);

if (!isset($edit)) {
    $edit = false;
}

if ($edit) {
    $page->title = "Изменение группы";
}
else {
    $page->title = "Добавление группы";
}

?>

<?php if (isset($error)) : ?>
    <div>
        <h2><?= $error ?></h2>
    </div>
<?php endif; ?>

<div class="col-12 m-auto vh-80 d-flex flex-column justify-content-center">
    <div>
        <h1 class="h3 text-center mb-5"><?php if ($edit) : ?>Изменение группы<?php else : ?>Добавление группы<?php endif; ?></h1>

        <form action="/groups/<?php if ($edit) : ?>edit<?php else : ?>add<?php endif; ?>/" method="post">
            <div class="form-row col-6 m-auto">
                <div class="col-6 mt-3">
                    <label for="number">Номер группы: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="number" type="text" id="number" placeholder="171-332"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['number'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-6 mt-3">
                    <label for="students_number">Количество студентов: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="students_number" type="number" id="students_number"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['students_number'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
            </div>

            <?php if ($edit) : ?>
                <input type="number" name="id" value="<?= $data['id'] ?>" class="d-none">
            <?php endif; ?>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary"><?php if ($edit) : ?>Изменить<?php else : ?>Добавить<?php endif; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
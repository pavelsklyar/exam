<?php

/**
 * @var $page base\Page;
 * @var $data array
 * @var $edit bool
 * @var $error
 * @var $departments array
 */

$isset = isset($data);

if (!isset($edit)) {
    $edit = false;
}

if ($edit) {
    $page->title = "Изменение преподавателя";
}
else {
    $page->title = "Добавление преподавателя";
}

?>

<?php if (isset($error)) : ?>
    <div>
        <h2><?= $error ?></h2>
    </div>
<?php endif; ?>

<div class="col-12 m-auto vh-80 d-flex flex-column justify-content-center">
    <div>
        <h1 class="h3 text-center mb-5"><?php if ($edit) : ?>Изменение преподавателя<?php else : ?>Добавление преподавателя<?php endif; ?></h1>

        <form action="/teachers/<?php if ($edit) : ?>edit<?php else : ?>add<?php endif; ?>/" method="post">
            <div class="form-row col-6 m-auto">
                <div class="col-4 mt-3">
                    <label for="surname">Фамилия: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="surname" type="text" id="surname" placeholder="Михайлов"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['surname'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="name">Имя: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="name" type="text" id="name" placeholder="Михаил"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['name'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="fathername">Отчество: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="fathername" type="text" id="fathername" placeholder="Михайлович"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['fathername'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-3">
                    <label for="department">К какой кафедре относится <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="department_id" id="" required>
                            <?php foreach ($departments as $department) : ?>
                                <option class="custom-option" value="<?= $department['id'] ?>" <?php if ($isset && $data['department_id'] === $department['id']) : ?>selected<?php endif; ?>><?= $department['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
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
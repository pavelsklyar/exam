<?php

/**
 * @var $page base\Page;
 * @var $data array
 * @var $edit bool
 * @var $error
 * @var $faculties array
 */

$isset = isset($data);

if (!isset($edit)) {
    $edit = false;
}

if ($edit) {
    $page->title = "Изменение направления обучения";
}
else {
    $page->title = "Добавление направление обучения";
}

?>

<?php if (isset($error)) : ?>
    <div>
        <h2><?= $error ?></h2>
    </div>
<?php endif; ?>

<div class="col-12 m-auto vh-80 d-flex flex-column justify-content-center">
    <div>
        <h1 class="h3 text-center mb-5"><?php if ($edit) : ?>Изменение направления обучения<?php else : ?>Добавление направления обучения<?php endif; ?></h1>

        <form action="/directions/<?php if ($edit) : ?>edit<?php else : ?>add<?php endif; ?>/" method="post">
            <div class="form-row col-6 m-auto">
                <div class="col-3 mt-3">
                    <label for="name">Шифр: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="code" type="text" id="name" placeholder="01.01.01"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['code'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-9 mt-3">
                    <label for="name">Название направления: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="name" type="text" id="name" placeholder="Информатика и вычислительная техника"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['name'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-3">
                    <label for="faculty">К какому факультету относится <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="faculty_id" id="" required>
                            <?php foreach ($faculties as $faculty) : ?>
                                <option class="custom-option" value="<?= $faculty['id'] ?>" <?php if ($isset && $data['faculty_id'] === $faculty['id']) : ?>selected<?php endif; ?>><?= $faculty['name'] ?></option>
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
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
    $page->title = "Изменение факультета";
}
else {
    $page->title = "Добавление факультета";
}

?>

<div class="col-12 m-auto vh-80 d-flex flex-column justify-content-center">
    <div>
        <h1 class="h3 text-center mb-5"><?php if ($edit) : ?>Изменение факультета<?php else : ?>Добавление факультета<?php endif; ?></h1>

        <form action="/faculties/<?php if ($edit) : ?>edit<?php else : ?>add<?php endif; ?>/" method="post">
            <div class="form-row">
                <div class="col-5 m-auto mt-3">
                    <label for="name">Название факультета <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <input name="name" type="text" id="name" placeholder="Факультет информационных технологий"
                            class="form-control <?php if ($isset && !$edit) : ?>is-invalid<?php endif; ?>"
                            aria-describedby="inputGroupName"
                           <?php if ($edit || isset($error)) : ?>value="<?= $data['name'] ?>"<?php endif; ?>
                            required>
                        <?php if (isset($error) && isset($error['error']['name'])) : ?>
                            <div class="invalid-feedback"><?= $error['error']['name'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($edit) : ?>
                <input type="number" name="id" value="<?= $data['id'] ?>" class="d-none">
            <?php endif; ?>

            <div class="form-row mt-2">
                <div class="col-5 m-auto">
                    <button type="submit" class="btn btn-primary"><?php if ($edit) : ?>Изменить<?php else : ?>Добавить<?php endif; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
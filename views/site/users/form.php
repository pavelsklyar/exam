<?php

/**
 * @var $page base\Page;
 * @var $data array
 * @var $edit bool
 * @var $error
 * @var $statuses array
 */

$isset = isset($data);

if (!isset($edit)) {
    $edit = false;
}

if ($edit) {
    $page->title = "Изменение пользователя";
}
else {
    $page->title = "Добавление пользователя";
}

?>

<?php if (isset($error)) : ?>
    <div>
        <h2><?= $error ?></h2>
    </div>
<?php endif; ?>

<div class="col-12 m-auto vh-80 d-flex flex-column justify-content-center">
    <div>
        <h1 class="h3 text-center mb-5"><?php if ($edit) : ?>Изменение пользователя<?php else : ?>Добавление пользователя<?php endif; ?></h1>

        <form action="/users/<?php if ($edit) : ?>edit<?php else : ?>add<?php endif; ?>/" method="post">
            <div class="form-row col-6 m-auto">
                <div class="col-4 mt-3">
                    <label for="email">Email: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="email" type="email" id="email" placeholder="user@email.ru"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['email'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="password">Пароль: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="password" type="password" id="password" placeholder="Введите пароль"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['name'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="password_twice">Пароль ещё раз: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="password_twice" type="password" id="password_twice" placeholder="Пароль ещё раз"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['name'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-4 mt-3">
                    <label for="surname">Фамилия: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="surname" type="text" id="surname" placeholder="Скляр"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['surname'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="name">Имя: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="name" type="text" id="name" placeholder="Павел"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['name'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="fathername">Отчество: <span class="color-red">*</span></label>
                    <div class="input-group">

                        <input name="fathername" type="text" id="fathername" placeholder="Олегович"
                               class="form-control"
                               aria-describedby="inputGroupName"
                               <?php if ($edit || isset($error)) : ?>value="<?= $data['name'] ?>"<?php endif; ?>
                               required>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-3">
                    <label for="status">Статус пользователя <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="status_id" id="status" required>
                            <?php foreach ($statuses as $status) : ?>
                                <option class="custom-option" value="<?= $status['id'] ?>" <?php if ($isset && $data['status_id'] === $status['id']) : ?>selected<?php endif; ?>><?= $status['runame'] ?></option>
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
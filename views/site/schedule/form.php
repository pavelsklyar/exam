<?php

/**
 * @var $groups
 * @var $subjects
 * @var $teachers
 * @var $classrooms
 * @var $lessons
 * @var $types
 * @var $data
 * @var $edit
 * @var $error
 */

$isset = isset($data);

if (!isset($edit)) {
    $edit = false;
}

?>

<div class="col-12 m-auto vh-80 d-flex flex-column justify-content-center">

    <?php if (isset($error)) : ?>
    <p><?= $error ?></p>
    <?php endif; ?>

    <div>
        <h1 class="h3 text-center mb-5"><?php if ($edit) : ?>Изменение расписания<?php else : ?>Добавление расписания<?php endif; ?></h1>

        <form action="/schedule/<?php if ($edit) : ?>edit<?php else : ?>add<?php endif; ?>/" method="post">

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-3">
                    <label for="faculty">Выберите группу <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="group_id" id="" required>
                            <?php foreach ($groups as $group) : ?>
                                <option class="custom-option" value="<?= $group['id'] ?>" <?php if ($isset && $data['group_id'] === $group['id']) : ?>selected<?php endif; ?>><?= $group['number'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-3">
                    <label for="faculty">Выберите предмет <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="subject_id" id="" required>
                            <?php foreach ($subjects as $subject) : ?>
                                <option class="custom-option" value="<?= $subject['id'] ?>" <?php if ($isset && $data['subject_id'] === $subject['id']) : ?>selected<?php endif; ?>><?= $subject['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-3">
                    <label for="faculty">Выберите преподавателя <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="teacher_id" id="" required>
                            <?php foreach ($teachers as $teacher) : ?>
                                <option class="custom-option" value="<?= $teacher['id'] ?>" <?php if ($isset && $data['teacher_id'] === $teacher['id']) : ?>selected<?php endif; ?>><?= $teacher['full_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-3">
                    <label for="faculty">Выберите аудиторию <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="classroom_id" id="" required>
                            <?php foreach ($classrooms as $classroom) : ?>
                                <option class="custom-option" value="<?= $classroom['id'] ?>" <?php if ($isset && $data['classroom_id'] === $classroom['id']) : ?>selected<?php endif; ?>><?= $classroom['number'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row col-6 m-auto">
                <div class="col-4 mt-3">
                    <label for="faculty">Выберите дату <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <input type="date" name="date" <?php if (isset($data)) : ?>value="<?= $data['date'] ?>"<?php endif; ?>>
                    </div>
                </div>

                <div class="col-4 mt-3">
                    <label for="faculty">Выберите пару <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="lesson_id" id="" required>
                            <?php foreach ($lessons as $lesson) : ?>
                                <option class="custom-option" value="<?= $lesson['id'] ?>" <?php if ($isset && $data['lesson_id'] === $lesson['id']) : ?>selected<?php endif; ?>><?= $lesson['number'] ?> : <?= $lesson['start'] ?>-<?= $lesson['end'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-4 mt-3">
                    <label for="faculty">Выберите тип <span class="color-red">*</span>:</label>
                    <div class="input-group">
                        <select class="custom-select input-select" name="type_id" id="" required>
                            <?php foreach ($types as $type) : ?>
                                <option class="custom-option" value="<?= $type['id'] ?>" <?php if ($isset && $data['type_id'] === $type['id']) : ?>selected<?php endif; ?>><?= $type['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <?php if ($edit) : ?>
                <input type="number" name="id" value="<?= $data['id'] ?>" class="d-none">
                <input type="number" name="tsg_id" value="<?= $data['tsg_id'] ?>" class="d-none">
                <input type="number" name="place_id" value="<?= $data['place_id'] ?>" class="d-none">
            <?php endif; ?>

            <div class="form-row col-6 m-auto">
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary"><?php if ($edit) : ?>Изменить<?php else : ?>Добавить<?php endif; ?></button>
                </div>
            </div>

        </form>
    </div>
</div>
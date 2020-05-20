<?php
/**
 * @var $form
 */

$isset = isset($form);
?>



<div class="d-flex vh-100">
    <div class="auth m-auto d-flex flex-column justify-content-center">
        <h1 class="h3 text-center mb-3">Авторизация</h1>

        <form action="/" method="post">
            <div class="form-group">
                <label for="email">Email <span class="color-red">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text d-flex justify-content-center p-2" id="inputGroupPrepend2"><img class="icons" src="/svg/mail.svg" alt="email"></span>
                    </div>
                    <input name="email" type="email" class="form-control <?php if ($isset && !$form['fields']['error']) : ?>is-invalid<?php endif; ?>" id="email" aria-describedby="inputGroupPrepend2" placeholder="email" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group">
                <label for="validationDefault01">Пароль <span class="color-red">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text d-flex justify-content-center p-2" id="inputGroupPassword1"><img class="icons" src="/svg/lock.svg" alt="email"></span>
                    </div>
                    <input name="password" type="password" class="form-control <?php if ($isset && !$form['fields']['error']) : ?>is-invalid<?php endif; ?>" id="validationDefault01" aria-describedby="inputGroupPassword1" placeholder="Введите пароль" required>
                </div>
                <?php if ($isset && !$form['fields']['error']) : ?>
                    <div class="invalid-feedback d-block"><?= $form['messages']['error'] ?></div>
                <?php endif; ?>
                <small id="formHelp" class="form-text text-muted mt-2 ml-2"><span class="color-red">*</span> - обязательные поля</small>
            </div>

            <div class="form-group d-flex flex-row justify-content-around align-items-center flex-wrap">
                <div class="d-flex flex-row flex-wrap">
                    <input type="checkbox" name="remember" checked id="inlineFormCheck">
                    <label for="inlineFormCheck" class="small m-1">Запомнить</label>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </form>
    </div>
</div>
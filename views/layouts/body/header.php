<?php if (\base\App::$session->user->isAuth()) : ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-mydark text-white">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto mr-auto">
            <li class="menu-item">
                <a href="/schedule/" class="nav-link">Расписание сессии</a>
            </li>
            <li class="menu-item">
                <a href="/faculties/" class="nav-link">Факультеты</a>
            </li>
            <li class="menu-item">
                <a href="/directions/" class="nav-link">Направления обучения</a>
            </li>
            <li class="menu-item">
                <a href="/departments/" class="nav-link">Кафедры</a>
            </li>
            <li class="menu-item">
                <a href="/subjects/" class="nav-link">Предметы</a>
            </li>
            <li class="menu-item">
                <a href="/teachers/" class="nav-link">Преподаватели</a>
            </li>
            <li class="menu-item">
                <a href="/groups/" class="nav-link">Учебные группы</a>
            </li>
            <li class="menu-item">
                <a href="/classrooms/" class="nav-link">Аудитории</a>
            </li>
            <?php if (\base\App::$session->user->get("status") === "administrator") : ?>
            <li class="menu-item">
                <a href="/users/" class="nav-link">Пользователи</a>
            </li>
            <?php endif; ?>
            <li class="menu-item">
                <a href="/logout/" class="nav-link">Выход</a>
            </li>
        </ul>
    </div>
</nav>
<?php endif; ?>
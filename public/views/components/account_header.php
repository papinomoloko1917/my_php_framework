<?php if ($user = $_SESSION['user_email'] ?? ''): ?>
    <ul class="nav nav-tabs ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Личный кабинет</a></li>
                <li><a class="dropdown-item" href="#">Настройки</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <form action="/logout" method="post">
                    <li><button type="submit" class="dropdown-item">Выйти из аккаунта</button></li>
                </form>
            </ul>
        </li>
    </ul>
<?php
endif;
?>

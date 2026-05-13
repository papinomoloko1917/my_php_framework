<?php

use App\Session\Auth;

if (Auth::check()): ?>
    <ul class="nav nav-tabs ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <?= htmlspecialchars(Auth::email(), ENT_QUOTES, 'UTF-8') ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Личный кабинет</a></li>
                <li><a class="dropdown-item" href="#">Настройки</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form action="/logout" method="post"><button type="submit" class="dropdown-item">Выйти из аккаунта</button></form>
                </li>

            </ul>
        </li>
    </ul>
<?php
endif;
?>

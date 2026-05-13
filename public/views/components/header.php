<?php

use App\Session\Auth;
?>
<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="/">My PHP Framework</a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/about">О нас</a>
                </li>

                <?php
                if (!Auth::check()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Регистрация</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/login">Аккаунт</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php require BASE_DIR . '/public/views/components/account_header.php'; ?>
        </div>
    </div>
</nav>

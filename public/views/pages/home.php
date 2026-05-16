<div>
    <h1 style="color: red;">Домашняя страница</h1>
    <ul style="list-style: none; padding: 0;">
        <li>
            <a href="/about">О нас</a>
        </li>
        <?php

        use App\Session\Auth;

        if (!Auth::check()): ?>
            <li>
                <a href="/register">Регистрация</a>
            </li>

            <li>
                <a href="/login">Войти в аккаунт</a>
            </li>
        <?php endif ?>
    </ul>

</div>

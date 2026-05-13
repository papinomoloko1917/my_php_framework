<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h1 class="h3 mb-4 text-center">Регистрация</h1>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="/register" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Электронный адрес</label>
                        <input
                            value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>"
                            type="email"
                            name="email"
                            id="email"
                            class="form-control">
                        <div class="form-text">
                            Мы никогда не передадим вашу почту кому-либо еще.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Подтверждение пароля
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        Зарегистрироваться
                    </button>

                    <div class="text-center">
                        <span class="text-muted">Уже есть аккаунт?</span>
                        <a href="/login">Войти</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

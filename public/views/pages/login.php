<h3>Авторизация</h3>
<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <p style="color: red;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endforeach ?>
<?php endif ?>

<form action="/login" method="POST">

    <div class="mb-3">
        <label for="email" class="form-label">Электронный адрес</label>
        <input value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>" type="text" name="email" id="email" class="form-control">
        <div class="form-text">Мы никогда не передадим вашу почту кому-либо еще.</div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Войти</button>
        <a href="/register" type="submit" class="btn btn-success">Регистрация</a>
    </div>

</form>

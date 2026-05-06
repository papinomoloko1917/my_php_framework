<h3>Регистрация</h3>
<form action="/register" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Электронный адрес</label>
        <input type="text" name="email" id="email" class="form-control">
        <div class="form-text">Мы никогда не передадим вашу почту кому-либо еще.</div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>

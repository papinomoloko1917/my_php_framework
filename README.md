# My PHP Framework

Учебный мини-фреймворк на чистом PHP. Проект создается постепенно, чтобы разобраться, как внутри работают роутинг, контроллеры, request/response, views, middleware, сессии, авторизация и обработка ошибок.

## Стек

- PHP 8.2 FPM
- Composer PSR-4 autoload
- MySQL 8
- Nginx
- Docker Compose / Sail-style окружение
- Bootstrap для базовой верстки

## Запуск

Проект работает в контейнерах. Основные сервисы описаны в `docker-compose.yml`:

- `nginx`
- `php`
- `mysql`
- `phpmyadmin`

Обычный запуск:

```bash
docker compose up -d
```

Если в твоем окружении используется Sail-обертка, запускай эквивалентные команды через Sail.

После запуска приложение открывается на порту из переменной `NGINX_PORT` в `.env`.

## Структура

```text
public/
  index.php                  # входная точка
  views/
    layouts/                 # layout-шаблоны
    components/              # header/footer/account blocks
    pages/                   # обычные страницы
    pages/auth/              # login/register views
    pages/authorized/        # страницы для авторизованных пользователей
    errors/                  # 404/405/500

routes/
  web.php                    # web-маршруты

src/
  App.php                    # запуск приложения
  Container/                 # сборка сервисов
  Controller/                # контроллеры
  Database/                  # PDO-подключение
  Dispatcher/                # запуск middleware и controller action
  Exception/                 # обработка исключений
  Factory/                   # создание контроллеров
  Middleware/                # middleware и resolver
  Request/                   # HTTP request wrapper
  Response/                  # HTTP response wrapper
  Routing/                   # Route и Router
  Session/                   # Auth и Flash
  Validation/                # валидаторы форм
  View/                      # рендеринг views
```

## Что уже реализовано

- Роутинг `GET` / `POST`
- Контроллеры и базовый `Controller`
- View renderer с layout
- HTML response и redirect response
- Регистрация пользователя
- Login/logout
- `password_hash()` и `password_verify()`
- Flash-сообщения через session
- Auth helper через session
- Защищенная страница `/profile`
- Middleware aliases:
  - `auth`
  - `guest`
- Middleware contract через `MiddlewareInterface`
- Controller factory
- Exception handler
- Error pages `404`, `405`, `500`

## Auth Flow

Основные маршруты:

```text
GET  /register
POST /register
GET  /login
POST /login
POST /logout
GET  /profile
```

`/profile` защищен middleware:

```php
Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware(['auth']);
```

Страницы входа и регистрации предназначены для гостей:

```php
Route::get('/login', [LoginController::class, 'showForm'])
    ->middleware(['guest']);
```

## База данных

Таблица пользователей описана в:

```text
documents/SQL/new_table_users.php
```

Ожидаемая таблица:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Архитектурная идея

Текущая цепочка запроса:

```text
public/index.php
  -> App
  -> Router::resolve()
  -> Dispatcher
  -> MiddlewareResolver
  -> ControllerFactory
  -> Controller action
  -> Response::send()
```

Если возникает исключение:

```text
Throwable
  -> ExceptionHandler
  -> View::error()
  -> Response::html()
```

## Учебные правила проекта

- Писать код постепенно и осознанно.
- Не прятать архитектуру слишком рано за магией.
- Сначала сделать явно, потом выносить в отдельные классы.
- Все пользовательские данные в HTML выводить через `htmlspecialchars`.
- SQL выполнять через prepared statements.
- Пароли хранить только через `password_hash`.

## Возможные следующие шаги

- Повесить `guest` middleware не только на `GET /login` и `GET /register`, но и на `POST /login` и `POST /register`.
- Добавить CSRF protection.
- Добавить метод `Route::name()`.
- Добавить helper для генерации URL.
- Сделать общий `Validator` или `ValidationResult`.
- Вынести работу с пользователями в `UserRepository`.
- Добавить migrations.
- Добавить тесты.

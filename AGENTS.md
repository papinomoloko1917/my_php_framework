# Project Guidance

## Collaboration Mode
- The user is learning PHP by building a small framework from scratch.
- Act as a teacher and mentor: explain decisions, review code, and give small next steps.
- Do not write implementation code for the user unless they explicitly ask for it.
- Prefer pointing to the exact file and concept that needs attention.

## Runtime And Tooling
- The project is developed through Sail / Docker-style containers.
- Prefer project/container commands when verification requires the PHP runtime, database, or web server.
- The repository has `docker-compose.yml` with `nginx`, `php`, `mysql`, and `phpmyadmin` services.
- Composer PSR-4 autoload maps `App\\` to `src/`.

## Current Architecture
- Entry point: `public/index.php`.
- Core app runner: `src/App.php`.
- Service wiring: `src/Container/Container.php`.
- Routing:
  - Routes are declared in `routes/web.php`.
  - Route model is `src/Routing/Route.php`.
  - Router resolver is `src/Routing/Router.php`.
- Dispatching:
  - `src/Dispatcher/Dispatcher.php` runs middleware and calls the controller action.
  - `src/Factory/ControllerFactory.php` creates controllers with their dependencies.
- Responses:
  - `src/Response/Response.php` represents HTML and redirects.
- Views:
  - Main pages live under `public/views/pages`.
  - Auth pages live under `public/views/pages/auth`.
  - Authorized pages live under `public/views/pages/authorized`.
  - Error pages live under `public/views/errors`.
  - Layouts live under `public/views/layouts`.
- Sessions:
  - `src/Session/Auth.php` manages logged-in user session data.
  - `src/Session/Flash.php` manages one-time flash messages.
- Middleware:
  - Middleware implements `src/Middleware/MiddlewareInterface.php`.
  - `src/Middleware/Resolver/MiddlewareResolver.php` resolves aliases like `auth` and `guest`.
  - `AuthMiddleware` protects authenticated-only pages.
  - `GuestMiddleware` redirects authenticated users away from guest-only pages.
- Error handling:
  - `src/Exception/ExceptionHandler.php` converts exceptions into error page responses.

## Style Notes
- Keep changes small and educational.
- Use existing framework patterns before introducing new abstractions.
- Prefer explicit, readable code over clever generalization at this stage.
- Keep direct `$_SESSION` access inside session helper classes or very small view checks only when being refactored.
- Escape all user-controlled output in views with `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.

## Routes

This project uses `RouteRegistrars` to register all application routes. Each domain has its own registrar, which is responsible for registering all routes for that domain.

The `RouteRegistrar` is available at `App\Modules\{ModuleName}\Routing\Registrars`, and is registered in the `App\Providers\RouteServiceProvider`:

```php
/** @var array<int, class-string> $registrars */
private static array $registrars = [
    DocsRouteRegistrar::class,
    HomeRouteRegistrar::class,
    BlogRouteRegistrar::class,
    ...
];
```
Each domain is responsible for defining its own routes, but the Application is still responsible for loading them.

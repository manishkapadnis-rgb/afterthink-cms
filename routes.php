<?php

declare(strict_types=1);

function getRoutes(): array
{
    return [
        '' => 'PageController@home',
        'home' => 'PageController@home',
        'about' => 'PageController@about',
        'services' => 'PageController@services',
        'portfolio' => 'PageController@portfolio',
        'gallery' => 'PageController@gallery',
        'process' => 'PageController@process',
        'testimonials' => 'PageController@testimonials',
        'contact' => 'PageController@contact',
        'blog' => 'PageController@blog',
        'blog/{slug}' => 'PageController@blogPost',
        'project/{slug}' => 'PageController@projectDetail',
    ];
}

function dispatchRoute(string $uri, array $routes): void
{
    if (isset($routes[$uri])) {
        callRoute($routes[$uri]);
        return;
    }

    foreach ($routes as $pattern => $handler) {
        if (strpos($pattern, '{') === false) {
            continue;
        }

        $regex = routeToRegex($pattern);
        if (preg_match($regex, $uri, $matches)) {
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            callRoute($handler, $params);
            return;
        }
    }

    http_response_code(404);
    require __DIR__ . '/app/views/errors/404.php';
}

function routeToRegex(string $route): string
{
    $pattern = preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function ($matches) {
        return '(?P<' . $matches[1] . '>[^/]+)';
    }, $route);

    return '#^' . $pattern . '$#';
}

function callRoute(string $handler, array $params = []): void
{
    [$controller, $action] = explode('@', $handler);

    if (!class_exists($controller)) {
        http_response_code(500);
        echo 'Controller not found.';
        return;
    }

    $controllerInstance = new $controller();
    if (!method_exists($controllerInstance, $action)) {
        http_response_code(500);
        echo 'Action not found.';
        return;
    }

    $controllerInstance->{$action}($params);
}

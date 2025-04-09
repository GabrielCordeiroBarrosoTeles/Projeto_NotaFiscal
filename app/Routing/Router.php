<?php

namespace App\Routing;

class Router {
    private $routes = [];
    private $basePath;

    public function __construct($basePath = '') {
        $this->basePath = rtrim($basePath, '/');
    }

    public function get($uri, $action) {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action) {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute($method, $uri, $action) {
        $uri = rtrim($uri, '/'); // Remove trailing slash
        $this->routes[$method][$uri] = $action;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Remove '/index.php' and '/public' from the URI if present
        $uri = str_replace(['/index.php', '/public'], '', $uri);

        // Remove the base path from the URI
        if (!empty($this->basePath) && strpos($uri, $this->basePath) === 0) {
            $uri = substr($uri, strlen($this->basePath));
        }

        // Ensure the URI starts with a slash after trimming
        $uri = '/' . ltrim($uri, '/');

        // Handle empty or invalid URIs
        if ($uri === '' || $uri === '/') {
            $uri = '/'; // Default to the root route
        }

        $params = []; // Initialize $params to avoid unassigned variable error

        foreach ($this->routes[$method] ?? [] as $route => $action) {
            if ($this->matchRoute($route, $uri, $params)) {
                return $this->executeAction($action, $params);
            }
        }

        // Se nenhuma rota corresponder, exibe 404
        http_response_code(404);
        echo "404 Not Found - A rota '{$uri}' não foi encontrada.";
    }

    private function matchRoute($route, $uri, &$params) {
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route);
        $routeRegex = "#^{$routeRegex}$#";

        if (preg_match($routeRegex, $uri, $matches)) {
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return true;
        }

        return false;
    }

    private function executeAction($action, $params = []) {
        if (is_callable($action)) {
            call_user_func_array($action, $params);
        } elseif (is_string($action)) {
            [$controller, $method] = explode('@', $action);
            $controller = "App\\Controllers\\$controller";
            if (class_exists($controller) && method_exists($controller, $method)) {
                $instance = new $controller();
                call_user_func_array([$instance, $method], $params);
            } else {
                http_response_code(500);
                echo "Erro: O controlador '{$controller}' ou o método '{$method}' não foi encontrado.";
            }
        } else {
            http_response_code(500);
            echo "Erro: Ação inválida para a rota.";
        }
    }
}

<?php
// core/App.php

class App
{
    private $controller = 'ConsultaController'; // Controlador por defecto
    private $method     = 'index';              // Acción por defecto
    private $params     = [];                   // Parámetros adicionales

    public function __construct()
    {
        $url = $this->parseUrl();

        // 1. Resolver controlador
        if (!empty($url[0])) {
            $possibleController = ucfirst($url[0]) . 'Controller';
            $file = __DIR__ . '/../controllers/' . $possibleController . '.php';

            if (file_exists($file)) {
                $this->controller = $possibleController;
                unset($url[0]);
            }
        }

        // Incluir archivo del controlador resuelto
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';

        // Crear instancia del controlador
        $this->controller = new $this->controller;

        // 2. Resolver método/acción
        if (!empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. El resto de segmentos de URL son parámetros
        $this->params = $url ? array_values($url) : [];

        // 4. Ejecutar acción correspondiente
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Interpreta la URL del tipo: index.php?url=consulta/buscar/123
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        return [];
    }
}

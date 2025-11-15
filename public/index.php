<?php
// public/index.php
// Controlador frontal de la aplicación

// Mostrar errores (útil en desarrollo, desactivar en producción)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Definir ruta base del proyecto (carpeta raíz que contiene /app y /public)
define('ROOT', dirname(__DIR__));

// Cargar el archivo principal del núcleo (router/App)
require_once ROOT . '/app/core/App.php';

// Iniciar la aplicación: el constructor de App resolverá
// controlador, método y parámetros según la URL
$app = new App();

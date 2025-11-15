<?php
// app/controllers/ConsultaController.php

require_once __DIR__ . '/../models/vehiculoModel.php';
require_once __DIR__ . '/../models/accesorioModel.php';

class ConsultaController
{
    private $vehiculoModel;
    private $accesorioModel;

    public function __construct()
    {
        $this->vehiculoModel  = new VehiculoModel();
        $this->accesorioModel = new AccesorioModel();
    }

    // Muestra la pantalla principal de consulta:
    // - Combos de Año_Modelo, Marca/Modelo, Accesorios y Rango de precios
    // - Listado inicial del inventario (sin filtros)
    public function index()
    {
        // Datos para los combos de filtros
        $aniosModelo   = $this->vehiculoModel->obtenerAniosModelo();
        $marcasModelos = $this->vehiculoModel->obtenerMarcasModelos();
        $accesorios    = $this->accesorioModel->obtenerAccesorios();

        // Inventario completo por defecto
        $vehiculos = $this->vehiculoModel->obtenerTodos();

        // Cargar vista principal de consulta
        // La vista usará las variables:
        // $aniosModelo, $marcasModelos, $accesorios, $vehiculos
        require __DIR__ . '/../views/consulta.php';
    }

    // Ejecuta la búsqueda aplicando los filtros de la interfaz
    public function buscar()
    {
        // Lectura de parámetros enviados por GET o POST
        $anioModelo = $_REQUEST['anio_modelo'] ?? null;
        $marca      = $_REQUEST['marca'] ?? null;
        $modelo     = $_REQUEST['modelo'] ?? null;
        $accesorio  = $_REQUEST['accesorio'] ?? null;
        $rango      = $_REQUEST['rango_precio'] ?? null;

        // Conversión del rango seleccionado a mínimo y máximo
        $precioMin = null;
        $precioMax = null;

        // Ejemplos de rangos (ajustar según cómo se definan en la vista)
        // "1" => 0 - 10000, "2" => 10000 - 20000, etc.
        if ($rango === '1') {
            $precioMin = 0;
            $precioMax = 10000;
        } elseif ($rango === '2') {
            $precioMin = 10000;
            $precioMax = 20000;
        } elseif ($rango === '3') {
            $precioMin = 20000;
            $precioMax = 30000;
        } elseif ($rango === '4') {
            $precioMin = 30000;
            $precioMax = null; // Sin límite superior
        }

        // Obtener resultados filtrados
        $vehiculos = $this->vehiculoModel->buscarVehiculos(
            $anioModelo,
            $marca,
            $modelo,
            $accesorio,
            $precioMin,
            $precioMax
        );

        // Datos para volver a pintar los combos
        $aniosModelo   = $this->vehiculoModel->obtenerAniosModelo();
        $marcasModelos = $this->vehiculoModel->obtenerMarcasModelos();
        $accesorios    = $this->accesorioModel->obtenerAccesorios();

        // Cargar la misma vista de consulta con los resultados filtrados
        require __DIR__ . '/../views/consulta.php';
    }

    // Muestra el detalle de un vehículo concreto más sus accesorios
    public function detalle($numeroSerie)
    {
        // Datos del vehículo
        $vehiculo = $this->vehiculoModel->obtenerPorNumeroSerie($numeroSerie);

        // Accesorios asociados
        $accesoriosVehiculo = $this->accesorioModel->obtenerPorVehiculo($numeroSerie);

        // Cargar vista de detalle
        // La vista usará $vehiculo y $accesoriosVehiculo
        require __DIR__ . '/../views/detalle.php';
    }

    
}

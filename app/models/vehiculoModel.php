<?php
// app/models/VehiculoModel.php

require_once __DIR__ . '/../core/Database.php';

class VehiculoModel
{
    private $db;

    public function __construct()
    {
        $database   = new Database();
        $this->db   = $database->getConnection();
    }

    // Listar todo el inventario de vehículos
    public function obtenerTodos()
    {
        $sql = "
            SELECT 
                Numero_Serie_Vehiculo,
                Marca,
                Modelo,
                Anio_Modelo,
                Color,
                Kilometraje,
                Condicion,
                Foto,
                Precio,
                Estado_Disponibilidad
            FROM Tb_Vehiculo
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Obtener valores distintos para los combos de la interfaz
    public function obtenerAniosModelo()
    {
        $sql = "
            SELECT DISTINCT Anio_Modelo
            FROM Tb_Vehiculo
            ORDER BY Anio_Modelo
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function obtenerMarcasModelos()
    {
        $sql = "
            SELECT DISTINCT Marca, Modelo
            FROM Tb_Vehiculo
            ORDER BY Marca, Modelo
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Búsqueda de vehículos según filtros de la interfaz
    public function buscarVehiculos($anioModelo = null, $marca = null, $modelo = null, $accesorio = null, $precioMin = null, $precioMax = null)
    {
        $sql = "
            SELECT DISTINCT
                v.Numero_Serie_Vehiculo,
                v.Marca,
                v.Modelo,
                v.Anio_Modelo,
                v.Color,
                v.Kilometraje,
                v.Condicion,
                v.Foto,
                v.Precio,
                v.Estado_Disponibilidad
            FROM Tb_Vehiculo v
            LEFT JOIN Tb_Accesorios_Vehiculo a
                ON v.Numero_Serie_Vehiculo = a.Numero_Serie_Vehiculo
            WHERE 1 = 1
        ";

        $params = [];

        if (!empty($anioModelo)) {
            $sql .= " AND v.Anio_Modelo = :anioModelo";
            $params[':anioModelo'] = $anioModelo;
        }

        if (!empty($marca)) {
            $sql .= " AND v.Marca = :marca";
            $params[':marca'] = $marca;
        }

        if (!empty($modelo)) {
            $sql .= " AND v.Modelo = :modelo";
            $params[':modelo'] = $modelo;
        }

        if (!empty($accesorio)) {
            $sql .= " AND a.Nombre_Accesorio = :accesorio";
            $params[':accesorio'] = $accesorio;
        }

        if (!empty($precioMin)) {
            $sql .= " AND v.Precio >= :precioMin";
            $params[':precioMin'] = $precioMin;
        }

        if (!empty($precioMax)) {
            $sql .= " AND v.Precio <= :precioMax";
            $params[':precioMax'] = $precioMax;
        }

        $stmt = $this->db->prepare($sql);

        foreach ($params as $clave => $valor) {
            $stmt->bindValue($clave, $valor);
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Detalle de un vehículo por número de serie
    public function obtenerPorNumeroSerie($numeroSerie)
    {
        $sql = "
            SELECT 
                Numero_Serie_Vehiculo,
                Marca,
                Modelo,
                Anio_Modelo,
                Color,
                Kilometraje,
                Condicion,
                Foto,
                Precio,
                Estado_Disponibilidad
            FROM Tb_Vehiculo
            WHERE Numero_Serie_Vehiculo = :numeroSerie
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':numeroSerie', $numeroSerie);
        $stmt->execute();

        return $stmt->fetch();
    }
}

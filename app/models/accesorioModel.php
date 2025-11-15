<?php
// app/models/AccesorioModel.php

require_once __DIR__ . '/../core/Database.php';

class AccesorioModel
{
    private $db;

    public function __construct()
    {
        $database   = new Database();
        $this->db   = $database->getConnection();
    }

    // Obtener todos los accesorios distintos (para el combo de la interfaz)
    public function obtenerAccesorios()
    {
        $sql = "
            SELECT DISTINCT Nombre_Accesorio
            FROM Tb_Accesorios_Vehiculo
            ORDER BY Nombre_Accesorio
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Obtener accesorios de un vehículo específico
    public function obtenerPorVehiculo($numeroSerie)
    {
        $sql = "
            SELECT 
                Numero_Serie_Vehiculo,
                Nombre_Accesorio
            FROM Tb_Accesorios_Vehiculo
            WHERE Numero_Serie_Vehiculo = :numeroSerie
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':numeroSerie', $numeroSerie);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}

<?php
class Database
{
    // Propiedades de configuración
    private $host     = 'srv1844.hstgr.io';          
    private $dbname   = 'u808897717_datos_vehicula';
    private $username = 'u808897717_calidad_sw';
    private $password = 'Calidad_SW_2025';

    // Manejador de conexión
    private $pdo;

    // Al crear el objeto, se establece la conexión
    public function __construct()
    {
        $this->connect();
    }

    // Método para obtener la conexión desde otros puntos del sistema
    public function getConnection()
    {
        return $this->pdo;
    }

    // Lógica de conexión
    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

            $this->pdo = new PDO($dsn, $this->username, $this->password);

            // Configuración recomendada de PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // En un entorno de producción se debería registrar el error y mostrar un mensaje genérico
            die('Error de conexión a la base de datos.');
        }
    }
}
?>

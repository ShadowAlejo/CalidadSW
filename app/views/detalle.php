<?php
// Vista: app/views/detalle.php
// Variables esperadas desde el controlador:
// $vehiculo          -> datos del vehículo seleccionado
// $accesoriosVehiculo -> lista de accesorios asociados
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Vehículo</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="contenedor-consulta">

    <h1>Detalle de Vehículo</h1>

    <div class="tabs">
        <span class="tab">Parámetros Consulta</span>
        <span class="tab">Listado de Vehículos</span>
        <span class="tab activa">Detalle de Vehículo</span>
        <span class="tab">Comprar Vehículo</span>
    </div>

    <?php if (!empty($vehiculo)) : ?>
        <div class="detalle-vehiculo">

            <div class="detalle-columna">
                <p><strong>Núm. Serie:</strong>
                    <?php echo htmlspecialchars($vehiculo['Numero_Serie_Vehiculo']); ?></p>
                <p><strong>Marca:</strong>
                    <?php echo htmlspecialchars($vehiculo['Marca']); ?></p>
                <p><strong>Modelo:</strong>
                    <?php echo htmlspecialchars($vehiculo['Modelo']); ?></p>
                <p><strong>Año-Modelo:</strong>
                    <?php echo htmlspecialchars($vehiculo['Anio_Modelo']); ?></p>
                <p><strong>Color:</strong>
                    <?php echo htmlspecialchars($vehiculo['Color']); ?></p>
                <p><strong>Kilometraje:</strong>
                    <?php echo htmlspecialchars($vehiculo['Kilometraje']); ?></p>
                <p><strong>Condición:</strong>
                    <?php echo htmlspecialchars($vehiculo['Condicion']); ?></p>
                <p><strong>Precio:</strong>
                    <?php echo htmlspecialchars($vehiculo['Precio']); ?></p>
                <p><strong>Disponibilidad:</strong>
                    <?php echo htmlspecialchars($vehiculo['Estado_Disponibilidad']); ?></p>
            </div>

            <div class="detalle-columna imagen">
                <?php if (!empty($vehiculo['Foto'])) : ?>
                    <img src="<?php echo htmlspecialchars($vehiculo['Foto']); ?>"
                         alt="Foto vehículo"
                         class="detalle-foto">
                <?php else : ?>
                    <div class="detalle-foto-placeholder">
                        Sin imagen disponible
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <h2>Accesorios del Vehículo</h2>

        <?php if (!empty($accesoriosVehiculo)) : ?>
            <ul class="lista-accesorios">
                <?php foreach ($accesoriosVehiculo as $acc) : ?>
                    <li><?php echo htmlspecialchars($acc['Nombre_Accesorio']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Este vehículo no tiene accesorios registrados.</p>
        <?php endif; ?>

    <?php else : ?>
        <p>No se encontró la información del vehículo solicitado.</p>
    <?php endif; ?>

    <p style="margin-top:15px;">
        <a href="?url=consulta/index">&laquo; Volver a la consulta</a>
    </p>

</div>

<script src="/js/script.js"></script>
</body>
</html>

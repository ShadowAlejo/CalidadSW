<?php
// Vista: app/views/consulta.php
// Variables esperadas desde el controlador:
// $aniosModelo, $marcasModelos, $accesorios, $vehiculos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Venta Vehículos por Internet</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="contenedor-consulta">

    <h1>Venta Vehículos por Internet</h1>

    <!-- Pestañas simples (solo visual, la funcionalidad principal es "Parámetros Consulta") -->
    <div class="tabs">
        <span class="tab activa">Parámetros Consulta</span>
        <span class="tab">Listado de Vehículos</span>
        <span class="tab">Detalle de Vehículo</span>
        <span class="tab">Comprar Vehículo</span>
    </div>

    <!-- Formulario de filtros -->
    <form method="get" action="?url=consulta/buscar" class="form-consulta">
        <div class="fila-filtro">
            <label for="anio_modelo">Año_Modelo</label>
            <select name="anio_modelo" id="anio_modelo">
                <option value="">Todos</option>
                <?php if (!empty($aniosModelo)) : ?>
                    <?php foreach ($aniosModelo as $fila) : ?>
                        <option value="<?php echo htmlspecialchars($fila['Anio_Modelo']); ?>">
                            <?php echo htmlspecialchars($fila['Anio_Modelo']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="fila-filtro">
            <label for="marca">Marca</label>
            <select name="marca" id="marca">
                <option value="">Todas</option>
                <?php
                // Construir lista de marcas únicas a partir de $marcasModelos
                $marcasUnicas = [];
                if (!empty($marcasModelos)) {
                    foreach ($marcasModelos as $mm) {
                        if (!in_array($mm['Marca'], $marcasUnicas, true)) {
                            $marcasUnicas[] = $mm['Marca'];
                        }
                    }
                }
                ?>
                <?php foreach ($marcasUnicas as $marca) : ?>
                    <option value="<?php echo htmlspecialchars($marca); ?>">
                        <?php echo htmlspecialchars($marca); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="fila-filtro">
            <label for="modelo">Modelo</label>
            <select name="modelo" id="modelo">
                <option value="">Todos</option>
                <?php
                // Construir lista de modelos únicos a partir de $marcasModelos
                $modelosUnicos = [];
                if (!empty($marcasModelos)) {
                    foreach ($marcasModelos as $mm) {
                        if (!in_array($mm['Modelo'], $modelosUnicos, true)) {
                            $modelosUnicos[] = $mm['Modelo'];
                        }
                    }
                }
                ?>
                <?php foreach ($modelosUnicos as $modelo) : ?>
                    <option value="<?php echo htmlspecialchars($modelo); ?>">
                        <?php echo htmlspecialchars($modelo); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="fila-filtro">
            <label for="accesorio">Accesorios</label>
            <select name="accesorio" id="accesorio">
                <option value="">Todos</option>
                <?php if (!empty($accesorios)) : ?>
                    <?php foreach ($accesorios as $acc) : ?>
                        <option value="<?php echo htmlspecialchars($acc['Nombre_Accesorio']); ?>">
                            <?php echo htmlspecialchars($acc['Nombre_Accesorio']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="fila-filtro">
            <label for="rango_precio">Rango de Precios</label>
            <select name="rango_precio" id="rango_precio">
                <option value="">Todos</option>
                <option value="1">0 - 10,000</option>
                <option value="2">10,000 - 20,000</option>
                <option value="3">20,000 - 30,000</option>
                <option value="4">Mayor a 30,000</option>
            </select>
        </div>

        <div class="fila-filtro">
            <button type="submit">Buscar</button>
        </div>
    </form>

    <!-- Listado de vehículos (inventario o resultados filtrados) -->
    <h2>Listado de Vehículos</h2>

    <?php if (!empty($vehiculos)) : ?>
        <table class="tabla-vehiculos">
            <thead>
                <tr>
                    <th>Núm. Serie</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Kilometraje</th>
                    <th>Condición</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehiculos as $v) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($v['Numero_Serie_Vehiculo']); ?></td>
                        <td><?php echo htmlspecialchars($v['Marca']); ?></td>
                        <td><?php echo htmlspecialchars($v['Modelo']); ?></td>
                        <td><?php echo htmlspecialchars($v['Anio_Modelo']); ?></td>
                        <td><?php echo htmlspecialchars($v['Color']); ?></td>
                        <td><?php echo htmlspecialchars($v['Kilometraje']); ?></td>
                        <td><?php echo htmlspecialchars($v['Condicion']); ?></td>
                        <td><?php echo htmlspecialchars($v['Precio']); ?></td>
                        <td><?php echo htmlspecialchars($v['Estado_Disponibilidad']); ?></td>
                        <td>
                            <a href="?url=consulta/detalle/<?php echo urlencode($v['Numero_Serie_Vehiculo']); ?>">
                                Ver
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron vehículos para los criterios seleccionados.</p>
    <?php endif; ?>

</div>

<script src="/js/script.js"></script>
</body>
</html>

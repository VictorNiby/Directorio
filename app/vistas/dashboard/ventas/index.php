<!--
ㅤㅤㅤ       ⣴⣿⣦⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢻⣿⣿⠂⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿⣀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⢠⣾⣿⣿⣿⣿⣿⣿⣦⠀
⠀⠀⠀⠀⠀⠀⣴⣿⢿⣷⠒⠲⣾⣾⣿⣿
⠀⠀⠀⠀⣴⣿⠟⠁⠀⢿⣿⠁⣿⣿⣿⠻⣿⣄⠀⠀⠀⠀
⠀⠀⣠⡾⠟⠁⠀⠀⠀⢸⣿⣸⣿⣿⣿⣆⠙⢿⣷⡀⠀⠀
⣰⡿⠋⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⠀⠀⠉⠻⣿⡀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⣾⣿⣿⣿⣿⣿⣿⣆⠀
⠀⠀⠀⠀⠀⠀⠀⠀⣼⣿⣿⣿⡿⣿⣿⣿⣿⡄⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⢠⣿⣿⠿⠟⠀⠀⠻⣿⣿⡇⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⢀⣾⡿⠃⠀⠀⠀⠀⠀⠘⢿⣿⡀⠀⠀⠀
⠀⠀⠀⠀⠀⣰⣿⡟⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣷⡀⠀⠀
⠀⠀⠀⠀⢠⣿⠟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠻⣿⣧⠀⠀
⠀⠀⠀⢀⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⣿⣆⠀
⠀⠀⠠⢾⠇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣷⡤⠄
* * * * * * * * * * * * * * * * * * * * *
* -> Inclusión de generos (plantillas)  *
* * * * * * * * * * * * * * * * * * * * *
-->
<?php
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/header.php';
?>
    <!--
    * * * * * * * * * * * * * * *
    * -> Estilos personalizados *
    * * * * * * * * * * * * * * *
    -->
    <style>
    .bg-admin {
        background-color: #007bff;  
    }
    .bg-cliente {
        background-color: #28a745;
    }
    .bg-proveedor {
        background-color:rgb(255, 143, 7);
    }
    .bg-otro {
        background-color: #6c4f97;
    }
    .bg-gradient-sunshine {
        background: linear-gradient(90deg,rgb(255, 153, 0),rgb(253, 179, 42));    
    }
    .bg-gradient-deepocean {
        background: linear-gradient(90deg,rgb(66, 76, 219),rgb(91, 100, 224));
    }
    .bg-gradient-touchgrass {
        background: linear-gradient(90deg,rgb(62, 175, 88),rgb(80, 195, 90));
    }
    .bg-gradient-netherwart {
        background: linear-gradient(90deg,rgb(224, 57, 57),rgb(228, 75, 75));
    }

    .resumen-box {
        background: linear-gradient(135deg, #0056b3, #007bff );
        border-radius: 20px;
    }

    .productos-box {
        background: linear-gradient(135deg, #007bff, #0056b3 );
        border-radius: 20px;
    }

    .venta-label {
        font-weight: 600;
        font-size: 0.85rem;
        color:rgb(255, 255, 255);
    }
    
    .text-white-5{
        opacity: 0.8;
    }

    .venta-info {
        font-size: 1.05rem;
        font-weight: 500;
        color: #212529;
        background-color: #ffffff;
        padding: 10px 15px;
        border-radius: 10px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    </style>
    <!--
    * * * * * * * * * * * * * * * *
    * -> Página Principal Ventas  *
    * * * * * * * * * * * * * * * *
    -->
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <!--
                    * * * * * * * * * * * * * * * * * *
                    * -> Encabezado de pagina Ventas  *
                    * * * * * * * * * * * * * * * * * *
                    -->
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 pb-4">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize mb-0 d-flex align-items-center">
                                Gestión de Ventas
                            </h6>
                            <!-- <button
                                class="btn btn-outline-light rounded d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 40px; height: 40px; border-radius: 8px;"
                                title="Nuevo Usuario"
                                aria-label="Nuevo Usuario"
                                data-bs-toggle="modal"
                                data-bs-target="#modalNuevoUsuario">
                                <i class="material-symbols-rounded" style="font-size: 20px;">add</i>
                            </button> -->
                        </div>
                    </div>
                </div>
                <!--
                * * * * * * * * * * * * * * *
                * -> Tabla de pagina Ventas *
                * * * * * * * * * * * * * * *
                -->
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="tablaVentas" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">#</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Servicio</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Cliente</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Documento</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Metodo de Pago</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Estado</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ventas) && is_array($ventas)): ?>
                                    <?php foreach ($ventas as $index => $venta):
                                    $numero = $index + 1;
                                    $id = (int)($venta['id'] ?? 0);
                                    $titulo = htmlspecialchars($venta['servicio'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $nombre = htmlspecialchars($venta['usuario_nombre'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $documento = htmlspecialchars($venta['usuario_documento'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $total = htmlspecialchars($venta['total'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $fecha = htmlspecialchars($venta['fecha'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $barrio = htmlspecialchars($venta['barrio'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $direccion = htmlspecialchars($venta['direccion_usuario'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $metodo = htmlspecialchars($venta['metodo_pago'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $estado = htmlspecialchars($venta['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                    ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm font-weight-bold text-center"><?= $numero ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-sm font-weight-bold mb-0 text-capitalize text-center"><?= $titulo ?></p>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-sm font-weight-bold mb-0 text-center"><?= $nombre ?></p>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-sm font-weight-bold mb-0 text-center"><?= $documento ?></p>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-sm font-weight-bold mb-0 text-center"><?= $fecha ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm <?= $estado === 'Activo' ? 'bg-gradient-success' : 'bg-gradient-secondary' ?>">
                                            <?= ucfirst($estado) ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <!--
                                        * * * * * * * * * * * * * * *
                                        * -> Boton Ver Datos Venta  *
                                        * * * * * * * * * * * * * * *
                                        -->
                                        <button class="btn btn-sm bg-gradient-deepocean text-white mb-0 px-1 py-1 me-1"
                                            style="width: 30px; height: 30px;"
                                            title="Ver Venta"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalVerVenta"
                                            onclick="cargarDatosVerVenta(
                                                <?= $id ?>, 
                                                '<?= addslashes($titulo) ?>', 
                                                '<?= addslashes($nombre) ?>', 
                                                '<?= addslashes($documento) ?>', 
                                                '<?= addslashes($total) ?>', 
                                                '<?= addslashes($fecha) ?>', 
                                                '<?= addslashes($barrio) ?>', 
                                                '<?= addslashes($direccion) ?>', 
                                                '<?= addslashes($metodo) ?>'
                                                )">
                                                <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">visibility</i>
                                        </button>
                                    </td>
                                </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="align-middle text-center py-4">
                                        <span class="text-sm text-secondary">
                                            <i class="material-symbols-rounded opacity-10 me-1">info</i>
                                            No hay ventas registradas
                                        </span>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div id="paginacionUsuarios" class="mt-3 d-flex justify-content-center gap-1 font-weight-bold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--
    * * * * * * * * * * * * * * *
    * -> Ver Datos De la Venta  *
    * * * * * * * * * * * * * * *
    -->
    <div class="modal fade" id="modalVerVenta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">

        <div class="modal-body p-4">
            <div class="row g-4">
                <div class="col-md-5">
                    <div class="card resumen-box text-white p-4 h-100 rounded-4">
                    <h5 class="mb-3 text-white d-flex justify-content-center">Datos del Servicio</h5>
                    <p class="mb-2 fw-bold">Nombre: <span class="text-white-5" id="verVentaTitulo"></span></p>
                    <p class="mb-2 fw-bold">Precio: <span class="text-white-5">$<span id="verVentaTotal"></span></span></p>
                    <p class="mb-2 fw-bold">Método de Pago: <span class="text-white-5" id="verVentaMetodo"></span></p>
                    <p class="mb-0 fw-bold">Fecha: <span class="text-white-5" id="verVentaFecha"></span></p>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-outline-white rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cerrar
                        </button>
                    </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card productos-box p-4 h-100 rounded-4">
                    <h5 class="text-primary mb-3 text-white d-flex justify-content-center">Datos del Cliente</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                        <label class="venta-label">Nombre</label>
                        <div class="venta-info" id="verVentaNombre"></div>
                        </div>
                        <div class="col-md-6">
                        <label class="venta-label">Documento</label>
                        <div class="venta-info" id="verVentaDocumento"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <label class="venta-label">Barrio</label>
                        <div class="venta-info" id="verVentaBarrio"></div>
                        </div>
                        <div class="col-md-6">
                        <label class="venta-label">Dirección</label>
                        <div class="venta-info" id="verVentaDireccion"></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</main>
    <!--
    * * * * * * * * * * * * * * * *
    * -> Javascript con funciones *
    * * * * * * * * * * * * * * * *
    -->
    <script>
        /* * * * * * * * * * * * * * * * * *
        * -> Cargar la modal ver usuario  *
        * * * * * * * * * * * * * * * * * */ 
        function setTextWithTooltip(id, value, maxLength = 15) {
            const el = document.getElementById(id);
            if (!el) return;
            el.innerText = value.length > maxLength ? value.slice(0, maxLength) + '...' : value;
            el.title = value; // Tooltip con el valor completo
        }

        function cargarDatosVerVenta(id, titulo, nombre, documento, total, fecha, barrio, direccion, metodo) {
            setTextWithTooltip('verVentaTitulo', titulo);
            setTextWithTooltip('verVentaNombre', nombre);
            setTextWithTooltip('verVentaDocumento', documento);
            setTextWithTooltip('verVentaTotal', total);
            setTextWithTooltip('verVentaFecha', fecha);
            setTextWithTooltip('verVentaBarrio', barrio);
            setTextWithTooltip('verVentaDireccion', direccion);
            setTextWithTooltip('verVentaMetodo', metodo);
        }
        /* * * * * * * * * * * * * * *
        * -> Paginacion de la tabla *
        * * * * * * * * * * * * * * */ 
        const filasPorPagina = 5
        document.addEventListener('DOMContentLoaded', function() {
            const cuerpo = document.querySelector('.table-responsive tbody');
            const filas = Array.from(cuerpo.querySelectorAll('tr'));
            const paginacion = document.getElementById('paginacionUsuarios');
            if (filas.length <= filasPorPagina) {
                paginacion.style.display = 'none';
                return;
            }
            let paginaActual = 1;
            const totalPaginas = Math.ceil(filas.length / filasPorPagina);
            function mostrarPagina(pagina) {
                paginaActual = pagina;
                const inicio = (pagina - 1) * filasPorPagina;
                const fin = inicio + filasPorPagina;
                filas.forEach((fila, i) => {
                    fila.style.display = (i >= inicio && i < fin) ? 'table-row' : 'none';
                });
                actualizarPaginacion();
            }
            function actualizarPaginacion() {
                paginacion.innerHTML = '';
                paginacion.style.display = 'flex';
                if (paginaActual > 1) {
                    const btnAnterior = document.createElement('button');
                    btnAnterior.className = 'btn btn-sm btn-outline-dark';
                    btnAnterior.innerHTML = '&laquo;';
                    btnAnterior.addEventListener('click', () => mostrarPagina(paginaActual - 1));
                    paginacion.appendChild(btnAnterior);
                }
                const inicioPaginas = Math.max(1, paginaActual - 2);
                const finPaginas = Math.min(totalPaginas, paginaActual + 2);
                for (let i = inicioPaginas; i <= finPaginas; i++) {
                    const btn = document.createElement('button');
                    btn.className = 'btn btn-sm ' + (i === paginaActual ? 'btn-dark' : 'btn-outline-dark');
                    btn.textContent = i;
                    btn.addEventListener('click', () => mostrarPagina(i));
                    paginacion.appendChild(btn);
                }
                if (paginaActual < totalPaginas) {
                    const btnSiguiente = document.createElement('button');
                    btnSiguiente.className = 'btn btn-sm btn-outline-dark';
                    btnSiguiente.innerHTML = '&raquo;';
                    btnSiguiente.addEventListener('click', () => mostrarPagina(paginaActual + 1));
                    paginacion.appendChild(btnSiguiente);
                }
            }
            mostrarPagina(1);
        });
    </script>
    <!--
    * * * * * * * * * * * * * * * * * * * * *
    * -> Inclusión de generos (plantillas)  *
    * * * * * * * * * * * * * * * * * * * * *
    -->

<?php include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/footer.php'; ?>
<script type="module" src="<?= URL_BASE ?>/js/users/users.js"></script>
    <?php
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/header.php';
?>
<style>
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
</style>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                                <!-- Encabezado de la tarjeta -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 pb-4">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize mb-0 d-flex align-items-center">
                            <!-- <i class="material-symbols-rounded opacity-10 me-2">location_city</i> -->
                            Gestión de Categorías
                        </h6>
                            <button
                                class="btn btn-outline-light rounded d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 40px; height: 40px; border-radius: 8px;"
                                title="Nueva Categoria"
                                aria-label="Nueva Categoria"
                                data-bs-toggle="modal"
                                data-bs-target="#modalNuevaCategoria">
                                <i class="material-symbols-rounded" style="font-size: 20px;">add</i>
                            </button>
                    </div>
                </div>
            </div>
                            <!-- Cuerpo de la tarjeta -->
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="tablaCategorias" class="table table-striped table-bordered align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">#</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 ps-2">Nombre</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Estado</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data) && is_array($data)): ?>
                                    <?php foreach ($data as $index => $categoria):
                                        $numero = $index + 1;
                                        $id = (int)($categoria['id_categoria'] ?? 0);
                                        $nombre = htmlspecialchars($categoria['nombre'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $estado = htmlspecialchars($categoria['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                    ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-bold"><?= $numero ?></span>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-sm font-weight-bold mb-0 text-capitalize"><?= $nombre ?></p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm <?= $estado === 'Activo' ? 'bg-gradient-success' : 'bg-gradient-secondary' ?>">
                                                    <?= ucfirst($estado) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-sm bg-gradient-sunshine text-white mb-0 px-1 py-1 me-1"
                                                    style="width: 30px; height: 30px;"
                                                    title="Editar categoría"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarCategoria"
                                                    onclick="cargarDatosEditar(<?= $id ?>, '<?= addslashes($nombre) ?>')">
                                                    <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">edit</i>
                                                </button>
                                                <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                    <input type="hidden" name="page" value="categories">
                                                    <input type="hidden" name="delete" value="<?= $id ?>">
                                                    <button type="submit" class="btn btn-sm bg-gradient-netherwart text-white mb-0 px-1 py-1"
                                                        style="width: 30px; height: 30px;"
                                                        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                                        title="Eliminar categoría">
                                                        <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="align-middle text-center py-4">
                                            <span class="text-sm text-secondary">
                                                <i class="material-symbols-rounded opacity-10 me-1">info</i>
                                                No hay categorías registradas
                                            </span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div id="paginacionCategorias" class="mt-3 d-flex justify-content-center gap-1 font-weight-bold"></div>
                    </div>
                </div>
        </div>
    </div>
</div>


<!-- Modal Nuevo Categoría -->
<div class="modal fade" id="modalNuevaCategoria" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark shadow-dark">
                <h5 class="modal-title text-white">
                    Nueva Categoría
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="rutas.php?page=categories" method="POST">
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-primary" name="action" value="insert">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Categoría -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark shadow-dark">
                <h5 class="modal-title text-white">
                    Editar Categoría
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="rutas.php?page=categories" method="POST">
                <input type="hidden" name="id" id="editId">
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" id="editNombreCategoria" class="form-control" required value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-primary" name="action" value="update">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const filasPorPagina = 10;
    document.addEventListener('DOMContentLoaded', function () {
        const cuerpo = document.querySelector('.table-responsive tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionCategorias'); // Adaptado a categorías

        // Si hay pocas filas, no mostramos paginación
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

            // Botón Anterior
            if (paginaActual > 1) {
                const btnAnterior = document.createElement('button');
                btnAnterior.className = 'btn btn-sm btn-outline-dark';
                btnAnterior.innerHTML = '&laquo;';
                btnAnterior.addEventListener('click', () => mostrarPagina(paginaActual - 1));
                paginacion.appendChild(btnAnterior);
            }

            // Botones de páginas
            const inicioPaginas = Math.max(1, paginaActual - 2);
            const finPaginas = Math.min(totalPaginas, paginaActual + 2);

            for (let i = inicioPaginas; i <= finPaginas; i++) {
                const btn = document.createElement('button');
                btn.className = 'btn btn-sm ' + (i === paginaActual ? 'btn-dark' : 'btn-outline-dark');
                btn.textContent = i;
                btn.addEventListener('click', () => mostrarPagina(i));
                paginacion.appendChild(btn);
            }

            // Botón Siguiente
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

    // Función para cargar datos al modal de edición de categorías
    function cargarDatosEditar(id, nombre) {
        document.getElementById('editId').value = id;
        document.getElementById('editNombreCategoria').value = nombre;
    }
</script>



<?php include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/footer.php'; ?>

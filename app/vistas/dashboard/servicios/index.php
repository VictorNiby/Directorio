<?php
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/header.php';
?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <!-- Encabezado de la tarjeta -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 ms-2">
                            <!-- <i class="material-symbols-rounded opacity-10 me-2">room_service</i> -->
                            Gestión de Servicios
                        </h6>
                        <button class="btn btn-sm btn-outline-light me-3 rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 38px;"
                            title="Nuevo servicio"
                            data-bs-toggle="modal"
                            data-bs-target="#modalNuevoServicio">
                            <i class="material-symbols-rounded" style="font-size: 1.2rem;">add</i>
                        </button>
                    </div>
                </div>
                <!-- Cuerpo de la tarjeta -->
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">#</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 ps-2">Título</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Precio</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Categoría</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Estado</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($services) && is_array($services)): ?>
                                    <?php foreach ($services as $index => $service):
                                        $numero = $index + 1;
                                        $id = (int)($service['id_servicio'] ?? 0);
                                        $titulo = htmlspecialchars($service['titulo'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $descripcion = htmlspecialchars($service['descripcion'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $precio = htmlspecialchars($service['precio'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $categoria = htmlspecialchars($service['categoria'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $estado = htmlspecialchars($service['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                    ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-bold"><?= $numero ?></span>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-sm font-weight-bold mb-0 text-capitalize"><?= $titulo ?></p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-bold">$<?= number_format($precio, 0) ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-bold text-capitalize"><?= $categoria ?></span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm <?= $estado === 'Activo' ? 'bg-gradient-success' : 'bg-gradient-secondary' ?>">
                                                    <?= ucfirst($estado) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-sm bg-gradient-secondary text-white mb-0 px-1 py-1 rounded-circle me-1"
                                                    style="width: 30px; height: 30px;"
                                                    title="Ver servicio"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalVerServicio"
                                                    onclick="cargarDatosVerServicio(<?= $id ?>, '<?= addslashes($titulo) ?>', '<?= addslashes($descripcion) ?>', '<?= addslashes($precio) ?>')">
                                                    <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">visibility</i>
                                                </button>
                                                <button class="btn btn-sm bg-gradient-warning text-white mb-0 px-1 py-1 rounded-circle me-1"
                                                    style="width: 30px; height: 30px;"
                                                    title="Editar servicio"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarServicio"
                                                    data-id="<?= $id ?>"
                                                    data-titulo="<?= addslashes($titulo) ?>"
                                                    data-descripcion="<?= addslashes($descripcion) ?>"
                                                    data-precio="<?= addslashes($precio) ?>"
                                                    id="btnEdit">
                                                    <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">edit</i>
                                                </button>
                                                <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                    <input type="hidden" name="page" value="services">
                                                    <input type="hidden" name="deleteService" value="<?= $id ?>">
                                                    <button type="submit" class="btn btn-sm bg-gradient-danger text-white mb-0 px-1 py-1 rounded-circle"
                                                        style="width: 30px; height: 30px;"
                                                        onclick="return confirm('¿Estás seguro de eliminar este servicio?')"
                                                        title="Eliminar servicio">
                                                        <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="align-middle text-center py-4">
                                            <span class="text-sm text-secondary">
                                                <i class="material-symbols-rounded opacity-10 me-1">info</i>
                                                No hay servicios registrados
                                            </span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div id="paginacionServicios" class="mt-3 d-flex justify-content-center gap-1 font-weight-bold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- MODALES -->

    <!-- Nuevo Servicio -->
    <div class="modal fade modal-xl" id="modalNuevoServicio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=services" method="POST" enctype="multipart/form-data">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-concierge-bell me-2"></i> Nuevo Servicio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Precio</label>
                                    <input type="number" step="0.01" name="precio" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Imagen</label>
                                    <input type="file" accept="image/*" name="servicio_imagen" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Dueño</label>
                                    <select name="usuario_id" class="form-select" required>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= $user['id_usuario'] ?>"><?= htmlspecialchars($user['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Categoría</label>
                                    <select name="categoria_id" class="form-select" required>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['id_categoria'] ?>"><?= htmlspecialchars($category['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Barrio</label>
                                    <select name="barrio_id" class="form-select" required>
                                        <?php foreach ($hoods as $hood): ?>
                                            <option value="<?= $hood['id_barrio'] ?>"><?= htmlspecialchars($hood['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" name="direccion" class="form-control">
                                </div>
                            </div>
                            
                        </div>

                        

                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="insertService">Guardar</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>

    <!-- Editar Servicio -->
    <div class="modal fade" id="modalEditarServicio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=services" method="POST">
                    <input type="hidden" name="id_servicio" id="editServicioId">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Editar Servicio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" id="editServicioTitulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" id="editServicioDescripcion" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" name="precio" id="editServicioPrecio" class="form-control" required>
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="updateService">Guardar cambios</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>

<script>
    const filasPorPagina = 10;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar botones de editar
        const btnsEdit = document.querySelectorAll('#btnEdit');
        btnsEdit.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('editServicioId').value = this.dataset.id;
                document.getElementById('editServicioTitulo').value = this.dataset.titulo;
                document.getElementById('editServicioDescripcion').value = this.dataset.descripcion;
                document.getElementById('editServicioPrecio').value = this.dataset.precio;
            });
        });
        
        // Configurar paginación
        const cuerpo = document.querySelector('.table-responsive tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionServicios');
        
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
    
    function cargarDatosVerServicio(id, titulo, descripcion, precio) {
        document.getElementById('verServicioTitulo').textContent = titulo;
        document.getElementById('verServicioDescripcion').textContent = descripcion;
        document.getElementById('verServicioPrecio').textContent = new Intl.NumberFormat().format(precio);
    }
</script>
<?php include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/footer.php'; ?>
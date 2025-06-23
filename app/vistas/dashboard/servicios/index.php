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
                            Gestión de Servicios
                        </h6>
                        <button
                            class="btn btn-outline-light rounded d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 40px; height: 40px; border-radius: 8px;"
                            title="Nuevo Servicio"
                            aria-label="Nuevo Servicio"
                            data-bs-toggle="modal"
                            data-bs-target="#modalNuevoServicio">
                            <i class="material-symbols-rounded" style="font-size: 20px;">add</i>
                        </button>
                    </div>
                </div>
            </div>
                            <!-- Cuerpo de la tarjeta -->
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="tablaServicios" class="table table-striped table-bordered align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">#</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Título</th>
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
                                                <button class="btn btn-sm bg-gradient-deepocean text-white mb-0 px-1 py-1 me-1"
                                                    style="width: 30px; height: 30px;"
                                                    title="Ver servicio"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalVerServicio"
                                                    onclick='cargarDatosVerServicio(<?= $id ?>, <?= json_encode($titulo) ?>, <?= json_encode($descripcion) ?>, <?= json_encode($precio) ?>)'>
                                                    <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">visibility</i>
                                                </button>
                                                <button class="btn btn-sm bg-gradient-sunshine text-white mb-0 px-1 py-1 me-1"
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
                                                    <button type="submit" class="btn btn-sm bg-gradient-netherwart text-white mb-0 px-1 py-1"
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

    <!-- MODALES -->


    <!-- Nuevo Servicio -->
<!--
* * * * * * * * * * * * * * * * * * *
* -> Crear Nuevo Servicio           *
* * * * * * * * * * * * * * * * * * *
-->
<div class="modal fade modal-lg" id="modalNuevoServicio" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="rutas.php?page=services" method="POST" enctype="multipart/form-data">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title text-white">
                        <i class="fas fa-concierge-bell me-2"></i> Nuevo Servicio
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Descripción</label> 
                                <textarea name="descripcion" class="form-control border border-1 rounded shadow-sm px-2" rows="2" required></textarea>
                            </div>
                        </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" step="0.01" name="precio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Dirección</label>
                                <input type="text" name="direccion" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Dueño</label>
                                <select name="usuario_id" class="form-select border border-1 rounded shadow-sm px-2 py-2" required>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id_usuario'] ?>"><?= htmlspecialchars($user['nombre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Categoría</label>
                                <select name="categoria_id" class="form-select border border-1 rounded shadow-sm px-2 py-2" required>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id_categoria'] ?>"><?= htmlspecialchars($category['nombre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Barrio</label>
                                <select name="barrio_id" class="form-select border border-1 rounded shadow-sm px-2 py-2" required>
                                    <?php foreach ($hoods as $hood): ?>
                                        <option value="<?= $hood['id_barrio'] ?>"><?= htmlspecialchars($hood['nombre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="file" accept="image/*" name="servicio_imagen" class="form-control border border-1 rounded shadow-sm px-2 py-2" required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="action" value="insertService">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--
* * * * * * * * * * * *
* -> Editar Servicio  *
* * * * * * * * * * * *
-->
<div class="modal fade modal-lg" id="modalEditarServicio" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="rutas.php?page=services" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_servicio" id="editServicioId">
        
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title text-white">
            <i class="fas fa-edit me-2"></i> Editar Servicio
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        
        <div class="modal-body">
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" id="editServicioTitulo" class="form-control" required>
          </div>

          <div class="col-12">
            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <textarea name="descripcion" id="editServicioDescripcion" class="form-control border border-1 rounded shadow-sm px-2" rows="2" required></textarea>
            </div>
          </div>

          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" id="editServicioPrecio" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" name="action" value="updateService">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Ver Servicio -->
<div class="modal fade" id="modalVerServicio" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4">
      
      <header class="modal-header bg-gradient bg-info text-white rounded-top-4 px-4 py-3">
        <h5 class="modal-title d-flex align-items-center m-0 text-white">
          <i class="material-symbols-rounded me-2 fs-4">visibility</i>
          <span class="fw-semibold">Detalles del Servicio</span>
        </h5>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </header>
      
      <main class="modal-body px-4 py-3">
        <div class="mb-3">
          <label class="form-label fw-semibold text-muted">Título</label>
          <div class="fs-5 text-dark" id="verServicioTitulo"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold text-muted">Descripción</label>
          <div class="fs-6 text-body" id="verServicioDescripcion"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold text-muted">Precio</label>
          <div class="fs-5 text-success">$<span id="verServicioPrecio"></span></div>
        </div>
      </main>
      
      <footer class="modal-footer bg-light border-0 rounded-bottom-4 px-4 py-3">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="material-symbols-rounded me-1">close</i> Cerrar
        </button>
      </footer>
      
    </div>
  </div>
</div>



<script>
    const filasPorPagina = 5;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar botones de editar
        const btnsEdit = document.querySelectorAll('#btnEdit');
        btnsEdit.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('editServicioId').value = this.dataset.id;
                document.getElementById('editServicioTitulo').value = this.dataset.titulo;
                document.getElementById('editServicioDescripcion').value = this.dataset.descripcion;
                document.getElementById('editServicioPrecio').value = this.dataset.precio;
                        document.querySelectorAll('#modalEditarServicio .input-group').forEach(group => {
        const input = group.querySelector('input');
        if (input && input.value.trim() !== '') {
        group.classList.add('is-filled');
        } else {
        group.classList.remove('is-filled');
        }
        });  
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
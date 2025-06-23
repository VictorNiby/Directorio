<!--
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
    </style>
    <!--
    * * * * * * * * * * * * * * * * *
    * -> Página Principal Usuarios  *
    * * * * * * * * * * * * * * * * *
    -->
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <!--
                    * * * * * * * * * * * * * * * * * * *
                    * -> Encabezado de pagina Usuarios  *
                    * * * * * * * * * * * * * * * * * * *
                    -->
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 pb-4">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize mb-0 d-flex align-items-center">
                                Gestión de Usuarios
                            </h6>
                            <button
                                class="btn btn-outline-light rounded d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 40px; height: 40px; border-radius: 8px;"
                                title="Nuevo Usuario"
                                aria-label="Nuevo Usuario"
                                data-bs-toggle="modal"
                                data-bs-target="#modalNuevoUsuario">
                                <i class="material-symbols-rounded" style="font-size: 20px;">add</i>
                            </button>
                        </div>
                    </div>
                </div>
                <!--
                * * * * * * * * * * * * * * * *
                * -> Tabla de pagina Usuarios *
                * * * * * * * * * * * * * * * *
                -->
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="tablaUsuarios" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">#</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Nombre</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Correo</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Telefono</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Estado</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users) && is_array($users)): ?>
                                    <?php foreach ($users as $index => $user):
                                        $numero = $index + 1;
                                        $id = (int)($user['id_usuario'] ?? 0);
                                        $nombre = htmlspecialchars($user['nombre'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $correo = htmlspecialchars($user['correo'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $telefono = htmlspecialchars($user['telefono'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $estado = htmlspecialchars($user['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $documento = htmlspecialchars($user['documento'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $nacimiento = date('Y-m-d', strtotime($user['nacimiento'] ?? ''));
                                        $nacimiento = htmlspecialchars($nacimiento, ENT_QUOTES, 'UTF-8');
                                    ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm font-weight-bold text-center"><?= $numero ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-sm font-weight-bold mb-0 text-capitalize text-center"><?= $nombre ?></p>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-sm font-weight-bold mb-0 text-center"><?= $correo ?></p>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-sm font-weight-bold mb-0 text-center"><?= $telefono ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm <?= $estado === 'Activo' ? 'bg-gradient-success' : 'bg-gradient-secondary' ?>">
                                            <?= ucfirst($estado) ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <!--
                                        * * * * * * * * * * * * * * * *
                                        * -> Boton Ver Datos Usuario  *
                                        * * * * * * * * * * * * * * * *
                                        -->
                                        <button class="btn btn-sm bg-gradient-deepocean text-white mb-0 px-1 py-1 me-1"
                                            style="width: 30px; height: 30px;"
                                            title="Ver Usuario"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalVerUsuario"
                                            onclick="cargarDatosVerUsuario(
                                                <?= $id ?>, 
                                                '<?= addslashes($nombre) ?>', 
                                                '<?= addslashes($correo) ?>', 
                                                '<?= addslashes($telefono) ?>', 
                                                '<?= addslashes($estado) ?>', 
                                                '<?= addslashes($documento) ?>', 
                                                '<?= addslashes($nacimiento) ?>'
                                                )">
                                                <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">visibility</i>
                                        </button>
                                        <!--
                                        * * * * * * * * * * * * * * * * *
                                        * -> Boton Editar Datos Usuario *
                                        * * * * * * * * * * * * * * * * *
                                        -->
                                        <button class="btn btn-sm bg-gradient-sunshine text-white mb-0 px-1 py-1 me-1"
                                            style="width: 30px; height: 30px;"
                                            title="Editar Usuario"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditarUsuario"
                                            onclick="cargarDatosEditarUsuario(<?= $id ?>, '<?= addslashes($nombre) ?>', '<?= addslashes($correo) ?>', '<?= addslashes($telefono) ?>', '<?= addslashes($nacimiento) ?>')">
                                            <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">edit</i>
                                        </button>
                                        <!--
                                        * * * * * * * * * * * * * * * * * *
                                        * -> Boton "Borrar" Datos Usuario *
                                        * * * * * * * * * * * * * * * * * *
                                        -->
                                        <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                            <input type="hidden" name="page" value="id">
                                            <input type="hidden" name="deleteUser" value="<?= $id ?>">
                                            <button type="submit"
                                                class="btn btn-sm <?= $estado === 'Activo' ? 'bg-gradient-netherwart' : 'bg-gradient-touchgrass' ?> text-white mb-0 px-1 py-1"
                                                style="width: 30px; height: 30px;"
                                                onclick="return confirm('<?= $estado === 'Activo' ? '¿Estás seguro de desactivar este usuario?' : '¿Estás seguro de reactivar este usuario?' ?>')"
                                                title="<?= $estado === 'Activo' ? 'Desactivar usuario' : 'Reactivar usuario' ?>">
                                                <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">
                                                    <?= $estado === 'Activo' ? 'block' : 'check_circle' ?>
                                                </i>
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
                                            No hay usuarios registrados
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
    * * * * * * * * * * * * * * * *
    * -> Crear Datos Del Usuario  *
    * * * * * * * * * * * * * * * *
    -->
    <div class="modal fade modal-lg" id="modalNuevoUsuario" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=users" method="POST">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title text-white">
                            <i class="fas fa-user-plus me-2"></i> Nuevo Usuario
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Documento</label>
                                <input type="text" name="document" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                                <input type="text" id="birthdate" name="birthdate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="insertUser">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--
    * * * * * * * * * * * * * * * *
    * -> Editar Datos Del Usuario *
    * * * * * * * * * * * * * * * *
    -->
    <div class="modal fade modal-lg" id="modalEditarUsuario" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=users" method="POST">
                    <div class="modal-header bg-gradient-netherwart text-white">
                        <h5 class="modal-title text-white">
                            <i class="material-symbols-rounded me-2">edit</i> Editar Usuario
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="id">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" id="editUserNombre" name="name" class="form-control" required>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Correo</label>
                            <input type="email" id="editUserCorreo" name="email" class="form-control" required>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" id="editUserTelefono" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="text" id="editUserNacimiento" name="birthdate" class="form-control" required>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-netherwart text-white" name="action" value="updateUser">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--
    * * * * * * * * * * * * * * *
    * -> Ver Datos Del Usuario  *
    * * * * * * * * * * * * * * *
    -->
    <div class="modal fade" id="modalVerUsuario" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <header class="modal-header bg-info text-white">
                <h5 class="modal-title">
                <i class="material-symbols-rounded me-2">visibility</i> Detalles del Usuario
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </header>
            <main class="modal-body">
                <p><strong>Nombre:</strong> <span id="verUserNombre"></span></p>
                <p><strong>Correo:</strong> <span id="verUserCorreo"></span></p>
                <p><strong>Teléfono:</strong> <span id="verUserTelefono"></span></p>
                <p><strong>Documento:</strong> <span id="verUserDocumento"></span></p>
                <p><strong>Nacimiento:</strong> <span id="verUserNacimiento"></span></p>
                <p><strong>Estado:</strong> <span id="verUserEstado"></span></p>
            </main>
            <footer class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </footer>
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
    /* * * * * * * * * * * * * * * * * * *
     * -> Manejo de datatime customizado *
     * * * * * * * * * * * * * * * * * * */ 
    flatpickr("#birthdate", {
    dateFormat: "Y-m-d",
    maxDate: "today",
    defaultDate: null,
    locale: {
      firstDayOfWeek: 1
    }});
    flatpickr("#editUserNacimiento", {
    dateFormat: "Y-m-d",
    maxDate: "today",
    locale: {
    firstDayOfWeek: 1
    }});
    /* * * * * * * * * * * * * * * * * *
     * -> Cargar la modal ver usuario  *
     * * * * * * * * * * * * * * * * * */ 
    function cargarDatosVerUsuario(id, nombre, correo, telefono, estado, documento, nacimiento) {
        document.getElementById('verUserNombre').innerText = nombre;
        document.getElementById('verUserCorreo').innerText = correo;
        document.getElementById('verUserTelefono').innerText = telefono;
        document.getElementById('verUserDocumento').innerText = documento;
        document.getElementById('verUserNacimiento').innerText = nacimiento;
        document.getElementById('verUserEstado').innerText = estado;
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
    /* * * * * * * * * * * * * * * * * * *
     * -> Cargar la modal editar usuario *
     * * * * * * * * * * * * * * * * * * */ 
    function cargarDatosEditarUsuario(id, nombre, correo = '', telefono = '', nacimiento = '') {
        document.getElementById('editUserId').value = id;
        document.getElementById('editUserNombre').value = nombre;
        document.getElementById('editUserCorreo').value = correo;
        document.getElementById('editUserTelefono').value = telefono;
        document.getElementById('editUserNacimiento')._flatpickr.setDate(nacimiento);
        document.querySelectorAll('#modalEditarUsuario .input-group').forEach(group => {
        const input = group.querySelector('input');
        if (input && input.value.trim() !== '') {
        group.classList.add('is-filled');
        } else {
        group.classList.remove('is-filled');
        }
        });
        }
</script>
<!--
* * * * * * * * * * * * * * * * * * * * *
* -> Inclusión de generos (plantillas)  *
* * * * * * * * * * * * * * * * * * * * *
-->
<?php include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php'; ?>
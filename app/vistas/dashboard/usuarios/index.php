<?php

define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/header.php';
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4 shadow-sm border-1 rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="p-4 d-flex justify-content-between align-items-center bg-dark text-white">
                <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="fas fa-users me-2 fs-5"></i> Gestión de Usuarios
                </h5>
                <button class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px; transition: transform 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.15)'"
                    onmouseout="this.style.transform='scale(1)'"
                    title="Nuevo"
                    data-bs-toggle="modal"
                    data-bs-target="#modalNuevoUsuario">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- Tabla -->
            <div class="card-body p-4 bg-white">
                <div class="table-responsive">
                    <table id="tablaUsuarios" class="table table-hover table-striped table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Correo</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Num Doc</th>
                                <th class="text-center">Nacimiento</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Acciones</th>
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
                                    $documento = htmlspecialchars($user['documento'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $nacimiento = htmlspecialchars($user['nacimiento'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $rol = htmlspecialchars($user['rol'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $estado = htmlspecialchars($user['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $numero ?></td>
                                        <td class="text-center text-capitalize"><?= $nombre ?></td>
                                        <td class="text-center"><?= $correo ?></td>
                                        <td class="text-center"><?= $telefono ?></td>
                                        <td class="text-center"><?= $documento ?></td>
                                        <td class="text-center"><?= $nacimiento ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $rol === 'admin' ? 'bg-primary' : 'bg-secondary' ?>">
                                                <?= ucfirst($rol) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $estado === 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= ucfirst($estado) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm"
                                                title="Editar usuario"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarUsuario"
                                                onclick="cargarDatosEditarUsuario(<?= $id ?>, '<?= addslashes($nombre) ?>', '<?= addslashes($correo) ?>', '<?= addslashes($telefono) ?>', '<?= addslashes($rol) ?>','<?= addslashes($documento)?>','<?= addslashes($nacimiento)?>')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                <input type="hidden" name="page" value="users">
                                                <input type="hidden" name="deleteUser" value="<?= $id ?>">
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de eliminar este usuario?')"
                                                    title="Eliminar usuario">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-circle me-2"></i> No hay usuarios registrados
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div id="paginacionUsuarios" class="mt-3 d-flex justify-content-center gap-2"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALES -->

    <!-- Nuevo Usuario -->
    <div class="modal fade" id="modalNuevoUsuario" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=users" method="POST">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i> Nuevo Usuario</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Documento</label>
                                <input type="text" name="document" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="birthdate" class="form-control" required>
                            </div>
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="insertUser">Guardar</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>

    <!-- Editar Usuario -->
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=users" method="POST">
                    <input type="hidden" name="id" id="editUserId">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i> Editar Usuario</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" id="editUserNombre" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Correo</label>
                                <input type="email" name="email" id="editUserCorreo" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" id="editUserTelefono" class="form-control" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Documento</label>
                                <input type="text" name="document" id="editUserDocumento" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="birthdate" id="editUserNacimiento" class="form-control" required>
                            </div>
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="updateUser">Guardar cambios</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    const filasPorPagina = 5;
    document.addEventListener('DOMContentLoaded', function() {
        const tabla = document.getElementById('tablaUsuarios');
        const cuerpo = tabla.querySelector('tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionUsuarios');

        if (filas.length <= filasPorPagina) return;

        let paginaActual = 1;
        const totalPaginas = Math.ceil(filas.length / filasPorPagina);

        function mostrarPagina(pagina) {
            paginaActual = pagina;
            const inicio = (pagina - 1) * filasPorPagina;
            const fin = inicio + filasPorPagina;

            filas.forEach((fila, i) => {
                fila.style.display = (i >= inicio && i < fin) ? '' : 'none';
            });

            actualizarPaginacion();
        }

        function actualizarPaginacion() {
            paginacion.innerHTML = '';

            for (let i = 1; i <= totalPaginas; i++) {
                const btn = document.createElement('button');
                btn.className = 'btn btn-sm ' + (i === paginaActual ? 'btn-primary' : 'btn-outline-primary');
                btn.textContent = i;
                btn.addEventListener('click', () => mostrarPagina(i));
                paginacion.appendChild(btn);
            }
        }

        mostrarPagina(1);
    });


    function cargarDatosEditarUsuario(id, nombre, correo, telefono, rol, documento, nacimiento) {
        document.getElementById('editUserId').value = id;
        document.getElementById('editUserNombre').value = nombre;
        document.getElementById('editUserCorreo').value = correo;
        document.getElementById('editUserTelefono').value = telefono;
        document.getElementById('editUserDocumento').value = documento;
        document.getElementById('editUserNacimiento').value = nacimiento;
    }
</script>

<?php include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php'; ?>
<?php

define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/header.php';
?>
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

.bg-gradient-netherwart {
    background: linear-gradient(90deg,rgb(224, 57, 57),rgb(228, 75, 75));
}

</style>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <!-- Encabezado de la tarjeta -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 px-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize mb-0 d-flex align-items-center">
                            <!-- <i class="material-symbols-rounded opacity-10 me-2">location_city</i> -->
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


                <!-- Cuerpo de la tarjeta -->
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
                                        $nacimiento = htmlspecialchars($user['nacimiento'] ?? '', ENT_QUOTES, 'UTF-8');
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
                                                <button class="btn btn-sm bg-gradient-sunshine text-white mb-0 px-1 py-1 me-1"
                                                    style="width: 30px; height: 30px;"
                                                    title="Editar barrio"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarBarrio"
                                                    onclick="cargarDatosEditarUsuario(<?= $id ?>, '<?= addslashes($nombre) ?>', '<?= addslashes($estado) ?>')">
                                                    <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">edit</i>
                                                </button>
                                                <button class="btn btn-sm bg-gradient-deepocean text-white mb-0 px-1 py-1 me-1"
                                                    style="width: 30px; height: 30px;"
                                                    title="Ver usuario"
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
                                                <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                    <input type="hidden" name="page" value="hoods">
                                                    <input type="hidden" name="deleteHood" value="<?= $id ?>">
                                                    <button type="submit" class="btn btn-sm bg-gradient-netherwart text-white mb-0 px-1 py-1"
                                                        style="width: 30px; height: 30px;"
                                                        onclick="return confirm('¿Estás seguro de eliminar este barrio?')"
                                                        title="Eliminar barrio">
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
                                                No hay usuarios registrados
                                            </span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div id="paginacionBarrios" class="mt-3 d-flex justify-content-center gap-1 font-weight-bold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Nuevo Usuario -->
    <div class="modal fade modal-lg" id="modalNuevoUsuario" tabindex="-1">
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

    <!-- Ver Usuario -->
    <div class="modal fade" id="modalVerUsuario" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <header class="modal-header bg-info text-white">
                <h5 class="modal-title">
                <i class="material-symbols-rounded me-2">visibility</i> Detalles del Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
    const filasPorPagina = 8;
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

    /* * * * * * * * * * * * * * * * * * *
     * -> Cargar la modal editar usuario *
     * * * * * * * * * * * * * * * * * * */ 
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

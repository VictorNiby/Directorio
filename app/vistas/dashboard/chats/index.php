<?php

define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/header.php';

?>
<style>
    .modal-chat {
    max-width: 800px;
}
#contenedorMensajes {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    padding: 1rem;
}
.modal-chat .modal-body {
    background-color: #e5ddd5 !important;
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4AkEEjIZbYrB+AAAAB1pVFh0Q29tbWVudAAAAAAAQ3JlYXRlZCB3aXRoIEdJTVBkLmUHAAAAJklEQVQ4y2NgGAWjYBSMglEwCkbBKBgFgw0wovIYGRkZGRkZGQc9AwDnYgQ3WZQxJAAAAABJRU5ErkJggg==') !important;
    padding: 10px !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 8px !important;
}
</style>
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4 shadow-sm border-1 rounded-4 overflow-hidden">
        <!--"SELECT chat.id_chat, chat.fecha_creacion, pro.nombre as proovedor, cli.nombre as cliente, chat.estado FROM chat
        INNER JOIN usuario pro on usuario_id_usuario_pro = pro.id_usuario
        INNER JOIN usuario cli on usuario_id_usuario_cli = cli.id_usuario" -->
            <!-- Header -->
            <div class="p-4 d-flex justify-content-between align-items-center bg-dark text-white">
                <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="fas fa-city me-2 fs-5"></i> Gestión de Chats
                </h5>
            </div>

            <!-- Tabla -->
            <div class="card-body p-4 bg-white">
                <div class="table-responsive">
                    <table id="tablaChat" class="table table-hover table-striped table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Proovedor</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Fecha de Creacion</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($chat) && is_array($chat)): ?>
                                
                                <?php foreach ($chat as $index => $chats):
                            
                                    $numero = $index + 1;
                                    $idChat = (int)($chats['id_chat'] ?? 0);
                                    $proovedor = htmlspecialchars($chats['proovedor'] ?? 'Null');
                                    $cliente = htmlspecialchars($chats['cliente'] ?? 'Null');
                                    $fechaCreacion = $chats['fecha_creacion'] ?? '??-??-????';
                                    $estado = htmlspecialchars($chats['estado'] ?? 'Null');
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $numero ?></td>
                                        <td class="text-center text-capitalize"><?= $proovedor ?></td>
                                        <td class="text-center text-capitalize"><?= $cliente ?></td>
                                        <td class="text-center text-capitalize"><?= $fechaCreacion ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $estado === 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                                                <?=($estado) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                        <button class="btn btn-primary btn-sm"
                                            title="Ver Chat"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalVerChat"
                                            onclick="verChat(<?= $idChat ?>, <?= htmlspecialchars(json_encode($this->model->getChatById($idChat)), ENT_QUOTES, 'UTF-8') ?>)">
                                            <i class="bi bi-eye"></i>
                                        </button>


                                            <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                <input type="hidden" name="page" value="chats">
                                                <input type="hidden" name="validateChat" value="<?= $idChat ?>">
                                                <button type="submit" class="btn btn-sm <?= $estado === 'Activo' ? 'btn-success' : 'btn-danger' ?>"
                                                    onclick="return confirm('<?= $estado === 'Activo' ? '¿Estás seguro de finalizar la conversación?' : '¿Estás seguro de reactivar la conversación?' ?>')"
                                                    title="<?= $estado === 'Activo' ? 'Finalizar chat' : 'Reactivar chat' ?>">
                                                    <i class="<?= $estado === 'Activo' ? 'bi bi-floppy' : 'bi bi-pencil-square' ?>"></i>
                                                </button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-envelope-slash me-2"></i> No hay chats registrados
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div id="paginacionChat" class="mt-3 d-flex justify-content-center gap-2"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALES -->
<div class="modal fade" id="modalVerChat" tabindex="-1" aria-labelledby="modalVerChatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-chat">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold" id="modalVerChatLabel">
                    <i class="bi bi-chat-dots me-2"></i> Conversación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div id="modalChatBody" class="modal-body bg-light" style="max-height: 60vh; overflow-y: auto;">
                <div id="contenedorMensajes" class="d-flex flex-column gap-2">
                    
                </div>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



</main>

<script>
// cargar la modal al inicio
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modalVerChat');
    const modalEl = bootstrap.Modal.getOrCreateInstance(modal);

    modal.addEventListener('shown.bs.modal', () => {
        const modalBody = document.getElementById('modalChatBody');
        modalBody.scrollTop = modalBody.scrollHeight;
    });
});

function verChat(idChat, mensajes) {

    const contenedor = document.getElementById('contenedorMensajes');
    contenedor.innerHTML = '';

    if (!mensajes || mensajes.length === 0) {
        contenedor.innerHTML = '<div class="text-muted">No hay mensajes en esta conversación.</div>';
        return;
    }

    mensajes.sort((a, b) => new Date(a.fecha_envio) - new Date(b.fecha_envio));

    mensajes.forEach(msg => {
        const div = document.createElement('div');
        div.className = `p-3 rounded ${msg.usuario_id_usuario === 1 ? 'bg-primary text-white align-self-end' : 'bg-light align-self-start'}`;
        div.style.maxWidth = '75%';
        div.style.wordBreak = 'break-word';

        const fecha = msg.fecha_envio ? new Date(msg.fecha_envio) : null;
        const fechaTexto = fecha ? fecha.toLocaleString() : '';

        div.innerHTML = `
            <div class="fw-bold">${msg.usuario_id_usuario === 1 ? 'Tú' : 'Cliente'}</div>
            <div>${msg.mensaje}</div>
            <div class="text-end small ${msg.usuario_id_usuario === 1 ? 'text-white-50' : 'text-muted'}">
                ${fechaTexto}
            </div>
        `;

        contenedor.appendChild(div);
    });
}

//==========================================
const filasPorPagina = 5;
    document.addEventListener('DOMContentLoaded', function() {
        const tabla = document.getElementById('tablaChat');
        const cuerpo = tabla.querySelector('tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionChat');

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

    function cargarDatosEditarBarrio(id, nombre, estado) {
        document.getElementById('editHoodId').value = id;
        document.getElementById('editHoodNombre').value = nombre;
        document.getElementById('editHoodEstado').value = estado;
    }
</script>

<?php include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php'; ?>
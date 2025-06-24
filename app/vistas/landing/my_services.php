<?php 
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/landing/plantilla/header.php';
?>

<body>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="<?= URL_BASE ?>/rutas/rutas.php?page=home">Inicio</a>
                    <span class="breadcrumb-item active">Historial</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="container-fluid">
        <?php if(count($services) > 0) : ?>
            <div class="row px-xl-5">
                <div class="col-lg-12 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Servicio</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Estado Del Servicio</th>
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                           <?php foreach($services as $service) : ?>
                                <tr>
                                    <td class="align-middle">
                                        <img src="<?= URL_BASE ?>/publico/img/servicios/<?= $service["imagen"]?>" alt="Imagen del servicio" style="width: 50px;">
                                    </td>

                                    <td class="align-middle">
                                        <?php if($service["estado"] === "Activo") : ?>           
                                            <a href="<?= URL_BASE ?>/rutas/rutas.php?page=service&id=<?= $service["id_servicio"] ?>" class="text-dark">
                                                <?= $service["titulo"] ?>
                                            </a>
                                        <?php else : ?>
                                            <?= $service["titulo"] ?>
                                        <?php endif ?>  
                                    </td>

                                    <td class="align-middle">
                                        $<?= number_format($service["precio"]) ?>
                                    </td>

                                    <td class="align-middle">
                                        <?= date($service["fecha_creacion"]) ?>
                                    </td>

                                    <td class="align-middle">
                                        <?= $service['estado'] ?>
                                    </td>

                                    <td class="align-middle d-flex flex-row justify-content-center align-content-center">

                                        <button class="btn btn-sm btn-primary rounded rounded-5"
                                        type="button"
                                        style="margin-right: 15px;"
                                        title="Editar Servicio"
                                        data-toggle="modal"
                                        data-target="#modalUpdate"
                                        data-id="<?= $service["id_servicio"] ?>"
                                        data-titulo="<?= $service["titulo"] ?>"
                                        data-descripcion="<?= $service["descripcion"] ?>"
                                        data-precio="<?= $service["precio"] ?>"
                                        id="btnEdit">
                                            <i class="fa-solid fa-file-pen"></i>
                                        </button>

                                        <form enctype="multipart/form-data" method="post"
                                        data-estado="<?= $service["estado"] ?>" id="formDelete">
                                            <input type="text" hidden name="deleteService" value="<?= $service["id_servicio"] ?>">

                                            <button class="btn btn-sm rounded rounded-5 <?= $service["estado"] === "Activo" ? 'btn-danger' : 'btn-success' ?>"
                                            type="submit"
                                            data-service="<?= $service["id_servicio"] ?>"
                                            title="<?= $service["estado"] === "Activo" ? 'Desactivar Servicio' : 'Activar Servicio' ?> "
                                            id="btnDelete" data-estado="<?= $service["estado"] ?>">
                                                <?php if($service["estado"] === "Activo") : ?>
                                                    <i class="fa fa-times"></i>
                                                <?php else : ?>
                                                    <i class="fa-solid fa-check"></i>
                                                <?php endif ?>
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                           <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="row px-xl-5">
                <div class="col-12">
                    <div class="card w-100 p-3 text-center">
                        <p class="text-dark">No tienes ningún servicio...</p>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>

    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" method="post" id="formUpdate">
                    <div class="modal-body">
                        <input type="text" id="inputService" name="id_servicio"
                        hidden>

                        <div class="form-group">
                            <label for="inputTitulo" class="text-dark">Titulo</label>
                            <input type="text" class="form-control" id="inputTitulo" name="titulo">
                        </div>

                        <div class="form-group">
                            <label for="inputDescripcion" class="text-dark">Descripción</label>
                            <textarea name="descripcion" id="inputDescripcion" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputPrecio" class="text-dark">Precio</label>
                            <input type="number" min="1" class="form-control" id="inputPrecio" name="precio">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="module" src="<?= URL_BASE ?>/publico/js/my_services/my_services.js"></script>
<?php include_once (RUTA_BASE .'/app/vistas/landing/plantilla/footer.php'); ?>
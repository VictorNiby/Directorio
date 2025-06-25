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
                    <span class="breadcrumb-item active">Subir Nuevo Servicio</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- FORM UPLOAD START -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Subir Nuevo Servicio</span></h5>

                <div class="bg-light p-30 mb-5">
                    <form enctype="multipart/form-data" id="formUpload">
                        <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="text-dark">Título</label>
                                    <input class="form-control" type="text"
                                    name="titulo" required>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <label class="text-dark">Descripción</label>
                                    <textarea name="descripcion" class="form-control" required></textarea>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label class="text-dark">Precio</label>
                                    <input class="form-control" type="number"
                                    name="precio" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>

                                <div class="col-md-6">
                                    <label class="text-dark">Imagen Principal</label>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-dark">Galeria (opcional)</label>
                                </div>

                                <div class="col-md-6 form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Subir Imagen</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" required name="imagen" id="inputImagen" accept="image/png, image/jpeg, image/jpg">
                                            <label class="custom-file-label" for="inputImagen">
                                                Sube una imagen
                                            </label>
                                        </div>
                                    </div>
                                    <small>Formatos admitidos: png, jpg, jpeg</small>
                                </div>

                                <div class="col-md-6 form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Subir Imágenes</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="galeria[]" id="inputGaleria" multiple accept="image/png, image/jpeg, image/jpg">
                                            <label class="custom-file-label" for="inputGaleria">
                                                Sube varias imágenes
                                            </label>
                                        </div>
                                    </div>
                                    <small>Formatos admitidos: png, jpg, jpeg</small>
                                </div>

                                <div class="col-md-12 form-select">
                                    <label class="text-dark">Categoría</label>
                                    <select name="categoria" class="custom-select" required>
                                        <option value="0" selected>Selecciona Una Categoría</option>
                                        <?php foreach ($data as $category) : ?>
                                            <option value="<?= $category["id_categoria"] ?>">
                                                <?= $category["nombre"] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-4 form-select">
                                    <label class="text-dark">Barrio</label>
                                    <select name="barrio" class="custom-select">
                                        <option value="0" selected>Selecciona un barrio</option>
                                        <?php foreach ($hoods as $hood) : ?>
                                            <option value="<?= $hood["id_barrio"] ?>">
                                                <?= $hood["nombre"] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-4 form-group">
                                    <label class="text-dark">Dirección (opcional)</label>
                                    <input class="form-control" name="direccion" type="text" placeholder="Calle 10 #14-190">
                                </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">
                            Subir Servicio
                        </button>
                    </form>     
                </div>
            </div>
        </div>
    </div>
    <!-- FORM UPLOAD END -->
    
    <script type="module" src="<?=URL_BASE ?>/publico/js/uploadService/uploadService.js"></script>

<?php include_once RUTA_BASE . '/app/vistas/landing/plantilla/footer.php'; ?>
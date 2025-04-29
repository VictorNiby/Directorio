<?php 
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/header.php';
?>

<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Panel de control</li>
    </ol>

    <div class="row g-4">

      <!-- Usuarios Activos -->
      <?php if (!empty($usersActive) && is_array($usersActive)): ?>
        <?php foreach ($usersActive as $userActive): 
          $userTotal = filter_var($userActive['total'] ?? '', FILTER_VALIDATE_INT); ?>
        <div class="col-xl-3 col-md-6">
          <div class="card text-white bg-primary h-100 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <div class="card-title fs-5">Usuarios Activos</div>
                <div class="display-6"><?= $userTotal; ?></div>
              </div>
              <i class="fas fa-users fa-3x"></i>
            </div>
            <div class="card-footer bg-transparent border-top-0">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12"><p>No hay usuarios activos.</p></div>
      <?php endif; ?>

      <!-- Servicios Activos -->
      <?php if (!empty($servicesActive) && is_array($servicesActive)): ?>
        <?php foreach ($servicesActive as $serviceActive): 
          $serviceTotal = filter_var($serviceActive['total'] ?? 0, FILTER_VALIDATE_INT); ?>
        <div class="col-xl-3 col-md-6">
          <div class="card text-dark bg-warning h-100 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <div class="card-title fs-5">Servicios Activos</div>
                <div class="display-6"><?= $serviceTotal; ?></div>
              </div>
              <i class="fas fa-tools fa-3x"></i>
            </div>
            <div class="card-footer bg-transparent border-top-0">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12"><p>No hay servicios activos.</p></div>
      <?php endif; ?>

      <!-- Ingresos Servicios -->
      <?php if (!empty($moneyEarned) && is_array($moneyEarned)): ?>
        <?php foreach ($moneyEarned as $money): 
          $totalMoney = filter_var($money['total_ganado'] ?? 0, FILTER_VALIDATE_FLOAT); ?>
        <div class="col-xl-3 col-md-6">
          <div class="card text-white bg-success h-100 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <div class="card-title fs-5">Ingresos Servicios</div>
                <div class="display-6">$<?= number_format($totalMoney, 0); ?></div>
              </div>
              <i class="fas fa-hand-holding-usd fa-3x"></i>
            </div>
            <div class="card-footer bg-transparent border-top-0">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12"><p>No hay ingresos registrados.</p></div>
      <?php endif; ?>

      <!-- Ingresos Directorio -->
      <?php if (!empty($moneyOwnEarned)): ?>
        <?php foreach ($moneyOwnEarned as $moneyOwn): 
          $totalMoneyOwn = filter_var($moneyOwn['total_ganado'] ?? 0, FILTER_VALIDATE_FLOAT); ?>
        <div class="col-xl-3 col-md-6">
          <div class="card text-white bg-danger h-100 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <div class="card-title fs-5">Ingresos Directorio</div>
                <div class="display-6">$<?= number_format($totalMoneyOwn, 0); ?></div>
              </div>
              <i class="fas fa-wallet fa-3x"></i>
            </div>
            <div class="card-footer bg-transparent border-top-0">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12"><p>No hay ingresos propios.</p></div>
      <?php endif; ?>

    </div>
  </div>
</main>

<?php 
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php';
?>

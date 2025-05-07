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
        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
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
        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
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
        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
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
        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
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

      <!-- Products Start -->
      <div class="container-fluid pt-5 pb-3">
    <div class="row">
        <!-- Card para el gráfico de barras -->
        <div class="col-md-6 col-xs-12 mb-4">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white rounded-top p-3">
                    <h5 class="m-0">Gráfico de Barras</h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Card para el gráfico de dona -->
        <div class="col-md-6 col-xs-12 mb-4">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white rounded-top p-3">
                    <h5 class="m-0">Servicio mas solicitado</h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

    </div>
  </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Datos para gráfico de barras (usuarios activos por mes)
    const lineData = <?= json_encode($linedata); ?>;
    console.log(lineData);

    const barLabels = lineData.map(item => `${item.mes}-${item.anio}`);
    const barValues = lineData.map(item => parseInt(item.total));

    // Datos para gráfico de donut (servicios más solicitados)
    const dataFeatures = <?= json_encode($feature); ?>;
    const labels = dataFeatures.map(item => item.titulo);
    const values = dataFeatures.map(item => parseInt(item.total_solicitudes));

    const backgroundColors = [
        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
        '#e74a3b', '#858796', '#20c9a6', '#5a5c69'
    ];

    // Gráfico de Barras
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: barLabels,
            datasets: [{
                label: 'Usuarios Activos por Mes',
                data: barValues,
                backgroundColor: '#4e73df',
                borderColor: '#4e73df',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Usuarios Activos por Mes (Gráfico de Barras)'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `Total: ${tooltipItem.raw}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Gráfico de Donut
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Solicitudes',
                data: values,
                backgroundColor: backgroundColors
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Servicios más solicitados (Doughnut)'
                }
            }
        }
    });
});
</script>


<?php 
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php';
?>

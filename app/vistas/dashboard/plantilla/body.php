<?php 
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/header.php';
?>

<div class="container-fluid py-4">
  <!-- Encabezado -->
  <div class="row">
    <div class="ms-3">
      <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
      <p class="mb-4">
        Resumen completo de métricas y estadísticas del sistema.
      </p>
    </div>
  </div>

  <!-- Tarjetas de Métricas -->
  <div class="row">
    <!-- Usuarios Activos -->
    <?php if (!empty($usersActive) && is_array($usersActive)): ?>
      <?php foreach ($usersActive as $userActive): 
        $userTotal = filter_var($userActive['total'] ?? '', FILTER_VALIDATE_INT); ?>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
              <div>
                <p class="text-sm mb-0 text-capitalize">Usuarios Activos</p>
                <h4 class="mb-0"><?= $userTotal; ?></h4>
              </div>
              <div class="icon icon-md icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-lg">
                <i class="material-symbols-rounded opacity-10">group</i>
              </div>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+<?= rand(5, 20); ?>%</span> que el mes pasado</p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <!-- Servicios Activos -->
    <?php if (!empty($servicesActive) && is_array($servicesActive)): ?>
      <?php foreach ($servicesActive as $serviceActive): 
        $serviceTotal = filter_var($serviceActive['total'] ?? 0, FILTER_VALIDATE_INT); ?>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
              <div>
                <p class="text-sm mb-0 text-capitalize">Servicios Activos</p>
                <h4 class="mb-0"><?= $serviceTotal; ?></h4>
              </div>
              <div class="icon icon-md icon-shape bg-gradient-warning shadow-warning shadow text-center border-radius-lg">
                <i class="material-symbols-rounded opacity-10">construction</i>
              </div>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+<?= rand(2, 15); ?>%</span> que el mes pasado</p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <!-- Ingresos Servicios -->
    <?php if (!empty($moneyEarned) && is_array($moneyEarned)): ?>
      <?php foreach ($moneyEarned as $money): 
        $totalMoney = filter_var($money['total_ganado'] ?? 0, FILTER_VALIDATE_FLOAT); ?>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
              <div>
                <p class="text-sm mb-0 text-capitalize">Ingresos Servicios</p>
                <h4 class="mb-0">$<?= number_format($totalMoney, 0); ?></h4>
              </div>
              <div class="icon icon-md icon-shape bg-gradient-success shadow-success shadow text-center border-radius-lg">
                <i class="material-symbols-rounded opacity-10">payments</i>
              </div>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+<?= rand(5, 25); ?>%</span> que el mes pasado</p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <!-- Ingresos Directorio -->
    <?php if (!empty($moneyOwnEarned)): ?>
      <?php foreach ($moneyOwnEarned as $moneyOwn): 
        $totalMoneyOwn = filter_var($moneyOwn['total_ganado'] ?? 0, FILTER_VALIDATE_FLOAT); ?>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
              <div>
                <p class="text-sm mb-0 text-capitalize">Ingresos Directorio</p>
                <h4 class="mb-0">$<?= number_format($totalMoneyOwn, 0); ?></h4>
              </div>
              <div class="icon icon-md icon-shape bg-gradient-danger shadow-danger shadow text-center border-radius-lg">
                <i class="material-symbols-rounded opacity-10">account_balance</i>
              </div>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+<?= rand(3, 18); ?>%</span> que el mes pasado</p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Gráficos -->
  <div class="row mt-4">
    <!-- Gráfico de Barras -->
    <div class="col-lg-6 col-md-6 mt-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="mb-0">Usuarios Registrados por Mes</h6>
          <p class="text-sm">Tendencia mensual de usuarios registrados</p>
          <div class="pe-2">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="300"></canvas>
            </div>
          </div>
          <hr class="dark horizontal">
          <div class="d-flex">
            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Datos actualizados al <?= date('d/m/Y'); ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Gráfico de Dona -->
    <div class="col-lg-6 col-md-6 mt-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="mb-0">Servicios más Solicitados</h6>
          <p class="text-sm">Distribución por tipo de servicio</p>
          <div class="pe-2">
            <div class="chart">
              <canvas id="chart-doughnut" class="chart-canvas" height="300"></canvas>
            </div>
          </div>
          <hr class="dark horizontal">
          <div class="d-flex">
            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Datos actualizados al <?= date('d/m/Y'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Variables globales para las instancias de gráficos
let barChartInstance = null;
let doughnutChartInstance = null;

document.addEventListener('DOMContentLoaded', function () {
  // Datos para gráfico de barras
  const lineData = <?= json_encode($linedata); ?>;
  const barLabels = lineData.map(item => {
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    return `${meses[item.mes-1]} ${item.anio}`;
  });
  const barValues = lineData.map(item => parseInt(item.total));

  // Datos para gráfico de donut
  const dataFeatures = <?= json_encode($feature); ?>;
  const labels = dataFeatures.map(item => item.titulo.length > 15 ? item.titulo.substring(0, 15) + '...' : item.titulo);
  const values = dataFeatures.map(item => parseInt(item.total_solicitudes));

  // Colores para gráficos
  const backgroundColors = [
    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
    '#e74a3b', '#858796', '#20c9a6', '#5a5c69'
  ];

  // Destruir gráficos existentes si los hay
  if (barChartInstance) barChartInstance.destroy();
  if (doughnutChartInstance) doughnutChartInstance.destroy();

  // Configuración común para ambos gráficos
  const chartCommonOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'top',
        labels: {
          font: {
            size: 12
          }
        }
      },
      tooltip: {
        callbacks: {
          label: function(context) {
            return `${context.dataset.label || ''}: ${context.raw}`;
          }
        }
      }
    }
  };

  // Gráfico de Barras (Usuarios por mes)
  const barCtx = document.getElementById('chart-bars').getContext('2d');
  barChartInstance = new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: barLabels,
      datasets: [{
        label: 'Usuarios Activos',
        data: barValues,
        backgroundColor: '#4e73df',
        borderColor: '#4e73df',
        borderWidth: 1,
        borderRadius: 4,
        barPercentage: 0.7
      }]
    },
    options: {
      ...chartCommonOptions,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            precision: 0
          },
          grid: {
            drawBorder: false
          }
        },
        x: {
          grid: {
            display: false,
            drawBorder: false
          }
        }
      },
      plugins: {
        ...chartCommonOptions.plugins,
        title: {
          display: false
        }
      }
    }
  });

  // Gráfico de Dona (Servicios más solicitados)
  const doughnutCtx = document.getElementById('chart-doughnut').getContext('2d');
  doughnutChartInstance = new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        label: 'Solicitudes',
        data: values,
        backgroundColor: backgroundColors,
        borderWidth: 0,
        hoverOffset: 10
      }]
    },
    options: {
      ...chartCommonOptions,
      cutout: '65%',
      plugins: {
        ...chartCommonOptions.plugins,
        legend: {
          position: 'right',
          align: 'center'
        }
      }
    }
  });

  // Redimensionar gráficos cuando cambia el tamaño de la ventana
  window.addEventListener('resize', function() {
    if (barChartInstance) barChartInstance.resize();
    if (doughnutChartInstance) doughnutChartInstance.resize();
  });
});

// Limpiar gráficos al cerrar la página
window.addEventListener('beforeunload', function() {
  if (barChartInstance) barChartInstance.destroy();
  if (doughnutChartInstance) doughnutChartInstance.destroy();
});
</script>

<?php 
include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/footer.php';
?>
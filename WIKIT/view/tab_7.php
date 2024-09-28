<script>
    $(document).ready(function () {
    $('#example').DataTable();
    $('.dataTables_length').addClass('bs-select');
    });
</script>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>CURSO</th>
                <th>NOMBRE</th>
                <th>PAGO</th>
                <th>FECHA</th>
                <th>REF PAGO</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($filas = $resultado->fetch()) { ?>
            <tr>
                <td><?php echo $filas['id']; ?></td>
                <td><?php echo $filas['curso']; ?></td>
                <td><?php echo $filas['nombre']; ?></td>
                <td><?php echo $filas['precio']; ?></td>
                <td><?php echo $filas['fecha']; ?></td>
                <td><?php echo $filas['ref_pago']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php
// Supongamos que ya tienes tu consulta en $resultado
$data = [];
while ($fila = $resultados->fetch()) {
    $data[] = [
        'id' => $fila['id'],
        'curso' => $fila['curso'],
        'nombre' => $fila['nombre'],
        'precio' => $fila['precio'],
        'fecha' => $fila['fecha'],
        'ref_pago' => $fila['ref_pago']
    ];
}
?>

<script>
// Pasar los datos de PHP a JavaScript como JSON
var dataFromPHP = <?php echo json_encode($data); ?>;

// Transformar los datos para las estadísticas
var pagosPorCurso = {};
dataFromPHP.forEach(function(item) {
    if (pagosPorCurso[item.curso]) {
        pagosPorCurso[item.curso] += parseFloat(item.precio);
    } else {
        pagosPorCurso[item.curso] = parseFloat(item.precio);
    }
});

// Crear los arrays para los gráficos
var cursos = Object.keys(pagosPorCurso);
var totalPagos = Object.values(pagosPorCurso);

// Calcular el total general de todos los pagos (suma de todas las columnas)
var totalGeneral = totalPagos.reduce(function(acc, curr) {
    return acc + curr;
}, 0);

// Agregar una nueva columna "Total General" con el total sumado
cursos.push("Total General");
totalPagos.push(totalGeneral);

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="chartPagos"></canvas>

<script>
// Crear gráfico de barras con Chart.js
var ctx = document.getElementById('chartPagos').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: cursos, // Los nombres de los cursos + "Total General"
        datasets: [{
            label: 'Total Pagos por Curso',
            data: totalPagos, // Los pagos totales por curso + "Total General"
            backgroundColor: cursos.map((curso, index) => index === cursos.length - 1 ? 'rgba(255, 99, 132, 0.2)' : 'rgba(54, 162, 235, 0.2)'), // Diferente color para el "Total General"
            borderColor: cursos.map((curso, index) => index === cursos.length - 1 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'), // Diferente color para el borde del "Total General"
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

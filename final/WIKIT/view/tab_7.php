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
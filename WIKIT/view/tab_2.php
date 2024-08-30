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
                <th>USUARIO</th>
                <th>CORREO</th>
                <th>ACCION</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($filas = $resultado->fetch()) { ?>
            <tr>
                <td><?php echo $filas['id']; ?></td>
                <td><?php echo $filas['nombre']; ?></td>
                <td><?php echo $filas['correo']; ?></td>
                <td><a class="btn btn-danger" href="../controller/controll.php?seccion=9&llaveB=<?php echo $filas['id']; ?>">BORRAR</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
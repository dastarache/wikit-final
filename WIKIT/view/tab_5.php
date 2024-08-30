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
                <th>USUARIO</th>
                <th>PRECIO</th>
                <th>FECHA</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($filas = $resultado->fetch()) { ?>
            <tr>
                <td><?php echo $filas['id']; ?></td>
                <td><?php echo $filas['curso']; ?></td>
                <td><?php echo $filas['usuario']; ?></td>
                <td><?php echo $filas['precio']; ?></td>
                <td><?php echo $filas['fecha']; ?></td>
                <td>
                    <a href="../controller/controll.php?seccion=5&tab=5&llaveE=<?php echo $filas['id']; ?>&precio=<?php echo $filas['precio']; ?>">EVALUAR</a>
                    <a href="../controller/controll.php?seccion=11&llaveE=<?php echo $filas['id']; ?>">ELIMINAR</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sistema de evaluación...</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../controller/controll.php?seccion=8" method="post">
        <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ID:</label>
                <input name="llavec" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_REQUEST['llaveE']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cuanto es 1 + 1</label>
                <input name="prueba1" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cuanto es 1 * 0?</label>
                <input name="prueba2" type="text" class="form-control" id="exampleInputPassword1" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Valor</label>
                <input name="valor" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $_REQUEST['precio']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ingresa Tarjeta para continuar</label>
                <input name="pago" type="text" class="form-control" id="exampleInputPassword1" required><ion-icon name="card-outline"></ion-icon>
            </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input name="calificar" type="submit" class="btn btn-primary" value="Calificar">
        </form>
      </div>
    </div>
  </div>
</div>
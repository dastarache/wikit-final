<div class="container">
    <div class="row">
        <?php while ($filas = $resultado->fetch()) { ?>

            <!-- Modal -->
            <div class="modal fade" id="modal-<?php echo $filas['id_curso']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">HOLA SOY... <?php echo $filas['curso']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                                Descripción:
                                <h5>
                                ¡Domina el desarrollo web con nuestro curso integral! Este curso está diseñado para principiantes y profesionales que desean adquirir habilidades completas en el diseño y desarrollo de sitios web. A lo largo del curso, aprenderás:
                                </h5>
                                <p>

                                    <?php echo $filas['contenido']; ?>

                                </p>

                                Requisitos:

                                No se requieren conocimientos previos. El curso está diseñado para que cualquier persona interesada en el desarrollo web pueda comenzar desde cero.
                                <h5>
                                Precio: <?php echo $filas['precio']; ?> COP
                                </h5>
                                <h5>
                                SOPORTES: <a href="../assets/pdf/<?php echo $filas['ruta']; ?>" target="_blank" rel="noopener noreferrer">DESCARGAR</a>
                                </h5>

                                ¡Inscríbete hoy y da el primer paso hacia una carrera exitosa en desarrollo web!
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <a href="../controller/controll.php?seccion=10&llave_c=<?php echo $filas['id_curso']; ?>&llave_u=<?php echo $_SESSION['id']; ?>&color=rojo"><ion-icon <?php $usuarios = explode(',', $filas['usuarios']);
                                                                                                                                                                        $usuario_actual = $_SESSION['id'];
                                                                                                                                                                        if (in_array($usuario_actual, $usuarios)) {
                                                                                                                                                                            echo "style='color : red;' ";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo "style='color : black;' ";
                                                                                                                                                                        } ?> name="heart"></ion-icon></a> ...<?php echo $filas['total_likes']; ?>
                <a class="float-right" href="../controller/controll.php?seccion=7&llave_c=<?php echo $filas['id_curso']; ?>&llave_u=<?php echo $_SESSION['id']; ?>&precio=<?php echo $filas['precio']; ?>"><ion-icon name="add-circle-sharp"></ion-icon></a>
                <a style="text-decoration: none;" href="#" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $filas['id_curso']; ?>">
                
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6 class="m-b-20"><?php echo $filas['curso']; ?></h6>
                            <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span><?php echo $filas['categoria']; ?></span></h2>
                            <p class="m-b-0">Completar orden... <span class="f-right"><?php echo $filas['precio']; ?> COP</span></p>
                        </div>
                    </div>
                </a>
                <?php if($_SESSION['permiso'] == 2){?><a style="color: red;" class="float-right" href="../controller/controll.php?seccion=12&llave_c=<?php echo $filas["id_curso"]; ?>"><ion-icon name="trash"></ion-icon></a><?php } ?>
            </div>

        <?php } ?>
    </div>
</div>
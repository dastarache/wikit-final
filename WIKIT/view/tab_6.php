<div class="container">
    <div class="row">
    <?php while ($filas = $resultado->fetch()) { ?>
        
        <div class="col-md-4 col-xl-3">
            <a target="_blank" style="text-decoration: none;" href="../controller/pdf.php?n_curso=<?php echo $filas['curso']; ?>&n_nombre=<?php echo $filas['nombre']; ?>&perfil=<?php echo $filas['perfil']; ?>&precio=<?php echo $filas['precio']; ?>&fecha=<?php echo $filas['fecha']; ?>">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20"><?php echo $filas['curso']; ?></h6>
                        <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span><?php echo $filas['nombre']; ?></span></h2>
                        <p class="m-b-0">Felicidades...  <span class="f-right">CERTIFICADO</span></p>
                    </div>
                </div>
            </a>
        </div>

    <?php } ?>
	</div>
</div>


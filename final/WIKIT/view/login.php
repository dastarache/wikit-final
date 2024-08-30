<!-- Modal RECUPERACION DE CONTASEÑA -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="../controller/controll.php?seccion=3" method="post">

                <div class="col-12">
                    <label for="correo" class="form-label">Correo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo" required><br>
                </div>
                <div class="col-12">
                    <input name="enviar" type="submit" class="btn btn-primary" value="Enviar">
                </div>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    <section class="p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="card border-light-subtle shadow-sm">
        <div class="row g-0">
            <div class="col-12 col-md-6 text-bg-primary">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="col-10 col-xl-8 py-3">
                <img class="img-fluid rounded mb-4" loading="lazy" src="../assets/img/logoia.jpg" width="auto" height="auto" alt="BootstrapBrain Logo">
                <hr class="border-primary-subtle mb-4">
                <h2 class="h1 mb-4">Bienvenido a WIKIT</h2>
                <p class="lead m-0">¡Comienza hoy mismo y descubre un mundo de posibilidades! Regístrate, elige tu curso y da el primer paso hacia el éxito. Estamos aquí para apoyarte en cada paso del camino.</p>
                </div>
            </div>
            </div>
            <div class="col-12 col-md-6">
            <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                    <h2 class="h3">Inicio de Sesion</h2>
                    </div>
                </div>
                </div>
                <form id="miFormulario" action="../controller/controll.php?seccion=1" method="post">
                <div class="row gy-3 gy-md-4 overflow-hidden">
                    <div class="col-12">
                    <label for="firstName" class="form-label">Usuario <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="usuario" id="firstName" placeholder="Usuario" required>
                    </div>
                    <div class="col-12">
                    <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" value="" required>
                    </div>
                    <div class="col-12">
                    <div class="form-check">
                        <label class="form-check-label text-secondary" for="iAgree">
                        Perdio su Contraseña <a data-bs-toggle="modal" data-bs-target="#exampleModal" target="_blank" class="link-primary text-decoration-none">Recuperar</a>
                        </label>
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="d-grid">
                        <input name="enviar" class="btn bsb-btn-xl btn-primary" type="submit" value="Iniciar Session">
                    </div>
                    </div>
                </div>
                </form>
                <div class="row">
                <div class="col-12">
                    <hr class="mt-5 mb-4 border-secondary-subtle">
                    <p class="m-0 text-secondary text-center">Aun no estas registrado? <a href="../controller/controll.php?seccion=2" class="link-primary text-decoration-none">Registrar</a></p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>


<!-- Modal ACCESO DENEGADO Y CAPTCHA -->
<div id="myModal" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Acceso de usuario denegado</h5>
      </div>
      <div class="modal-body">
        <h5 class="modal-title" id="staticBackdropLabel">Prueba recuperar tu contraseña</h5><br>
        <h5>Por favor resuelve el Captcha para continuar</h5><br><br>
        <div class="row gy-3 gy-md-4">
        <div class="col-12">
            <span>No soy un robot. <input class="form-control" type="number" id="num1" value="<?php echo $_SESSION["valor1"] = rand(0,20); ?>" readonly> + <input class="form-control" type="number" id="num2" value="<?php echo $_SESSION["valor2"] = rand(0,20); ?>" readonly> = </span><input class="form-control" id="num3" type="text">
        </div>
      </div>
      <div class="modal-footer">
        <button style="display:none" id="botoncerrar" type="button" class="btn btn-success" data-bs-dismiss="modal">VALIDAR</button>
      </div>
    </div>
  </div>
</div>

    <script>
        document.getElementById('miFormulario').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();  // Previene el envío del formulario
            }
        });
    </script>


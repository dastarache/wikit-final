    <!-- Registration 5 - Bootstrap Brain Component -->
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
                    <h2 class="h3">Registro</h2>
                    </div>
                </div>
                </div>
                <form action="../controller/controll.php?seccion=2" method="post">
                <div class="row gy-3 gy-md-4 overflow-hidden">
                    <div class="col-12">
                    <label for="firstName" class="form-label">Usuario <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="usuario" id="firstName" placeholder="Usuario" required>
                    </div>
                    <div class="col-12">
                    <label for="email" class="form-label">Correo <span class="text-danger">Gmail*</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="ejemplo@GMAIL.com" required>
                    </div>
                    <div class="col-12">
                    <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" value="" required>
                    </div>
                    <div class="col-12">
                    <label for="password" class="form-label">Repite la Contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password2" id="password" value="" required>
                    </div>
                    <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                        <label class="form-check-label text-secondary" for="iAgree">
                        He leído y acepto <a href="../assets/legal/terYcon.pdf" target="_blank" class="link-primary text-decoration-none">términos y condiciones</a>
                        </label>
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="d-grid">
                        <button class="btn bsb-btn-xl btn-primary" type="submit">Registrar</button>
                    </div>
                    </div>
                </div>
                </form>
                <div class="row">
                <div class="col-12">
                    <hr class="mt-5 mb-4 border-secondary-subtle">
                    <p class="m-0 text-secondary text-center">Ya estas registrado? <a href="../controller/controll.php?seccion=1" class="link-primary text-decoration-none">Iniciar Sesion</a></p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
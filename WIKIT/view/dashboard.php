
    <div class="contain">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon colr">
                        <ion-icon name="shield-checkmark-outline"></ion-icon>
                        </span>
                        <span class="title"><?php  echo $usuarioLog; ?></span>
                    </a>
                </li>

                <li>
                    <a href="?seccion=5&tab=1">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Cursos</span>
                    </a>
                </li>
                <!-- Gestión de permiso solo para el administrador -->
                <?php if($_SESSION['permiso'] == 2){ ?>
                <li>
                    <a href="?seccion=5&tab=2">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Usuarios</span>
                    </a>
                </li>

                <li>
                    <a href="?seccion=5&tab=3">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Gestión</span>
                    </a>
                </li>

                <li>
                    <a href="?seccion=5&tab=7">
                        <span class="icon">
                            <ion-icon name="logo-paypal"></ion-icon>
                        </span>
                        <span class="title">Pagos</span>
                    </a>
                </li>
                <?php } ?>
                <li>
                    <a href="?seccion=5&tab=4">
                        <span class="icon">
                            <ion-icon name="build-outline"></ion-icon>                        </span>
                        <span class="title">Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="?seccion=5&tab=5">
                        <span class="icon">
                        <ion-icon name="file-tray-full-outline"></ion-icon>                        </span>
                        <span class="title">Mis cursos</span>
                    </a>
                </li>

                <li>
                    <a href="?seccion=5&tab=6">
                        <span class="icon">
                        <ion-icon name="code-working-outline"></ion-icon>                        </span>
                        <span class="title">Mis certificados</span>
                    </a>
                </li>

                <li>
                    <a href="../model/cerrarSesion.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>


            <!-- ================ Contenido ================= -->
            <div class="details">

                <?php 
                
                    if(isset($_GET))
                    {

                        $seccion = $_REQUEST['seccion'];
                        $tab = $_REQUEST['tab'];

                        if($seccion == 5 && $tab == 1)
                        {

                            require_once("tab_1.php");

                        }
                        if($seccion == 5 && $tab == 2)
                        {

                            require_once("tab_2.php");

                        }
                        if($seccion == 5 && $tab == 3)
                        {

                            require_once("tab_3.php");

                        }
                        if($seccion == 5 && $tab == 4)
                        {

                            require_once("tab_4.php");

                        }
                        if($seccion == 5 && $tab == 5)
                        {

                            require_once("tab_5.php");

                        }
                        if($seccion == 5 && $tab == 6)
                        {

                            require_once("tab_6.php");

                        }
                        if($seccion == 5 && $tab == 7)
                        {

                            require_once("tab_7.php");

                        }


                    }
                
                ?>

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
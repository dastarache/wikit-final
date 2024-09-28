<!-- ESTE ARCHIVO ES EL QUE SE ENCARGA DE CONTROLAR Y MODERAR LA BASE DE DATOS Y LA VISTA
 * TODA CONSULTA, REGISTRO, ACTUALIZACION Y ENLACE. -->
<?php
//Parametros PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Incluimos la conexion para tener enlace con la base de datos.
include "../../InstaladorWIKIT/model/Conexion.php";

session_start();

//Variable $seccion sera la que proporcione un INT 
//el cual sera el encargado de permitirnos navegar por toda la pagina.

//Validacion seguridad controlador.
if (isset($_REQUEST['seccion'])) {

    if (empty($_REQUEST['seccion'])) {

        echo "
            <script type='text/javascript'>

                alert('ACCESO DENEGADO');
                window.location.href = 'controll.php?seccion=1';

            </script>
            ";

    } else {

        $seccion = $_REQUEST['seccion'];

    }

} else {

    echo "
        <script type='text/javascript'>

            alert('ACCESO DENEGADO');
            window.location.href = 'controll.php?seccion=1';

        </script>
        ";

}

/**
 * Carga de secciones.
 *
 * Esta función toma un INT
 * y Una relacion modelo - vista - controlador,
 * el cual va a permitir visulaizar y gestionar nuestro aplicativo WEB
 * 
 * @param int $seccion Seccion recibida.
 * 
 */
function pg($seccion)
{

    /*
    Inicia el bloque switch
    Se utiliza para ejecutar diferentes partes de código
    dependiendo del valor de la variable $pagina
    */
    $pagina = $seccion;

    switch ($pagina) {
        case 1:
            // Si la opción es 1
            // ****
            // *
            // *   El usuario podra iniciar sesion con las credenciales registradas
            // *   De igiual manera se dara inicio a la gran mayoria de sesiones importantes
            // *   RELACION : ../model/SesionUsu.php --- ../view/login.php.
            // *
            // ****


            require_once("../view/login.php");

            if (isset($_REQUEST['usuario'])) {

                $usuario = $_REQUEST['usuario'];

                require_once("../model/SesionUsu.php");

                if ($resultado->rowCount() > 0) {

                    $filas = $resultado->fetch();

                    $contrHash = $filas['contrasena'];
                    $contrasena = $_REQUEST['password'];

                    if (password_verify($contrasena, $contrHash)) {

                        //Cargue de Sesiones
                        $_SESSION['nick'] = $filas['nombre'];
                        $_SESSION['id'] = $filas['id'];
                        $_SESSION['fto'] = $filas['perfil'];
                        $_SESSION['correo'] = $filas['correo'];
                        $_SESSION['permiso'] = $filas['permiso'];

                        echo "
                                <script>
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'sesion iniciada',
                          showConfirmButton: false,
                          timer: 1500
                        }).then(() => {
                          // Redirección después de que la alerta se cierre
                          window.location.href = '../controller/controll.php?seccion=5&tab=1';
                        });
                        
                        
                                </script>
                                ";

                    } else {

                        echo "<div style='position: absolute; top: 5px; width: 100%;' class='alert alert-danger' role='alert'>
                            Contraseña o Usuario invalido!
                            </div>";

                    }

                } else {

                    echo "<div style='width: 100%;' class='alert alert-danger' role='alert'>
                        Contraseña o Usuario invalido!
                        </div>";

                    if (isset($_REQUEST['enviar'])) {

                        //Validacion para el acceso denegado y capchat
                        $contador = 0;
                        $contador = $_SESSION["enviar"] + 1;
                        $_SESSION["enviar"] = $contador;

                        if ($contador >= 3) {

                            echo "
                                <script type='text/javascript'>
                                    $( document ).ready(function() {
                                        $('#myModal').modal('toggle')  
                                    });

                                num1 = document.getElementById('num1').value;
                                num2 = document.getElementById('num2').value;
                            
                                resultado = Number(num1)+Number(num2);

                                

                                let txtInput = document.querySelector('#num3');

                                txtInput.addEventListener('keyup',()=>{

                                    resultado2 = txtInput.value;

                                    num3 = resultado2;

                                    total = resultado-Number(num3);

                                    if(Number(total) == 0)
                                    {
                                
                                        document.getElementById('botoncerrar').style.display = 'block';

                                    }else{
                                    
                                        document.getElementById('botoncerrar').style.display = 'none';

                                    }
                        

                                });

                                
                                </script>
                                HOLA";

                            $_SESSION["enviar"] = 0;
                        }

                    }

                }
            }



            break;
        case 2:
            // Si la opción es 2
            // ****
            // *
            // *   El usuario se registrara dentro del aplicativo
            // *   RELACION : ../model/InsertUsu.php --- ../view/register.php.
            // *
            // ****

            require_once("../view/register.php");


            //DATOS RECIBIDOS DESDE ../VIEW/REGISTER.PHP 
            if (isset($_REQUEST['password']) && isset($_REQUEST['password2'])) {

                $contrasena = $_REQUEST['password'];
                $contrasena2 = $_REQUEST['password2'];
                if ($contrasena == $contrasena2) {
                    //ENCRIPTACION DE CONTRASEÑA 
                    $contrHash = password_hash($contrasena, PASSWORD_BCRYPT);
                    $usuario = $_REQUEST['usuario'];
                    $correo = $_REQUEST['email'];
                    $perfil = "logoiano.png";


                    //EJECUCION DE CONSULTAS SQL
                    require_once("../model/SesionUsu.php");
                    if ($resultado->rowCount() > 0) {

                        echo "<div style='position: absolute; top: 5px; width: 100%;' class='alert alert-danger' role='alert'>
                                Usuario repetido!
                            </div>";

                    } else {

                        require_once("../model/InsertUsu.php");
                        if ($resultado->execute()) {

                            echo "
                                <script>
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Registro exitoso',
                          showConfirmButton: false,
                          timer: 1500
                        }).then(() => {
                          // Redirección después de que la alerta se cierre
                          window.location.href = '../controller/controll.php?seccion=1';
                        });
                        
                        
                                </script>
                                ";

                        }

                    }

                } else {

                    echo "<div style='position: absolute; top: 5px; width: 100%;' class='alert alert-danger' role='alert'>
                                Contraseñas incorrectas!
                            </div>";

                }
            }


            break;
        case 3:
            // Si la opción es 3
            // ****
            // *
            // *   El usuario intenta recuperar contraseña y envia correo(.gmail)
            // *   RELACION : ../model/RecuContra.php --- PHPMailer
            // *
            // ****

            if (isset($_REQUEST['enviar'])) {

                $correoR = $_REQUEST['correo'];

                require_once("../model/RecuContra.php");
                //Validacion para recuperar contraseña.
                if ($resultado->rowCount() > 0) {

                    $filas = $resultado->fetch();

                    $correoS = $filas['correo'];
                    $llave = $filas['id'];
                    //Envio de correo.
                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                        $mail->Username = 'proyectoadso85@gmail.com';                     //SMTP username
                        $mail->Password = 'nhhdxygwmfriemju';                               //SMTP password
                        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('proyectoadso85@gmail.com');
                        $mail->addAddress($correoS);     //Add a recipient


                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Recuperacion de contraseña';
                        $mail->Body = 'Restablecer su clave<b><a href="http://localhost/SISTEMA_PROYECTO/WIKIT/controller/controll.php?seccion=4&llave=' . $llave . '">AQUI</a></b>';

                        $mail->send();
                        header('Location:controll.php?seccion=1');
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }


                } else {

                    echo "<div style='position: absolute; top: 5px; width: 100%;' class='alert alert-danger' role='alert'>
                                Correo invalido, no es tu correo!
                            </div>";

                }

            }

            break;
        case 4:
            // Si la opción es 4
            // ****
            // *
            // *   Gestion de recuperacion de contraseña y sus validaciones
            // *   RELACION : ../model/ActuContra.php --- ../view/ActuContra.php.
            // *
            // ****

            if (isset($_REQUEST['actualizar'])) {

                $llave = $_SESSION['llave'];
                $newcontra = $_REQUEST['newcontra'];

                $contra = password_hash($newcontra, PASSWORD_BCRYPT);


                require_once("../model/ActuContra.php");



            }

            require_once("../view/ActuContra.php");

            break;
        case 5:
            // Si la opción es 5
            // ****
            // *
            // *   Al iniciar sesion el usuario podra verificar el panel principal
            // *   Donde se llevaran acabo el cargue de las tab(sub_secciones)
            // *   RELACION : ../model/Log.php --- tab(sub_secciones).
            // *
            // ****

            if (isset($_SESSION['id'])) {

                $llave = $_SESSION['id'];
                require_once("../model/Log.php");
                $filas = $resultado->fetch();
                $usuarioLog = $filas['nombre'];
                $fotoLog = $filas['perfil'];


                //Actualixar la informacion del usuario
                if (isset($_REQUEST['actualizarD'])) {

                    $llave = $_REQUEST['llave'];
                    $usuario = $_REQUEST['usuario'];
                    $nombre_img = $_FILES['imagen']['name'];
                    $tipo = $_FILES['imagen']['type'];
                    $tamano = $_FILES['imagen']['size'];

                    //Si existe imagen y tiene un tamaño correcto
                    if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 900000)) {
                        //indicamos los formatos que permitimos subir a nuestro servidor
                        if (
                            ($_FILES["imagen"]["type"] == "image/gif")
                            || ($_FILES["imagen"]["type"] == "image/jpeg")
                            || ($_FILES["imagen"]["type"] == "image/jpg")
                            || ($_FILES["imagen"]["type"] == "image/png")
                        ) {
                            // Ruta donde se guardarán las imágenes que subamos
                            $directorio = '../assets/img/';
                            // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                            move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre_img);
                        } else {
                            //si no cumple con el formato
                            echo "No se puede subir una imagen con ese formato ";

                        }
                    } else {
                        //si existe la variable pero se pasa del tamaño permitido
                        if ($nombre_img == !NULL)
                            echo "La imagen es demasiado grande ";
                    }

                    require_once("../model/ActuForo.php");

                    if ($resultado->execute()) {
                        require_once("../model/ActuDatos.php");

                        if ($resultado->execute()) {

                            echo "
                            <script type='text/javascript'>
                    
                                window.location.href = 'controll.php?seccion=5&tab=4';
                    
                            </script>
                            ";

                        }
                    }

                }
                //Cargue de las tab(sub_secciones)
                //Son las consultas del contenido que estan a la espera de ser llamadas 
                //Para poder realizar las respectivas tareas dentro del aplicativo.
                if (isset($_REQUEST['tab'])) {

                    if ($_REQUEST['tab'] == 3) {

                        require_once("../model/LogGest.php");

                    }

                    if ($_REQUEST['tab'] == 1) {

                        require_once("../model/LogHome.php");

                    }

                    if ($_REQUEST['tab'] == 5) {

                        $llave = $_SESSION['id'];
                        require_once("../model/LogPay.php");

                    }

                    if ($_REQUEST['tab'] == 6) {

                        $llave = $_SESSION['id'];
                        require_once("../model/LogCert.php");

                    }

                    if ($_REQUEST['tab'] == 2) {

                        require_once("../model/LogUsu.php");

                    }

                    if ($_REQUEST['tab'] == 7) {

                        require_once("../model/LogBuy.php");

                    }

                    if ($_REQUEST['tab'] == 8) {
                        $con = Conexion::conectar();
                        require_once('../model/funciones.php');

                    }

                }
                if (isset($_REQUEST['llaveE'])) {

                    echo "
                        <script type='text/javascript'>
                            $( document ).ready(function() {
                                $('#myModal').modal('toggle')  
                            });   
                        </script>";

                }

                require_once("../view/dashboard.php");

            } else {

                echo "
                    <script type='text/javascript'>
            
                        window.location.href = 'controll.php?seccion=1';
            
                    </script>
                    ";

            }

            break;
        case 6:
            // Si la opción es 6
            // ****
            // *
            // *   Se encarga de registrar los cursos con su contenido
            // *   RELACION : ../model/InsetrCat.php --- ../model/InsertCur.php.
            // *
            // ****

            if (isset($_REQUEST['enviar'])) {

                $nombre = $_REQUEST['nombre'];
                require_once("../model/InsetrCat.php");

            }

            if (isset($_REQUEST['guardar'])) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Verifica si se subió algún archivo
                    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                        // Obtiene información sobre el archivo
                        $fileTmpPath = $_FILES['file']['tmp_name'];
                        $fileName = $_FILES['file']['name'];
                        $fileSize = $_FILES['file']['size'];
                        $fileType = $_FILES['file']['type'];
                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                        // Define las extensiones permitidas
                        $allowedExtensions = ['pdf'];

                        if (in_array($fileExtension, $allowedExtensions)) {
                            // Carpeta donde se guardará el archivo
                            $uploadFolder = '../assets/pdf/';
                            $newFileName = uniqid() . '.' . $fileExtension;

                            // Mueve el archivo a la carpeta deseada
                            $destPath = $uploadFolder . $newFileName;

                            if (move_uploaded_file($fileTmpPath, $destPath)) {

                                $precio = $_REQUEST['precio'];
                                $nombre = $_REQUEST['curso'];
                                $llave_cate = $_REQUEST['llave_cate'];
                                $contenido = $_REQUEST['contenido'];
                                require_once("../model/InsertCur.php");

                            } else {

                                echo "
                                    <script type='text/javascript'>
                            
                                        alert('Hubo un error al mover el archivo.');
                                        window.location.href = '../controller/controll.php?seccion=5&tab=3';
                            
                                    </script>
                                    ";
                            }
                        } else {

                            echo "
                                <script type='text/javascript'>
                        
                                    alert('Solo se permiten archivos PDF.');
                                    window.location.href = '../controller/controll.php?seccion=5&tab=3';
                        
                                </script>
                                ";
                        }
                    } else {

                        echo "
                            <script type='text/javascript'>
                    
                                alert('No se seleccionó ningún archivo o hubo un error en la subida.');
                                window.location.href = '../controller/controll.php?seccion=5&tab=3';
                    
                            </script>
                            ";
                    }
                } else {


                    echo "
                        <script type='text/javascript'>
                
                            alert('Método de solicitud no permitido.');
                            window.location.href = '../controller/controll.php?seccion=5&tab=3';
                
                        </script>
                        ";

                }



            }
            break;
        case 7:
            // Si la opción es 7
            // ****
            // *
            // *   Se encarga de agregar un curso a la lista de mis cursos,
            // *   Para proceder a la evaluacion y al pago.
            // *   RELACION : ../model/InsertPay.php.
            // *
            // ****

            $llave_c = $_REQUEST['llave_c'];
            $llave_u = $_REQUEST['llave_u'];
            $precio = $_REQUEST['precio'];

            require_once("../model/InsertPay.php");

            break;
        case 8:
            // Si la opción es 8
            // ****
            // *
            // *   Proceso y validacion para la certificacion del usuario
            // *   RELACION : ../model/ActuCertifi.php.
            // *
            // ****

            if (isset($_REQUEST['calificar'])) {

                $prueba1 = $_REQUEST['prueba1'];
                $prueba2 = $_REQUEST['prueba2'];
                $llavec = $_REQUEST['llavec'];
                $pago = $_REQUEST['pago'];

                //Resultados definidos, de las preguntas para la certificacion.
                $resul1 = 2;
                $resul2 = 0;

                if ($prueba1 == $resul1 && $prueba2 == $resul2) {

                    require_once("../model/ActuCertifi.php");

                } else {

                    echo "
                        <script type='text/javascript'>
                
                            alert('CERTIFICACIÓN FALLIDA');
                            window.location.href = 'controll.php?seccion=5&tab=5';
                
                        </script>
                        ";

                }


            }

            break;
        case 9:
            // Si la opción es 9
            // ****
            // *
            // *   Eliminar usuario 
            // *   Gestion realizada por el super administrador
            // *   RELACION : ../model/DeletUsu.php.
            // *
            // ****

            if (isset($_REQUEST['llaveB'])) {

                $llaveB = $_REQUEST['llaveB'];
                require_once("../model/DeletUsu.php");

            }


            break;
        case 10:

            $color = $_GET['color'];
            $llave_c = $_GET['llave_c'];
            $llave_u = $_GET['llave_u'];
            require_once("../model/InsertLik.php");

            break;
        case 11:

            $llaveE = $_GET['llaveE'];
            require_once("../model/DeletPay.php");

            break;
        case 12:

            $llave_c = $_GET['llave_c'];
            require_once("../model/DeletCur.php");

            break;
        case 13:
            $llave = $_SESSION['id'];
            require_once("../model/Log.php");
            $filas = $resultado->fetch();
            $usuarioLog = $filas['nombre'];
            require_once("../controller/index.php");
            break;
        case 14:
        require_once("carrusel.php");

            break;
        default:
    }


    return $pagina;
}

//Se encarga de cargar todas la vistas atraves de la funcion 
//pg($seccion);
require_once("../view/index.php");

?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }

        .foro-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .chat-bubble {
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        .chat-bubble.sender {
            background-color: #d1e7dd;
            align-items: flex-start;
        }

        .chat-bubble.receiver {
            background-color: #f8d7da;
            align-items: flex-start;
        }

        .btn-edit,
        .btn-delete {
            margin-left: 10px;
            font-size: 0.9rem;
        }

        .input-group-text {
            border: none;
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="foro-container">
                    <h2 class="text-center mb-4">Foro de Mensajes</h2>
                    <form action="procesar_foro.php" method="POST" class="border p-4 rounded shadow-sm"
                        onsubmit="return validarFormulario()">
                        <div class="mb-3">
                            <input readonly  value="<?php echo  $usuarioLog; ?>" type="text" name="nombre" class="form-control" placeholder="Tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <textarea id="contenido_foro" name="contenido_foro" class="form-control"
                                placeholder="Escribe tu mensaje aquí..." rows="4" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                    <div id="foroMensajes" class="list-group"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
function validarFormulario() {
    var contenido = document.getElementById('contenido_foro').value;
    var caracteresInvalidos = /[^a-zA-Z0-9\s]/g;  // Solo permite letras, números y espacios

    if (caracteresInvalidos.test(contenido)) {
        alert("El mensaje contiene caracteres especiales no permitidos. Por favor, usa solo letras, números y espacios.");
        return false;
    }
    return true;  // Si pasa la validación, el formulario se envía
}
</script>

    <script>
        function cargarMensajes() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("foroMensajes").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "mostrar_foro.php", true);
            xhttp.send();
        }

        // Cargar mensajes cada 5 segundos
        setInterval(cargarMensajes, 5000);
    </script>

</body>
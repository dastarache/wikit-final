<?php

    session_start();
    session_destroy();
    session_unset();
    header('Location: ../controller/controll.php?seccion=1');

?>
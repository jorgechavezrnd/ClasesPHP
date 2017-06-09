<?php
    include_once('modulos/Enrutador.php');
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Classes</title>
        <link rel="stylesheet" href="css/general.css">
    </head>
    <body>
        <header>
            SimpleSchedulingApp
        </header>
        
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="?cargar=crear">Registrar</a></li>
            </ul>
        </nav>
        
        <section>
            <?php
            // put your code here
                $enrutador = new Enrutador();
                if ($enrutador->validarGET($_GET['cargar'])) {
                    $enrutador->cargarVista($_GET['cargar']);
                }
            ?>
        </section>
        
        <footer>
            Todos los derechos reservados &COPY JorgeCarlosChavezRuiz-SisWeb
        </footer>
    </body>
</html>
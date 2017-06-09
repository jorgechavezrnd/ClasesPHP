<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    if (isset($_GET['id'])) {
        $json = @file_get_contents('http://localhost:8080/SisWebRest/api/v1/classes/'.$_GET['id']);
        
        if ($json == TRUE) {
            $class = json_decode($json);
        }
    }  else {
        header("Location: index.php");
    }
    
    if (isset($_POST['enviar'])) {
        
        $result = file_get_contents(
            'http://localhost:8080/SisWebRest/api/v1/classes/'.$_GET['id'], 
            false, 
            stream_context_create(array(
                'http' => array(
                    'method' => 'DELETE' 
                )
            ))
        );

        header("Location: index.php");
    }
?>

¿Usted de verdad quiere eliminar la clase con titulo <?php echo $class->title; ?> y codigo <?php echo $class->code; ?>?
<br><br>

<form action="" method="POST">
       <input type="submit" name="enviar" value="Eliminar">
</form>
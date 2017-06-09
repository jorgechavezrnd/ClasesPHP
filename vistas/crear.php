<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $json = @file_get_contents('http://localhost:8080/SisWebRest/api/v1/students');

    if ($json == TRUE) {
        $students = json_decode($json);
    }

    if (isset($_POST['enviar'])) {
        
        $json2 = @file_get_contents('http://localhost:8080/SisWebRest/api/v1/classes/'.$_POST['classCode']);
        
        if ($json2 == TRUE) {
            echo "El codigo de la clase que esta intentando ingresar ya existe";
        } else {

            if (count($_POST['studentIds']) == 0) {
                $ids = [];
            } else {
                $ids = $_POST['studentIds'];
            }

            $data = array(
                'code' => $_POST['classCode'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'studentIds' => $ids
            );

            $options = array(
                'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                            "Accept: application/json\r\n"
                )
            );

            $url = 'http://localhost:8080/SisWebRest/api/v1/classes';
            $context  = stream_context_create( $options );
            $result = file_get_contents( $url, false, $context );
            $response = json_decode( $result );
            
            echo "Se ha registrado una nueva clase";
        }
    }
?>

<h3>Registro de un nuevo estudiante</h3>
<hr>
<form action="" method="POST">
    <label>Code:</label><br>
    <input type="text" name="classCode" required="required">
    <br><br>
    <label>Title:</label><br>
    <input type="text" name="title" required="required">
    <br><br>
    <label>Description:</label><br>
    <input type="text" name="description" required="required">
    <br><br>
    <label>Student Ids:</label><br>
    <select multiple="yes" name="studentIds[]">
        <?php for ($i = 0; $i < count($students); $i++): ?>
            <option value="<?php echo $students[$i]->studentId; ?>"><?php echo $students[$i]->studentId; ?></option>
        <?php endfor; ?>
    </select>
    <br><br>
    <input type="submit" name="enviar" value="Crear">
</form>
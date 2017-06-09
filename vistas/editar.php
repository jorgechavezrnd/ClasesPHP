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

    if (isset($_GET['id'])) {
        $json2 = @file_get_contents('http://localhost:8080/SisWebRest/api/v1/classes/'.$_GET['id']);
        
        if ($json2 == TRUE) {
            $class = json_decode($json2);
        }
    } else {
        header("Location: index.php");
    }
    
    if (isset($_POST['enviar'])) {
        
        if (count($_POST['studentIds']) == 0) {
            $ids = [];
        } else {
            $ids = $_POST['studentIds'];
        }
        
        $data = array(
            'code' => $_GET['id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'studentIds' => $ids
        );

        $data_json = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/SisWebRest/api/v1/classes/'.$_GET['id']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);
        
        header('Location: index.php');
    }
?>

<form action="" method="POST">
    Code: <br>
    <input type="text" name="code" value="<?php echo $class->code; ?>" disabled>
    <br><br>
    Title: <br>
    <input type="text" name="title" value="<?php echo $class->title; ?>" required>
    <br><br>
    Description: <br>
    <input type="text" name="description" value="<?php echo $class->description; ?>" required>
    <br><br>
    Student Ids: <br>
    <select multiple="yes" name="studentIds[]">
        <?php for ($i = 0; $i < count($students); $i++): ?>
            <option value="<?php echo $students[$i]->studentId; ?>"><?php echo $students[$i]->studentId; ?></option>
        <?php endfor; ?>
    </select>
    <br><br>
    <input type="submit" name="enviar" value="Editar">
</form>
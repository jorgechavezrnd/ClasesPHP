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
        
    } else {
        header("Location: index.php");
    }
    
    function showStudentIds($studentIds) {

        if (count($studentIds) <= 0) {
            echo '[]';
        } else {

            echo '[';

            for ($i = 0; $i < (count($studentIds) - 1); $i++) {
                echo $studentIds[$i].', ';
            }

            echo $studentIds[count($studentIds) - 1].']';
        }

    }

?>

<b>Code:</b> <?php echo $class->code ?>
<br><br>

<b>Title:</b> <?php echo $class->title ?>
<br><br>

<b>Description:</b> <?php echo $class->description ?>
<br><br>

<b>Student Ids:</b> <?php echo showStudentIds($class->studentIds) ?>
<br><br>
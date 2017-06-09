<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $json = @file_get_contents('http://localhost:8080/SisWebRest/api/v1/classes');

    if ($json == TRUE) {
        $classes = json_decode($json);
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

<h3>Classes</h3>
<table border="1">
    <thead>
        <th>Code</th>
        <th>Title</th>
        <th>Description</th>
        <th>Student Ids</th>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($classes); $i++): ?>
            <tr>
                <td><?php echo $classes[$i]->code ?></td>
                <td><?php echo $classes[$i]->title ?></td>
                <td><?php echo $classes[$i]->description ?></td>
                <td><?php showStudentIds($classes[$i]->studentIds) ?></td>
                <td>
                    <a href="?cargar=ver&id=<?php echo $classes[$i]->code; ?>">Ver</a>
                    <a href="?cargar=editar&id=<?php echo $classes[$i]->code; ?>">Editar</a>
                    <a href="?cargar=eliminar&id=<?php echo $classes[$i]->code; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>
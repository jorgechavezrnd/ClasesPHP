<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Enrutador
 *
 * @author Jorge
 */
    class Enrutador {
        //put your code here

        public function cargarVista($vista) {

            switch ($vista):

                case "crear":
                    include_once('vistas/'.$vista.'.php');
                    break;

                case "ver":
                    include_once('vistas/'.$vista.'.php');
                    break;

                case "editar":
                    include_once('vistas/'.$vista.'.php');
                    break;

                case "eliminar":
                    include_once('vistas/'.$vista.'.php');
                    break;

                default:
                    include_once('vistas/error.php');

            endswitch;

        }

        public function validarGET($variable) {
            if (empty($variable)) {
                include_once('vistas/inicio.php');
            } else {
                return true;
            }
        }

    }
?>
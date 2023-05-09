<?php
    function valida_sessao(){
        if(session_id() == '') {
            session_start();
            if (empty($_SESSION["logado"])){
                header("location:/index.php");
            }
        }
        else{
            echo "NOA INICIADO";
        }
    }

    valida_sessao();
?>
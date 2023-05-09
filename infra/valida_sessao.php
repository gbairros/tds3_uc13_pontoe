<?php
    function valida_sessao(){
        session_start();
	    if (empty($_SESSION["logado"])){
		    header("location:../view/login.php");
	    }
    }

    valida_sessao();
?>
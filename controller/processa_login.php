<?php
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $retorno = ["msg" =>"Senha Invalida!!", "erro"=>"0"];
    
    echo json_encode($retorno);
?>
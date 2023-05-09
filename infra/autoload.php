<?php
spl_autoload_register(function ($class_name) {
    require_once __DIR__."/".$class_name . '.php';
});

$obj  = new Database();
$obj->teste();
echo "> ".__DIR__."\n";
echo "<br>";
echo $_SERVER["DOCUMENT_ROOT"];
echo "<br>";
?>
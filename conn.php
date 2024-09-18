<?php
require("com.php");

$arreglo = array(
    "secces"=>false,
    "status"=>400,
    "data"=>"",
    "message"=>"",
    "cant"=>0
);

if($_SERVER["REQUEST_METHOD"]==="GET"){
    // EL METODO ES GET
    if(isset($_GET["type"]) && $_GET["type"] != ""){
        // SI SE ENVIÓ EL PARAMETRO type

        $conexion = new conexion;
        $com = $conexion->conectar();

        $datos = $com->query('SELECT * FROM empleado');
        $resultado = $datos->fetchAll();

        switch($_GET["type"]){
            case "json":
                result_json($resultado);
            break;
            case "xml":
                result_xml($resultado);
            break;
            default:
                echo("Por favor defina el tipo de resultado");
            break;
        }


    } else {
        $arreglo = array(
            "secces"=>false,
            "status"=>array("status_code"=>412,"status_text"=> "Method not allowed"),
            "data"=>"",
            "message"=>"Se esperaba el parametro 'type' con el tipo de resultado",
            "cant"=>0
        );
        
    }
} else {
    // NO SE ACEPTA
    $arreglo = array(
        "secces"=>false,
        "status"=>array("status_code"=>405,"status_text"=> "Method not allowed"),
        "data"=>"",
        "message"=>"NO SE ACEPTA EL METODO",
        "cant"=>0
    );
}

public function result_json($resultado){
    $arreglo = array(
        "secces"=>false,
        "status"=>array("status_code"=>200,"status_text"=> "OK"),
        "data"=>$resultado,
        "message"=>"",
        "cant"=>sizeof($resultado)
    );

    header("HTTP/1.1 ".$arreglo["status"]["status_code"]." ".$arreglo["status"]["status_text"])
    header("Content-type: Application/json");
    echo(json_encode($arreglo));

    function result_xml($resultado){
        $xml = new SimpleXMLElement("<empleados />");
        foreach($resultado as $i =>)
    }
}


?>
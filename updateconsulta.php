<?php
/*
 * El siguiente código localiza un producto
 * AGC    Sept/2019
 */

$response = array();

$Cn = mysqli_connect("localhost","root","","seguro")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");

// Checa que le este llegando por el método POST el nocontrol


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $objArray = json_decode(file_get_contents("php://input"),true);
    if (empty($objArray))
    {
        // required field is missing
        $response["success"] = 400;
        $response["message"] = "Faltan Datos entrada";

        // echoing JSON response
        echo json_encode($response);
    }
    else{
        $fol =$objArray['folio'];
        //$cedula= $objArray['cedula'];
        $noseg= $objArray['noseguro'];
        $exp= $objArray['noExpediente'];
        $precion= $objArray['precion'];
        $peso= $objArray['peso'];
        $estatura= $objArray['estatura'];
        $diagnostico= $objArray['diagnostico'];
        $presc= $objArray['presc'];
       // $fecha= $objArray['fecha'];
        $result = mysqli_query($Cn,"UPDATE consultas SET  noSeguro=$noseg, noExpediente=$exp,
         presion=$precion, peso=$peso, estaruta=$estatura, diagnostico='$diagnostico', prescripcion='$presc' 
        WHERE folio='$fol' ");
        if ($result) {   
            $response["success"] = 200;   // El success=200 
            $response["message"] = "consulta Actualizada";
            // codifica la información en formato de JSON response
            echo json_encode($response);
        } else {
                // 
                $response["success"] = 406;  
                $response["message"] = "Consulta no Actualizada 2";
                echo json_encode($response);
        }
    }
} else {
    // required field is missing
    $response["success"] = 400;
    $response["message"] = "Faltan Datos De Entrada 1";

    // echoing JSON response
    echo json_encode($response);
}
mysqli_close($Cn);
?>
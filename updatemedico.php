<?php
/*
 * El siguiente código localiza un producto
 * AGZ    Sept/2019
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
        $ced =$objArray['cedula'];
        $correo= $objArray['correo'];
        $contra= $objArray['contra'];
        
        $result = mysqli_query($Cn,"UPDATE medicos SET correo='$correo',pass='$contra' WHERE cedula = $ced");
        if ($result) {   
            $response["success"] = 200;   // El success=200 
            $response["message"] = "medico actualizado";
            // codifica la información en formato de JSON response
            echo json_encode($response);
        } else {
                // 
                $response["success"] = 406;  
                $response["message"] = "medico no Actualizado";
                echo json_encode($response);
        }
    }
} else {
    // required field is missing
    $response["success"] = 400;
    $response["message"] = "Faltan Datos entrada";

    // echoing JSON response
    echo json_encode($response);
}
mysqli_close($Cn);
?>
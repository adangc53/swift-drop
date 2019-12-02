<?php
/*
 * El siguiente código localiza un producto
 * AGC    octubre/2019
 */

$response = array();

$Cn = mysqli_connect("localhost","root","","seguro")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$objArray = json_decode(file_get_contents("php://input"),true);
    $ced =$objArray['cedula'];
    
    $result = mysqli_query($Cn,"SELECT cedula,correo,pass from medicos WHERE cedula =$ced");

    if (!empty($result)) {
         if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);
           	$medico = array();

            $medico["cedula"] = $result["cedula"];
            $medico["correo"]= $result["correo"];
            $medico["pass"]=$result["pass"];
		    
   
           $response["success"] = 200;   // El success=200 es que encontro el producto
           $response["message"] = "medico registrado";
           $response["medico"] = array();

           array_push($response["medico"], $medico);

           // codifica la información en formato de JSON response
           echo json_encode($response);
        }
         else {
            // No Encontro al alumno
                $response["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
                $response["message"] = "medico no encontrado1";
                echo json_encode($response);
            }
    } 
    else {

        $response["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
        $response["message"] = "medico no encontrado error 404";
        echo json_encode($response);
    }
} 
else {
    // required field is missing
    $response["success"] = 400;
    $response["message"] = "Faltan Datos entrada";

    // echoing JSON response
    echo json_encode($response);
    }
mysqli_close($Cn);
?>
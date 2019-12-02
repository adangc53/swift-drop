<?php
$response = array();
//{"idprod":"3"}  formato para mandar datos
$Cn = mysqli_connect("localhost","root","","seguro")or die ("server no encontrado");
mysqli_set_charset($Cn,"utf8");
$objArray = json_decode(file_get_contents("php://input"),true);
$cedula =$objArray['cedula'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = mysqli_query($Cn,"SELECT folio,cedula,noSeguro,noExpediente,presion,peso,estaruta,diagnostico,prescripcion,fecha from consultas where cedula=$cedula ");
   // $count= mysqli_query($Cn,"SELECT Count(*) FROM consultas WHERE cedula=$cedula ");
    if (!empty($result)) {
         if (mysqli_num_rows($result) > 0) {
            $response["success"] = 200;   // El success=200 es que encontro el producto
            $response["message"] = "consultas encontradas";
            $response["consultas"] = array();
            $consulta = array();
            while($res = mysqli_fetch_array($result)){
               
                $consulta["folio"] = $res["folio"];
                $consulta["cedula"] = $res["cedula"];
                $consulta["noSeguro"] = $res["noSeguro"];
                $consulta["noExpediente"] = $res["noExpediente"];
                $consulta["presion"] = $res["presion"];
                $consulta["peso"] = $res["peso"];
                $consulta["estaruta"] = $res["estaruta"];
                $consulta["diagnostico"] = $res["diagnostico"];
                $consulta["prescripcion"] = $res["prescripcion"];
                $consulta["fecha"] = $res["fecha"];
               // $consulta["fechaVigente"] = $res["fechaVigente"];
               $consulta["contar"]=mysqli_num_rows($result);
                array_push($response["consultas"],$consulta);
            }
           	

            
   
          

          // array_push($response["producto"], $producto);

           // codifica la información en formato de JSON response
           echo json_encode($response);
        }
         else {
            // No Encontro al alumno
                $response["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
                $response["message"] = "Consultas no encontrado error 1";
                echo json_encode($response);
            }
    } 
    else {

        $response["success"] = 404;  //No encontro información y el success = 0 indica no exitoso
        $response["message"] = "Consultas no encontrado error 2";
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
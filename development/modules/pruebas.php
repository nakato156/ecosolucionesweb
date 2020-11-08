<?php
$servicios = array(
    ['webP' => 'web profesional','wp'=>'web wordpress','blog' => 'blog','landig' =>'landing page','personalizado' => 'personalizado'],
    ['tienda' => 'tienda virtual'],
    ['programa' => 'programa a medida']
);

$serv = $_REQUEST['c'];
servicio:
for ($i=0; $i <count($servicios) ; $i++) { 
    $n_servicios = count($servicios[$i]);
    foreach ($servicios[$i] as $clave => $servicio) {

        if ($_REQUEST['c'] == $clave) {
            $c = $servicios[$i][$serv];
            $clave = $servicios[$i][$serv];
            // echo $c;
            break 2;
        }else{
            $c = "sin contrato";
            $clave = null;
        }
    }
}
echo "hola <br>";
echo $c;
// exit;


// print_r($servicios);exit;
// for ($i=0; $i <count($servicios) ; $i++) { 
    
//     foreach ($servicios['desarrollo web'] as $clave => $servicio) {
//         // var_dump($clave);exit;
//         if ($_REQUEST['c'] == $clave) {
//             $c = $servicios['desarrollo web'][$serv];
//             $clave = $servicios['desarrollo web'][$serv];
//             // echo $c;
//             break;
//         }else{
//             $c = "sin contrato";
//             $clave = null;
//         }
//     }
// }
// echo $c;
?>
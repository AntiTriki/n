<?php
session_name('nilds');
session_start();
include_once('conexion.php');

    $qid="and c.serie=".$_POST['dato'];



$date = date('Y-m-d');



$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);

//$result = mysql_query("SELECT
//c.id,c.serie , ti.tipocom, c.fecha,c.glosa, t.cambio,e.estado,m.moneda
//FROM `comprobante` c,
// (select c.descripcion as estado,com.id as id from concepto c, comprobante com where com.id_estado=c.id) e,
//  (select c.descripcion as tipocom,com.id as id from concepto c, comprobante com where com.id_tipocomprobante=c.id) ti,
//   (select c.descripcion as moneda,com.id as id from concepto c, comprobante com where com.id_moneda=c.id) m,
//    tipo_cambio t where c.id=e.id and ti.id = c.id and m.id = c.id and t.id = c.id_tipocambio ORDER by id ASC");
//
//$i=1;
//while ($row = mysql_fetch_assoc($result)) {
//    $array[$i]['id'] = $row['id'];
//    $array[$i]['serie'] = $row['serie'];
//    $array[$i]['tipocom'] = $row['tipocom'];
//    $array[$i]['fecha'] = $row['fecha'];
//    $array[$i]['glosa'] = $row['glosa'];
//    $array[$i]['cambio'] = $row['cambio'];
//    $array[$i]['estado'] = $row['estado'];
//    $array[$i]['moneda'] = $row['moneda'];
//$i++;
//   }
$result = mysql_query("SELECT 
c.id,c.serie , ti.tipocom, c.fecha,c.glosa, t.cambio,e.estado,m.moneda 
FROM `comprobante` c,
 (select c.descripcion as estado,com.id as id from concepto c, comprobante com where com.id_estado=c.id) e,
  (select c.descripcion as tipocom,com.id as id from concepto c, comprobante com where com.id_tipocomprobante=c.id) ti,
   (select c.descripcion as moneda,com.id as id from concepto c, comprobante com where com.id_moneda=c.id) m,
    tipo_cambio t where c.id=e.id and ti.id = c.id and m.id = c.id and t.id = c.id_tipocambio $qid ORDER by id ASC LIMIT 1");

$i=1;
while ($row = mysql_fetch_assoc($result)) {
    $array['id'] = $row['id'];
    $array['serie'] = $row['serie'];
    $array['tipocom'] = $row['tipocom'];
    $row['fecha'] = date("d-m-Y", strtotime($row['fecha']));
    $array['fecha'] = $row['fecha'];
    $array['glosa'] = $row['glosa'];
    $array['cambio'] = $row['cambio'];
    $array['estado'] = $row['estado'];
    $array['moneda'] = $row['moneda'];
    $i++;
}
print json_encode($array);




































?>

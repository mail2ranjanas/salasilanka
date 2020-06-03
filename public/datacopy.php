<?php
$conn = mysqli_connect("localhost", "root", "", "laravel");

$affectedRow = 0;

$xml = simplexml_load_file("MATERIAL_BASE.xml") or die("Error: Cannot create object");

foreach ($xml as $row) {
    $id = $row->MATERIAL_x0020_ID;
    $MATERIAL_x0020_DESCRIPTION = $row->MATERIAL_x0020_DESCRIPTION;
    $MATERIAL_x0020_TYPE_x0020_ID = $row->MATERIAL_x0020_TYPE_x0020_ID;
    $UNIT_x0020_ID = $row->UNIT_x0020_ID;
    $KEINBY = $row->KEINBY;
    $ReorderQTY = $row->ReorderQTY;
    $SupplyLimit = $row->SupplyLimit;
    $REmaterial = $row->REmaterial;
    $CTVprohib = $row->CTVprohib;
    

   // INSERT INTO `materials` (`id`, `MATERIAL_ID`, `MATERIAL_DESCRIPTION`, `MATERIAL_TYPE_ID`, `UNIT_ID`, `KEINBY`, `ReorderQTY`, `SupplyLimit`, `REmaterial`, `CTVprohib`) VALUES (NULL, '1', '1', '1', '1', '1', '1', '1', '1', '1');
   
    $sql = "INSERT INTO `materials` (`id`, `MATERIAL_DESCRIPTION`, `MATERIAL_TYPE_ID`, `UNIT_ID`, `KEINBY`, 
    `ReorderQTY`, `SupplyLimit`, `REmaterial`, `CTVprohib`)
     VALUES ('$id','$MATERIAL_x0020_DESCRIPTION', '$MATERIAL_x0020_TYPE_x0020_ID', '$UNIT_x0020_ID', 
     '$KEINBY', '$ReorderQTY', '$SupplyLimit', '$REmaterial', '$CTVprohib')";
    //utf8mb4_unicode_ci
    $result = mysqli_query($conn, $sql);
    //echo('result ' . $result);
    if (! empty($result)) {
        $affectedRow ++;
    } else {
        $error_message = mysqli_error($conn) . "\n";
    }
}
?>
<h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}

?>
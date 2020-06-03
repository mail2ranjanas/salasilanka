<?php
$conn = mysqli_connect("localhost", "root", "", "laravel");

$affectedRow = 0;

$xml = simplexml_load_file("UNIT_BASE.xml") or die("Error: Cannot create object");

foreach ($xml as $row) {
    $id = $row->UNIT_x0020_ID;
    $unit = $row->UNIT;
    

   // INSERT INTO `materials` (`id`, `MATERIAL_ID`, `MATERIAL_DESCRIPTION`, `MATERIAL_TYPE_ID`, `UNIT_ID`, `KEINBY`, `ReorderQTY`, `SupplyLimit`, `REmaterial`, `CTVprohib`) VALUES (NULL, '1', '1', '1', '1', '1', '1', '1', '1', '1');
   
    $sql = "INSERT INTO `material_units` (`id`, `unit`)
     VALUES ('$id', '$unit')";
    //utf8mb4_unicode_ci
    $result = mysqli_query($conn, $sql);
    echo('result ' . $unit);
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
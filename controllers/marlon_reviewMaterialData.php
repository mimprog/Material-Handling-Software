<?php
require("../models/marlon_connection.php");

$sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId LEFT JOIN warehouse_inventory w ON w.inventoryId=e.inventoryId WHERE s.status = 1";
$ongoingQuery = $connection->query($sql);

$data = [];
$totalData = 0;
while($result = $ongoingQuery->fetch_assoc())
{
    extract($result);
     $data[] = [
        $bookingId,
        $materialTag,
        $bookingQuantity,
        $dataOne.' '.$dataTwo.'&times;'.$dataThree.'&times;'.$dataFour,
        $dataFive
    ];
    $totalData++;

}

$json_data = array(
    "draw"            => 1,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalData), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);
echo json_encode($json_data);  // send data as json format
?>
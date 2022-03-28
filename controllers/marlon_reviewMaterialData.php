<?php
require("../models/marlon_connection.php");

$sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE s.status = 1";
$ongoingQuery = $connection->query($sql);

$data = [];
$totalData = 0;
while($result = $ongoingQuery->fetch_assoc())
{
    extract($result);

    $sql = "SELECT * FROM warehouse_inventory WHERE inventoryId = '$inventoryId'";
    $query = $connection->query($sql);

    if($query->num_rows > 0)
    {
        $result2 = $query->fetch_assoc();
        extract($result2);
        $specs = $dataOne.' '.$dataTwo.' &times; '.$dataThree.' &times; '.$dataFour;
        $treatment = $dataFive;
    }
    else
    {
        $sql = "SELECT * FROM warehouse_inventoryHistory WHERE inventoryId = '".$result['inventoryId']."'";
        $query = $connection->query($sql);

        if($query->num_rows > 0)
        {
            $result3 = $query->fetch_assoc();
            extract($result3);
            $specs = $dataOne.' '.$dataTwo.' &times; '.$dataThree.' &times; '.$dataFour;
            $treatment = $dataFive;
        }
    }

     $data[] = [
        $bookingId,
        $materialTag,
        $bookingQuantity,
        $specs,
        $treatment
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
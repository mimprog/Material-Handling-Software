<?php
    require ('includes/marlon_connection.php');
    $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId LEFT JOIN warehouse_inventory w ON w.inventoryId=e.inventoryId WHERE s.status = 1";
    $ongoingQuery = $connection->query($sql);
    $total = 0;
    if (!empty($ongoingQuery))
    {
        $records = $ongoingQuery->num_rows;
        while ($result = mysqli_fetch_array($ongoingQuery)) {
            $total += $result['bookingQuantity'];
        };
    }
    else
    {
        $records = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap-min.css">   
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-sweetalert.css">
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/datatables.min.js"></script>
    <script src="./assets/js/sweetalert.min.js"></script>
    <title>Material Handling Software</title>
</head>
<body>
    <div class="container-fluid">
        <header>
            <h4>MATERIAL HANDLING SOFTWARE</h4>
        </header>
        <div class="card list-card text-center">
            <div class="card-body">
                <h6>PLEASE TRANSFER THIS/THESE BOOKING/S BELOW:</h6>
                <span>Record(s): <b><?php echo $records;?></b></span>
                <table id="review_material_table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <th>Booking</th>
                        <th>Inventory Id</th>
                        <th>Qty</th>
                        <th>Material Specs</th>
                        <th>Treatment</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tr class="last-tr">
                        <td colspan = '2'><b>TOTAL QUANTITY</b></td>
                        <td><b><?php echo $total;?></b></td>
                    </tr>
                </table>
                <button class="btn form-btn select_id" id="ongoingBtn" name="ongoing-btn">OK</button>
            </div>
        </div>
    </div>
	<script src="./assets/js/popper.min.js"></script>
	<script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/datatables.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
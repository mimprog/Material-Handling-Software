<?php
    session_start();
    if ($_SESSION['status'] != 'unfinished') {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card list-card text-center">
            <div class="card-body">
                <h6>PLEASE WITHDRAW THIS/THESE BOOKING/S BELOW:</h6>
                <span>Record(s): <b><?php echo totalRecords();?></b></span>
                <table id="requested_material_table" class="table table-bordered table-striped">
                    <thead>
                        <th>Booking</th>
                        <th>Inventory Id</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="booking"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                     <tr class="last-tr">
                        <td class="td_total" colspan = "2"><b>TOTAL QUANTITY</b></td>
                        <td><b><?php echo totalbookingQuantity();?></b></td>
                    </tr>
                </table>
                <button class="btn form-btn select_id mt-1" id="selectId" name="select_id">OK</button>
            </div>
        </div>
    </div>
	<?php include "views/foot/foot.php";?>
</body>
</html>
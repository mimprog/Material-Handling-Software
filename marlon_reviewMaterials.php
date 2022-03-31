<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card list-card text-center">
            <div class="card-body">
                <h6>PLEASE TRANSFER THIS/THESE BOOKING/S BELOW:</h6>
                <span>Record(s): <b id="reviewTotalRecords"><?php echo reviewTotalRecords();?></b></span>
                <table id="review_material_table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <th>Booking</th>
                        <th>Material Tag</th>
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
                        <td><b><?php echo reviewTotalbookingQuantity();?></b></td>
                    </tr>
                </table>
                <button class="btn form-btn select_id" id="ongoingBtn" name="ongoing-btn">OK</button>
            </div>
        </div>
    </div>
	<?php include "views/foot/foot.php";?>
</body>
</html>
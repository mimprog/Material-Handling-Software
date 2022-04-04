<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="loader"></div>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card list-card text-center">
            <div class="card-body">
                <h6>PLEASE TRANSFER THIS/THESE BOOKING/S BELOW:</h6>
                <span>Record(s): <b id="reviewTotalRecords"><?php echo reviewTotalRecords();?></b></span>
                <table id="review_material_table" class="table table-bordered table-striped review_material_table" width="100%">
                    <thead>
                        <th>Booking</th>
                        <th>Material Tag</th>
                        <th>Qty</th>
                        <th>Material Specs</th>
                        <th>Treatment</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tr class="last-tr">
                        <td colspan = '2'><b>TOTAL QUANTITY</b></td>
                        <td id="total"><b><?php echo reviewTotalBookingQuantity();?></b></td>
                        <td class="td-total"></td>
                        <td class="td-total"></td>
                        <td class="td-total"></td>
                    </tr>
                </table>
                <button class="btn form-btn select_id" id="ongoingBtn" name="ongoing-btn">OK</button>
            </div>
        </div>
    </div>
	<?php include "views/foot/foot.php";?>
</body>
</html>
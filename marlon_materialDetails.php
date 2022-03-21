<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card details-card text-center">
            <div class="card-body">
                <form method="POST" action="#">
                    <?php displayMaterial($_GET['bookingId']);?>
                    <input type="hidden" class="bookingId_input" value='<?php echo $_GET['bookingId']?>'>
                    <button type="submit" class="btn form-btn mt-4" id="mdetails-btn" name="m_details">OK</button>
                </form>
            </div>
        </div>
    </div>
	<?php include "views/foot/foot.php";?>
</body>
</html>
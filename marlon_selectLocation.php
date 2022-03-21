<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card small-card text-center">
            <div class="card-body">
                <form method="POST" action="#" autocomplete="off">
                    <h5 id="location-title">GO TO LOCATION:</h5>
                    <h5><i id="location_name">"<?php echo selectLocation($_GET['bookingId']);?>"</i></h5>
                    <h6 id="location_alert"></h6>
                    <input type="hidden" class="bookingId_input" value='<?php echo $_GET['bookingId']?>'>
                    <input type="hidden" class="page_input" value='<?php echo $_GET['page']?>'>
                    <input type="text" class="form-control mt-3 invisible" id="location-input" name="location" placeholder="Input Location" required>
                    <button type="submit" class="btn form-btn mt-4" id="location-btn" name="location_btn">OK</button>
                </form>
            </div>
        </div>
    </div>
<?php include "views/foot/foot.php";?>
</body>
</html>
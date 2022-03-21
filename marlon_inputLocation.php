<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card smallest-card text-center">
            <div class="card-body">
                <form method="POST" action="#" autocomplete="off">
                    <h5 id="location-title">INPUT LOCATION</h5>
                    <h6 id="location_alert"></h6>
                    <input type="text" class="form-control mt-4" id="set-location" name="set_location" placeholder="Input Location" required>
                    <button type="submit" class="btn form-btn mt-5" id="set-location-btn" name="set_location_btn" disabled>OK</button>
                </form>
            </div>
        </div>
    </div>
	<?php include "views/foot/foot.php";?>
</body>
</html>
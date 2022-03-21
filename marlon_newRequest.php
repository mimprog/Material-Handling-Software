<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card smallest-card text-center">
            <div class="card-body">
                <form method="POST" action="controllers/marlon_controller.php?bookingId=<?php echo $_GET['bookingId']?>" id="new_request_form">
                    <h4>New material transfer request</h4>
                    <button type="submit" class="btn form-btn mt-4" id="newrequest-btn" name="m_details">OK</button>
                </form>
            </div>
        </div>
    </div>
	<?php include "views/foot/foot.php";?>
</body>
</html>
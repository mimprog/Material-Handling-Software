<!DOCTYPE html>
<html lang="en">
<?php include "views/head/head.php";?>
<body>
    <div class="container-fluid">
    <?php include "views/header/header.php";?>
        <div class="card small-card text-center">
            <div class="card-body">
                <form method="POST" action="#" autocomplete="off">
                    <h5 id="mtag-title">LOOK FOR MATERIAL TAG:</h5>
                    <h5 id="mtag_name"><i>“<?php echo getMaterialTag($_GET['bookingId']);?>”</i></h5>
                    <h6 id="mtag_alert"></h6>
                    <input type="hidden" class="bookingId_input" value='<?php echo $_GET['bookingId']?>'>
                    <input type="text" class="form-control mt-3 invisible" id="material-tag" name="materialtag" placeholder="Input Material Tag" required>
                    <button type="submit" class="btn form-btn mt-4" id="mtag-btn" name="mtag_btn">OK</button>
                </form>
            </div>
        </div>
    </div>
	<?php include "views/foot/foot.php";?>
</body>
</html>
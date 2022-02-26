<?php 
    require ('includes/marlon_connection.php');
    $sql = "SELECT * FROM engineering_booking WHERE bookingId = '".$_GET['bookingId']."'";
    $getLocation = $connection->query($sql);
    if ($getLocation->num_rows != 0)
    {
        $result = $getLocation->fetch_assoc();
        $location = $result['location'];
    } 
    else
    {
        $location = '';
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
    <script src="./assets/js/sweetalert.min.js"></script>
    <title>Material Handling Software</title>
</head>
<body>
    <div class="container-fluid">
        <header>
            <h4>MATERIAL HANDLING SOFTWARE</h4>
        </header>
        <div class="card small-card text-center">
            <div class="card-body">
                <form method="POST" action="#" autocomplete="off">
                    <h5 id="location-title">GO TO LOCATION:</h5>
                    <h5><i id="location_name">"<?php echo $location?>"</i></h5>
                    <h6 id="location_alert"></h6>
                    <input type="hidden" class="bookingId_input" value='<?php echo $_GET['bookingId']?>'>
                    <input type="hidden" class="page_input" value='<?php echo $_GET['page']?>'>
                    <input type="text" class="form-control mt-3 invisible" id="location-input" name="location" placeholder="Input Location" required>
                    <button type="submit" class="btn form-btn mt-4" id="location-btn" name="location_btn">OK</button>
                </form>
            </div>
        </div>
    </div>
	<script src="./assets/js/popper.min.js"></script>
	<script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
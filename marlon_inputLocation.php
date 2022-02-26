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
	<script src="./assets/js/popper.min.js"></script>
	<script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
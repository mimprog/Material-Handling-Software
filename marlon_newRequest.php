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
    <title>Material Handling Software</title>
</head>
<body>
    <div class="container-fluid">
        <header>
            <h4>MATERIAL HANDLING SOFTWARE</h4>
        </header>
        <div class="card smallest-card text-center">
            <div class="card-body">
                <form method="POST" action="marlon_functions.php?bookingId=<?php echo $_GET['bookingId']?>" id="new_request_form">
                    <h4>New material transfer request</h4>
                    <button type="submit" class="btn form-btn mt-4" id="newrequest-btn" name="m_details">OK</button>
                </form>
            </div>
        </div>
    </div>
	<script src="./assets/js/popper.min.js"></script>
	<script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
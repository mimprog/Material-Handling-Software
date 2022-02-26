<?php
    require ('includes/marlon_connection.php');
    session_start();

    $sql = "SELECT * FROM system_bookingtransferrequest WHERE status = 0";
    $requestedBooking = $connection->query($sql);

    if($requestedBooking->num_rows != 0)
    {
        while($result = $requestedBooking->fetch_assoc())
        {
            $sql = "SELECT * FROM engineering_booking WHERE bookingStatus = 0 AND bookingId = '".$result['bookingId']."'";
            $withdrawStatus = $connection->query($sql);

            if($withdrawStatus->num_rows != 0)
            {
                $_SESSION['status'] = 'unfinished';
                header('location: marlon_unfinishedBooking.php');
            }
            else
            {
                session_destroy();
                header('location: marlon_noRecord.php');
            }
        }
    }
    else
    {
        session_destroy();
        header('location: marlon_noRecord.php');
    }
?>

<?php
    include "../models/marlon_functions.php";

    if (isset($_POST['m_details']))
    {
        $bookingId = $_GET['bookingId'];
        updateStartTime($bookingId);
        header('location: ../marlon_selectLocation.php?bookingId='.$bookingId);
    }

    if (isset($_POST['location']))
    {
        $location = $_POST['location'];
        checkLocation($location);
    }

    if (isset($_POST['materialtag']))
    {
        $materialTag = $_POST['materialtag'];
        checkMaterialTag($materialTag);
    }

    if(isset($_GET['updateStatus']))
    {
        changeStatus($_GET['bookingId']);
    }

    if(isset($_GET['location']))
    {   
        updateBooking($_GET['location']);
    }

     if((isset($_GET['action']) && isset($_GET['bookingId']) && $_GET['action']=='remove'))
    {
        removeBooking($_GET['bookingId']);
    }

    if(isset($_GET['action']) && $_GET['action']=='nextBookingId')
    {
        $sql = "SELECT * FROM system_bookingtransferrequest s 
        LEFT JOIN system_bookingtransferrequest e ON e.bookingId=s.bookingId 
        WHERE s.bookingStatus = 1 AND s.status = 0 LIMIT 1";
        $bookingStatus = $connection->query($sql);
        if($bookingStatus->num_rows > 0)
        {
            $result = mysqli_fetch_array($bookingStatus);
            header('location: ../marlon_newRequest.php?bookingId='.$result['bookingId']);
        }
        else
        {
            header('location: ../index.php');
        }
    }
?>
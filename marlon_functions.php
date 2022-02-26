<?php
    require ('includes/marlon_connection.php');

    function updateStartTime($id)
    {
        require ('includes/marlon_connection.php');
        $sql = "UPDATE system_bookingtransferrequest SET startTime = NOW() WHERE bookingId = '$id'";
        $updateStartTimeQuery = $connection->query($sql);
    }

    function checkLocation($locationName)
    {
        require ('includes/marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking WHERE bookingId = '".$_GET['bookingId']."' AND `location` = '$locationName'";
        $checkLocationQuery = $connection->query($sql);
        if($checkLocationQuery->num_rows != 0){echo 1;}
        else{echo 0;}
    }

    function checkMaterialTag($tag)
    {
        require ('includes/marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking WHERE bookingId = '".$_GET['bookingId']."' AND materialTag = '$tag'";
        $checkMaterialTagQuery = $connection->query($sql);
        if($checkMaterialTagQuery->num_rows != 0){echo 1;}
        else{echo 0;}
    }

    function displayMaterial($bookingId)
    {
        require ('includes/marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking b LEFT JOIN warehouse_inventory i ON i.inventoryId=b.inventoryId WHERE b.bookingId = '$bookingId'";
        $materialDetails = $connection->query($sql);
        if ($materialDetails->num_rows != 0)
        {
            $result = $materialDetails->fetch_assoc();
            echo '
            <h5>Booking Id: <i>'.$result['bookingId'].'</i></h5>
            <h5>Material Tag: <i>'.$result['materialTag'].'</i></h5>
            <h5>Quantity: <i>'.$result['bookingQuantity'].'</i></h5>
            <h5>Material Specs: <i>'.$result['dataOne'].' '.$result['dataTwo'].'&times;'.$result['dataThree'].'&times;'.$result['dataFour'].'</i></h5>
            <h5>Treatment: <i>'.$result['dataFive'].'</i></h5>';
        }
    }

    function changeStatus($bookingId)
    {
        require ('includes/marlon_connection.php');
        $sql = "UPDATE system_bookingtransferrequest SET status = 1 WHERE bookingId = '$bookingId'";
        $changeStatusQuery = $connection->query($sql);

        $sql2 = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE e.bookingStatus = 0 AND s.status = 0";
        $bookingStatus = $connection->query($sql2);
        if ($bookingStatus->num_rows > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

    function updateBooking($locationName)
    {
        require ('includes/marlon_connection.php');
        $sql = "SELECT bookingId FROM system_bookingtransferrequest WHERE status = 1";
        $ongoingQuery = $connection->query($sql);

        $bookingId = array();
        while ($result = mysqli_fetch_array($ongoingQuery))
        {
            array_push($bookingId, $result['bookingId']);
        }
        $implodeBookingId = implode("','", $bookingId);

        $sql = "UPDATE system_bookingtransferrequest s LEFT JOIN engineering_booking e ON e.bookingId=s.bookingId SET s.status = 2, e.location = '$locationName' WHERE s.bookingId IN ('$implodeBookingId')";
        $changeStatusQuery = $connection->query($sql);
        if($changeStatusQuery)
        {
            echo 'success';
        }
        else
        {
            echo $connection->error;
        }
    }

    if (isset($_POST['m_details']))
    {
        $bookingId = $_GET['bookingId'];
        updateStartTime($bookingId);
        header('location: marlon_selectLocation.php?bookingId='.$bookingId);
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

    if(isset($_GET['action']) && $_GET['action']=='nextBookingId')
    {
        $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE e.bookingStatus = 0 AND s.status = 0 LIMIT 1";
        $bookingStatus = $connection->query($sql);
        $result = mysqli_fetch_array($bookingStatus);
        header('location: marlon_newRequest.php?bookingId='.$result['bookingId']);
    }
?>
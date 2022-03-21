<?php
    require ('marlon_connection.php');

    function selectLocation($id){
        require ('models/marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking WHERE bookingId = '$id'";
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
        return $location;
    }

    function totalRecords(){
        require ('marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE e.bookingStatus = 0 AND s.status = 0";
        $bookingStatus = $connection->query($sql);
        if (!empty($bookingStatus))
        {
            $records = $bookingStatus->num_rows;
        }
        else
        {
            $records = 0;
        }
        return $records;
    }

     function totalbookingQuantity(){
        require ('marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE e.bookingStatus = 0 AND s.status = 0";
        $bookingStatus = $connection->query($sql);
        $total = 0;
        if (!empty($bookingStatus))
        {
            while ($result = mysqli_fetch_array($bookingStatus)) {
                $total += $result['bookingQuantity'];
            };
        }
        return $total;
    }

     function reviewTotalRecords(){
        require ('marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE e.bookingStatus = 0 AND s.status = 1";
        $bookingStatus = $connection->query($sql);
        if (!empty($bookingStatus))
        {
            $records = $bookingStatus->num_rows;
        }
        else
        {
            $records = 0;
        }
        return $records;
    }

     function reviewTotalbookingQuantity(){
        require ('marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE e.bookingStatus = 0 AND s.status = 1";
        $bookingStatus = $connection->query($sql);
        $total = 0;
        if (!empty($bookingStatus))
        {
            while ($result = mysqli_fetch_array($bookingStatus)) {
                $total += $result['bookingQuantity'];
            };
        }
        return $total;
    }

    function getMaterialTag($id){
        require ('marlon_connection.php');
        $sql = "SELECT materialTag FROM engineering_booking WHERE bookingId = '$id'";
        $getLocation = $connection->query($sql);
        if ($getLocation->num_rows != 0)
        {
            $result = $getLocation->fetch_assoc();
            $materialTag = $result['materialTag'];
        } 
        else
        {
            $materialTag = '';
        }
        return $materialTag;
    }

    function updateStartTime($id)
    {
        require ('marlon_connection.php');
        $sql = "UPDATE system_bookingtransferrequest SET startTime = NOW() WHERE bookingId = '$id'";
        $updateStartTimeQuery = $connection->query($sql);
    }

    function checkLocation($locationName)
    {
        require ('marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking WHERE bookingId = '".$_GET['bookingId']."' AND `location` = '$locationName'";
        $checkLocationQuery = $connection->query($sql);
        if($checkLocationQuery->num_rows != 0){echo 1;}
        else{echo 0;}
    }

    function checkMaterialTag($tag)
    {
        require ('marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking WHERE bookingId = '".$_GET['bookingId']."' AND materialTag = '$tag'";
        $checkMaterialTagQuery = $connection->query($sql);
        if($checkMaterialTagQuery->num_rows != 0){echo 1;}
        else{echo 0;}
    }

    function displayMaterial($bookingId)
    {
        require ('marlon_connection.php');
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
        require ('marlon_connection.php');
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
        require ('marlon_connection.php');
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
?>
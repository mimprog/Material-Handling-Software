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
        $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE s.status = 1";
        $bookingStatus = $connection->query($sql);
        if ($bookingStatus->num_rows > 0)
        {
            $records = $bookingStatus->num_rows;
        }
        else
        {
            $records = 0;
        }
        return $records;
    }

     function reviewTotalBookingQuantity(){
        require ('marlon_connection.php');
        $sql = "SELECT * FROM engineering_booking e LEFT JOIN system_bookingtransferrequest s ON s.bookingId=e.bookingId WHERE s.status = 1";
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

    function updateFinishTime($id)
    {
        require ('marlon_connection.php');
        $sql = "UPDATE system_bookingtransferrequest SET finishTime = NOW() WHERE bookingId IN ('$id')";
        $updateFinishTimeQuery = $connection->query($sql);
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

        $sql = "SELECT bookingId, materialTag, inventoryId, bookingQuantity FROM engineering_booking WHERE bookingId = '$bookingId'";
        $materialDetails = $connection->query($sql);
        if ($materialDetails->num_rows > 0)
        {
            $result = $materialDetails->fetch_assoc();
            $sql = "SELECT * FROM warehouse_inventory WHERE inventoryId = '".$result['inventoryId']."'";
            $query = $connection->query($sql);

            if($query->num_rows > 0)
            {
                $result2 = $query->fetch_assoc();
                echo '
                <h5>Booking Id: <i>'.$result['bookingId'].'</i></h5>
                <h5>Material Tag: <i>'.$result['materialTag'].'</i></h5>
                <h5>Quantity: <i>'.$result['bookingQuantity'].'</i></h5>
                <h5>Material Specs: <i>'.$result2['dataOne'].' '.$result2['dataTwo'].' &times; '.$result2['dataThree'].' &times; '.$result2['dataFour'].'</i></h5>
                <h5>Treatment: <i>'.$result2['dataFive'].'</i></h5>';
            }
            else
            {
                $sql = "SELECT * FROM warehouse_inventoryhistory WHERE inventoryId = '".$result['inventoryId']."'";
                $query = $connection->query($sql);

                if($query->num_rows > 0)
                {
                    $result3 = $query->fetch_assoc();
                    echo '
                    <h5>Booking Id: <i>'.$result['bookingId'].'</i></h5>
                    <h5>Material Tag: <i>'.$result['materialTag'].'</i></h5>
                    <h5>Quantity: <i>'.$result['bookingQuantity'].'</i></h5>
                    <h5>Material Specs: <i>'.$result3['dataOne'].' '.$result3['dataTwo'].' &times; '.$result3['dataThree'].' &times; '.$result3['dataFour'].'</i></h5>
                    <h5>Treatment: <i>'.$result3['dataFive'].'</i></h5>';
                }
            }
        }
    }

    function changeStatus($bookingId)
    {
        require ('marlon_connection.php');
        $sql = "UPDATE system_bookingtransferrequest SET status = 1 WHERE bookingId = '$bookingId'";
        $changeStatusQuery = $connection->query($sql);

        $sql2 = "SELECT * FROM system_bookingtransferrequest s 
        LEFT JOIN engineering_booking e ON e.bookingId=s.bookingId
        WHERE e.bookingStatus = 1 AND s.status = 0";
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

        updateFinishTime($implodeBookingId);

        $sql = "UPDATE system_bookingtransferrequest s 
        LEFT JOIN engineering_booking e ON e.bookingId=s.bookingId SET s.status = 2, e.location = '$locationName' 
        WHERE s.bookingId IN ('$implodeBookingId')";
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

    function transferBookingLink()
    {
        require ('marlon_connection.php');
        $sql = "SELECT status FROM system_bookingtransferrequest WHERE status = 1";
        $query = $connection->query($sql);

        $link = '';

        if($query->num_rows > 0){
            $link = "<a href='marlon_reviewMaterials.php'>TRANSFER BOOKING</a>";
        }
        echo $link;

    }

    function removeBooking($bookingId)
    {
        require ('marlon_connection.php');
        updateStartTime($bookingId);

        $sql = "UPDATE system_bookingtransferrequest SET startTime = '' WHERE bookingId = '$bookingId'";
        $query = $connection->query($sql);
        
        $sql2 = "UPDATE system_bookingtransferrequest SET status = 0 WHERE bookingId = '$bookingId'";
        $query2 = $connection->query($sql2);
        

        if($query && $query2){
            echo 1;
        } else {
            echo 2;
        }
    }

    function checkBooking($id)
    {
        require ('marlon_connection.php');
        $sql = "SELECT s.bookingId FROM system_bookingtransferrequest s 
                LEFT JOIN engineering_booking e ON e.bookingId = s.bookingId 
                WHERE s.bookingId = '$id' AND s.status = 0 AND e.bookingStatus != 1";
        $query = $connection->query($sql);

        if($query->num_rows > 0)
        {
            $sql = "UPDATE system_bookingtransferrequest 
                    SET startTime = '', finishTime = '', status = 2 
                    WHERE bookingId = '$id'";
            $query = $connection->query($sql);
            
            return 1;
        } else {
            return 0;
        }
    }
?>
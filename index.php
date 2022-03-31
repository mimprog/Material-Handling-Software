<?php
    require ('models/marlon_connection.php');
    session_start();

    $sql = "SELECT bookingId, status FROM system_bookingtransferrequest WHERE status = 0";
    $requestedBooking = $connection->query($sql);

    if($requestedBooking->num_rows > 0)
    {   
        $bookingId = array();
        while($result = $requestedBooking->fetch_assoc())
        {
            array_push($bookingId, $result['bookingId']);
        }
        
        $sql = "SELECT * FROM engineering_booking WHERE bookingId IN ('".implode("','",$bookingId)."') AND bookingStatus = '0'";
        $withdrawStatus = $connection->query($sql);
        if($withdrawStatus->num_rows > 0)
        {
            $_SESSION['status'] = 'unfinished';
            header('location: marlon_unfinishedBooking.php');
        }
        else
        {
            $sql2 = "SELECT * FROM engineering_booking WHERE bookingId IN ('".implode("','",$bookingId)."') AND bookingStatus = '1'";
            $withdrawStatus2 = $connection->query($sql2);
            $withdrawStatusResult2 = $withdrawStatus2->fetch_assoc();
            if($withdrawStatus2->num_rows > 0)
            {
                $_SESSION['status'] = 'new_request';
                header('location: marlon_newRequest.php?bookingId='.$bookingId[0]);
            }
            else
            {
                echo '<!DOCTYPE html>
                <html lang="en">';
                include "views/head/head.php";
                echo '<body>
                    <div class="container-fluid">';
                    include "views/header/header.php";

                echo '<div class="card empty-card text-center">
                        <div class="card-body">
                            <h5>NO RECORD</h5>
                        </div>
                    </div>
                </div>';
                include "views/foot/foot.php";
                echo'</body>
                    </html>';
            }
        }
    }
    else
    {
        session_destroy();
        echo '<!DOCTYPE html>
                <html lang="en">';
                include "views/head/head.php";
        echo '<body>
            <div class="container-fluid">';
            include "views/header/header.php";

        echo '<div class="card empty-card text-center">
                <div class="card-body">
                    <h5>NO BOOKING TRANSFER REQUEST</h5>';
                    transferBookingLink();
        echo '</div>
            </div>
        </div>';
        include "views/foot/foot.php";
        echo'</body>
            </html>';
    }
?>

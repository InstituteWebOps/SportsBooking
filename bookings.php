<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['rollno'])) header('Location: login.php');
include_once('include/_header.php');
require_once('config/db.php');

if(isset($_GET['del']))
{
    if(intval($_GET['del']))
    {
        // echo $_GET['del'];
        $statement = $link->query("SELECT file FROM $tablename WHERE id = ".$_GET['del']);
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        // print_r($res[0]['file']);
        if(!empty($res) && $res !== 'none')
        {
            unlink($res[0]['file']);
            $statement = $link->query("DELETE FROM $tablename WHERE id = ".$_GET['del']);
            $link->execute();
            header('location: bookings.php');
        }
    }
}
?>

    <div class="container">
        <legend class="text-center">Current bookings for <?php echo $_SESSION['rollno'] ?></legend>
        <table class="table table-striped table-hover ">
            <thead>
                <tr class="info">
                    <th>#</th>
                    <th>Date</th>
                    <th>Timings</th>
                    <th>Reason</th>
                    <th>File</th>
                    <th>Approved?</th>
                    <th>Delete Request</th>
                </tr>
            </thead>
            <tbody>
                <?php

            $statement = $link->query("SELECT * FROM $tablename WHERE lower(rollno) = lower('".$_SESSION['rollno']."')");  
            $bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

            if(empty($bookings))
            {
                echo "<div class=\"well well-lg\">Oops. You have no bookings. <a href=\"booknew.php\">Create a booking request</a></div>";
            }

            $apprStatus = array('-1' => 'Rejected', '0' => 'Pending review', '1' => 'Approved');

            foreach($bookings as $id => $booking)
            {
                // print_r($booking);
                echo "
                <tr>
                    <td>".($id+1)."</td>
                    <td>".$booking['date']."</td>
                    <td>".$booking['fromTime']." - ".$booking['toTime']."</td>
                    <td>".$booking['reason']."</td>
                    <td><a href=\"".$booking['file']."\">Click here</a></td>
                    <td>".($apprStatus[$booking['approved']])."</td>
                    <td><a class=\"btn btn-danger\" href=\"bookings.php?del=".$booking['id']."\">Delete Request</a></td>
                </tr>";
            }
                ?>
            </tbody>
        </table>
    </div>

    <?php
include_once('include/_footer.php');
?>
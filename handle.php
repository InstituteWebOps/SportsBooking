<?php

require_once('config/db.php');

if(!isset($_POST['action'])) die("Unauthorized access.");

// die($_POST['action']);

switch ($_POST['action']):
    // To add a new booking request
    case 'add':

        // print_r($_POST);
        // print_r($_FILES);
        // die('a');
    // print_r(isset($_FILES['uplFile']));
        // Uploading the file
        if(isset($_FILES) && $_FILES['uplFile']['size'] > 0)
        {
            $target_dir = "uploads/";
            $target_file = $target_dir.$_POST['date'].'_'.$_POST['venue'].'_'.basename($_FILES["uplFile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
            if ($_FILES["uplFile"]["size"] > 10*1000*1000) {
                echo "Sorry, your file is too large.";
                header('Location: booknew.php?e=size');
            }
    
            // Upload the permission document file
            move_uploaded_file($_FILES["uplFile"]["tmp_name"], $target_file) or die("Sorry, there was an error uploading your file.");
    
            // Set correct permissions
            chmod("$target_file", 0755);
        } else $target_file = 'none';

        
        // Enter details into db
        $statement = $link->prepare("INSERT INTO $tablename (email, rollno, venue, date, fromTime, toTime, reason, file)
                                    VALUES(:email, :rollno ,:venue, :date, :fromTime, :toTime, :reason, :file)");

        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':rollno', $_POST['rollno']);
        $statement->bindParam(':venue', $_POST['venue']);
        $statement->bindParam(':date', $_POST['date']);
        $statement->bindParam(':fromTime', $_POST['from']);
        $statement->bindParam(':toTime', $_POST['to']);
        $statement->bindParam(':reason', $_POST['reason']);
        $statement->bindParam(':file', $target_file);

        $statement->execute();

        //Show a confirmation.
        include_once('include/_header.php');
    
        echo '
        <div class="col-md-4 col-md-push-4 text-center">
        <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">Your booking has been recieved</h3>
        </div>
        <div class="panel-body">
          Please wait for the confirmation email
        </div>
        </div>
        </div>
        ';

        include_once('include/_footer.php');

        // header('Location: bookings.php');
        break;

    case 'list':
        $statement = $link->query("SELECT * FROM $tablename WHERE approved = 1"); // 
        die(json_encode($statement->fetchAll(PDO::FETCH_ASSOC)));
        break;

    case 'approve':
        // Admin panel reviwing updation code

    break;
endswitch;
?>
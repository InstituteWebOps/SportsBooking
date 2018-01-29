<!DOCTYPE html>
<?php
error_reporting(0);
session_start();
if (isset($_SESSION['rollno'])) header('Location: index.php');
include_once('include/_header.php');
echo isset($_SESSION['rollno']) == true;
?>
    <form method="POST" onsubmit="return false;" id="logInForm" class="col-md-6 col-md-push-3">
        <fieldset>
            <legend class="text-center">Log In</legend>
            <div class="form-group">
                <label for="rollno">Roll No.</label>
                <input type="text" name="rollno" class="form-control" id="rollno" placeholder="Enter your roll no.">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="text-center">
                <small id="errLogin" class="form-text text-danger hidden">Incorrect details</small>
                <br>
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </fieldset>
    </form>

<?php
    include_once('include/_footer.php');
?>
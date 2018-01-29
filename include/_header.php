<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports Booking</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="https://students.iitm.ac.in/sportsbooking">Booking - Sports@IITM</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="booknew.php">Make a new booking</a></li>
        <li><a href="bookings.php">Manage my bookings</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

      <!-- <li><a style="text-decoration: none; font-size: 130%;"><span class="text-danger glyphicon glyphicon-warning-sign"></span><span class="text-danger">  Site under construction</span></a></li> -->
      <?php
            session_start(); 
            if(isset($_SESSION['rollno']))
            {
                echo '
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, '.$_SESSION['rollno'].' <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="logout.php">Log Out</a></li>
                  </ul>
                </li>';
            } else
            {
                echo '
                <li><a href="login.php">Please Log In</a></li>';
            }
          ?>
      </ul>
    </div>
  </div>
</nav>
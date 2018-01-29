<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['rollno'])) header('Location: login.php');

include_once('include/_header.php');

?>
    <form method="POST" id="bookForm" action="handle.php" class="col-md-6 col-md-push-3 well" onsubmit="return validate();" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        <fieldset>
            <legend class="text-center">Book Venue</legend>
            <div class="form-group">
                <label for="rollno">Roll No.</label>
                <input type="text" name="rollno" class="form-control" id="rollno" readonly value="<?php echo $_SESSION['rollno'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email ID</label>
                <input type="email" required name="email" class="form-control" id="email" placeholder="Enter the email ID you want to recieve confirmation on" value="<?php echo strtolower($_SESSION['rollno']) ?>@smail.iitm.ac.in">
            </div>
            <div class="form-group">
                <label for="venue" class="col-md-3 control-label">Select Venue:</label>
                <div class="col-md-9">
                    <select name="venue" class="form-control" id="venue">
                        <option>Sangam</option>
                        <!-- <option>KV Ground</option> -->
                        <!-- <option>SAC</option> -->
                    </select>
                </div>
            </div>
        </fieldset>
        <br>
        <fieldset>
            <div class="form-group">
                <label for="date" class="col-md-3 control-label">Select Date:</label>
                <div class="col-md-9">
                    <input type="date" id="date" name="date" class="form-control" min="2018-01-01" max="2038-01-01" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <span class="text-danger hidden" id="dateerr">Please enter a valid time.</span>
                    <span class="text-danger hidden" id="bookerr"><br>This slot is already taken. Please choose another slot.</span>
                </div>
            </div>
        </fieldset>
        <br>
        <fieldset>
            <div class="form-group">
                <label for="from" class="col-md-3 control-label">From:</label>
                <div class="col-md-4">
                    <select class="form-control" id="from" name="from">
                            <option>06:00</option>
                            <option>07:00</option>
                            <option>08:00</option>
                            <option>09:00</option>
                            <option>10:00</option>
                            <option>11:00</option>
                            <option>12:00</option>
                            <option>13:00</option>
                            <option>14:00</option>
                            <option>15:00</option>
                            <option>16:00</option>
                            <option>17:00</option>
                            <option>18:00</option>
                            <option>19:00</option>
                            <option>20:00</option>
                            <option>21:00</option>
                            <option>22:00</option>
                            <option>23:00</option>
                            <option>00:00</option>
                    </select>        
                </div>
                <label for="to" class="col-md-1 control-label">To:</label>
                <div class="col-md-4">
                    <select class="form-control" id="to" name="to">
                            <option>06:00</option>
                            <option>07:00</option>
                            <option>08:00</option>
                            <option>09:00</option>
                            <option>10:00</option>
                            <option>11:00</option>
                            <option>12:00</option>
                            <option>13:00</option>
                            <option>14:00</option>
                            <option>15:00</option>
                            <option>16:00</option>
                            <option>17:00</option>
                            <option>18:00</option>
                            <option>19:00</option>
                            <option>20:00</option>
                            <option>21:00</option>
                            <option>22:00</option>
                            <option>23:00</option>
                            <option>00:00</option>
                    </select>        
                </div>
            </div>
            <span class="text-danger hidden" id="timeerr">Beginning time should not be greater than the ending date</span>
        </fieldset>
        <br>
        <fieldset>
            <div class="form-group">
                <label for="reason" class="col-md-3 control-label">Reason for Booking:</label>
                <div class="col-md-9">
                    <textarea class="form-control" rows="3" name="reason" id="reason" placeholder="Enter reason for booking here"></textarea>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="reason" class="col-md-3 control-label">Upload Permission Documents:</label>
                <div class="col-md-9">
                    <input type="file" id="file" name="uplFile" class="form-control" accept="application/msword,.pdf,image/*">
                    <span class="text-danger<?php echo (isset($_GET['e']) && ($_GET['e']=='size')?'':' hidden') ?>">Please make sure that the file does not exceed 10MB</span>
                    <span class="help-block">If you're experiencing problems uploading the document, kindly put a shareable google drive link in the textbox above.</span>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="text-center">
                <small id="status" class="form-text hidden">Bleh</small>
                <br>
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </fieldset>
        <!-- <hr style="border-top:2px dashed #aaa; margin: 10px 50px;"> -->
        <fieldset class="text-center" style="border:2px dashed #aaa; padding: 20px; margin: 20px;">
            <a onclick="loadBookings()" class="btn btn-success btn-sm">Show existing bookings</a>
            <br>
            <br>
            <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="info">
                        <th>Venue</th>
                        <th>Booked by</th>
                        <th>Booked on</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody id="bookShow">
                </tbody>
            </table> 
            </div> 
        </fieldset>
    </form>

<?php
    include_once('include/_footer.php');
?>
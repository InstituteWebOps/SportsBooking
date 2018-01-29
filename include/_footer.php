</div>
<script>

    function validate()
    {
        var isOk = 1;
        $('span.text-danger').addClass('hidden');
        if(parseInt($('#from').val()) >= parseInt($('#to').val()))
        {
            $('#timeerr').removeClass('hidden');
            isOk = 0;
        }
        console.log('1');

        var bookedDate = new Date($('#date').val());
        var currDate = new Date(Date.now());

        if(bookedDate.getMonth() < currDate.getMonth() || bookedDate.getYear() < currDate.getYear())
        {
            $('#dateerr').removeClass('hidden');
            isOk = 0;
            console.log('2');
        } else
        {
            if(bookedDate.getMonth() == currDate.getMonth() && bookedDate.getYear() == currDate.getYear() && bookedDate.getDate() < currDate.getDate())
            {
                $('#dateerr').removeClass('hidden');
                isOk = 0;
            }
        }
        console.log('3');
        // Check if a booking is already there
        var list = JSON.parse(fetchBookings().responseText);
        for(i in list)
        {
            if ($("#date").val() == list[i].date)
            {
                if(!(
                    ((parseInt($("#from").val())>=parseInt(list[i].toTime)) && (parseInt($("#to").val())>parseInt(list[i].toTime)))
                    ||
                    (parseInt($("#from").val())<parseInt(list[i].fromTime) && (parseInt($("#to").val())<=parseInt(list[i].fromTime)))
                )) {
                    isOk = 0;
                    console.log(list[i]);
                    console.log(parseInt($("#from").val())>parseInt(list[i].toTime));
                    console.log(parseInt($("#to").val())>parseInt(list[i].toTime));
                    console.log(parseInt($("#from").val())<parseInt(list[i].fromTime));
                    console.log(parseInt($("#to").val())<parseInt(list[i].fromTime));
                    $('#bookerr').removeClass('hidden');
                    // break;
                }
            }
        }

        if(isOk)
        {
            $('#wokay').removeClass('hidden');            
            //submit the form
            // $('#bookForm').submit();


            // var url = "handle.php"; // the script where you handle the form input.

            // $.ajax({
            //     type: "POST",
            //     url: url,
            //     processData: false,
            //     contentType: false,
            //     data: $("#bookForm").serialize(), // serializes the form's elements.
            //     success: function(data)
            //     {
            //         console.log(data); // show response from the php script.
            //     }
            // });

            return true;

        } else
        {
            return false;
        }
    }

    function loadBookings()
    {
        var list = JSON.parse(fetchBookings().responseText);
        $('#bookShow').html('');
        for(i in list)
        {
            $('#bookShow').append(`
            <tr>
                <td>${list[i].venue}</td>
                <td>${list[i].email}</td>
                <td>${list[i].date}</td>
                <td>${list[i].fromTime}</td>
                <td>${list[i].toTime}</td>
            </tr>
            `)   
        }

    }

    function fetchBookings()
    {
        return $.ajax({type: 'POST', url: 'handle.php', data: {'action': 'list'}, async: false});
    }

    $('#logInForm').submit(function(e)
    {
        $('#errLogin').addClass('hidden');
        e.preventDefault();
        $.post('ldapauth.php', {
            'username': $('#rollno').val(),
            'password': $('#password').val()
        }, function(data, status) 
        {
            data = JSON.parse(data);
            console.log(data);
            if(data['status'] == 'success') window.location = 'index.php';
            else 
            {
                $('#errLogin').text('Error: '+data['details']);
                $('#errLogin').removeClass('hidden');
                // $('#errLogin').show();
            }
        });
    });
</script>
</body>
</html>
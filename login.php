<?php
session_start();
require_once('config.php');
unset($_SESSION['user_profile']);
?>



<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/login.css">

</head>
<body>


<div>
    <?php require_once 'banner.php';?>
    
    <div>

        <div class="container">
            <div class="row">
                <div class="col-5.5">
                    <h1>Login</h1>
                    <p>Please Enter Your Account Details</p>
                    <hr class="mb-2">
                    <p id="msg_error"></p>

                    <label for="email"><b>Email</b></label>
                    <input class="form-control" type="email" name="email" required id="email">

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" type="password" name="password" required id="password">

                    <h6 style="color: red;" id="login_failed"></h6>
                    <hr class="mb-2">

                    <button class="submit-button" onclick="on_login();">Log In</button>
                    <input class="register-button" type="button" value="Register"
                        onclick="window.location.href='registration.php'">

                </div>
            </div>
        </div>

    </div>

                                                
    <div class="modal fade" id="modal_ban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Your account have been banned</h5>
        </div>
        <div class="modal-body">
            
            <div class="form-group">
                <label for="modal_reason" class="col-form-label">Reason:</label>
                <p class="form-control" id="modal_reason"></p>
            </div>
            <div class="form-group">
                <label for="modal_duration" class="col-form-label">Duration: (in days)</label>
                <p type="number" class="form-control" id="modal_duration"></p>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</div>

</body>

</html>


<script>
    function on_login() {
        var email = document.querySelector('#email');
        var password = document.querySelector('#password');
        var login_failed = document.querySelector('#login_failed');
        login_failed.innerHTML = "";
        
        var modal_reason = document.querySelector('#modal_reason');
        var modal_duration = document.querySelector('#modal_duration');

        $.ajax({
            type: "POST",
            url: "https://gladiatorbowl.000webhostapp.com/on_login.php",
            data: { email: email.value,
                    password: password.value},
            success: (response) => {
                if (response == 0)
                    window.location.href='Gladiator_Bowl_Home.php';
                else
                {
                    if (response == 1)
                        login_failed.innerHTML = "Invalid email or password.";
                    else
                    {
                        var ban = JSON.parse(response);
                        modal_reason.innerHTML = ban.reason;
                        modal_duration.innerHTML = ban.duration + " days";
                        $('#modal_ban').modal('show');
                    }
                }



            }
        });


        email.value = "";
        password.value = "";
    }
</script>
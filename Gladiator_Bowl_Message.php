<?php // Var
session_start();
require_once "config.php";
$user = $_SESSION['user'];
$user_profile = $_SESSION['user_profile'];

?>




<!DOCTYPE html>
<html>
<head>
    <title>Gladiator Bowl - Message</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="Gladiator_Bowl_Message.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        
    </style>

</head>




<body>
    <div class="row">
        <?php require "banner.php"; ?>
    </div>

    <div id="main" class="row">

        <div class="container_contact col-md-3 col-sm-3">
            <h1 style="text-align: center;"> <i class="material-icons ">contacts</i> Contacts</h1>
            <div class="container_mini_profile">

                <div class="mini_profile row">
                    <div class="col-md-2 col-sm-2" style="margin: 20px">
                        <img class="mini_profile_picture" src="https://www.journaldugeek.com/content/uploads/2022/11/copie-de-ajouter-un-titre-50.jpg">
                    </div>
                    <div class="col-md-7 col-sm-7" style="margin-top: 25px; margin-left: 10px">
                        <h3>Name Surname</h3>
                        <h5 style="color: #999999">Fighter</h5>
                    </div>
                </div>
                <br>

                <div class="mini_profile row">
                    <div class="col-md-2 col-sm-2" style="margin: 20px">
                        <img class="mini_profile_picture" src="https://www.journaldugeek.com/content/uploads/2022/11/copie-de-ajouter-un-titre-50.jpg">
                    </div>
                    <div class="col-md-7 col-sm-7" style="margin-top: 25px; margin-left: 10px">
                        <h3>Name Surname</h3>
                        <h5 style="color: #999999">Fighter</h5>
                    </div>
                </div>
                <br>
                <div class="mini_profile row">
                    <div class="col-md-2 col-sm-2" style="margin: 20px">
                        <img class="mini_profile_picture" src="https://www.journaldugeek.com/content/uploads/2022/11/copie-de-ajouter-un-titre-50.jpg">
                    </div>
                    <div class="col-md-7 col-sm-7" style="margin-top: 25px; margin-left: 10px">
                        <h3>Name Surname</h3>
                        <h5 style="color: #999999">Fighter</h5>
                    </div>
                </div>
                <br>
            </div>
        </div>


        <div class="container_center col-md-6 col-sm-6">

            <div class="container_title">
                <h1> <i class="material-icons ">chat</i> Message </h1>
            </div>

            <div class="row " style="height: 90%; width: 100%">

                <div style="height: 100%; width: 100%">

                    <section class="msger">
                        <header class="msger-header">
                            <div class="msger-header-title">
                                <i class="fas fa-comment-alt"></i> Name
                            </div>
                            <div class="msger-header-options">
                                <span><i class="fas fa-cog"></i></span>
                            </div>
                        </header>

                        <main class="msger-chat container_only_message">
                            <div id="bottom">
                                <div class="msg left-msg">
                                    <div
                                            class="msg-img"
                                            style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">User</div>
                                            <div class="msg-info-time">12:45</div>
                                        </div>

                                        <div class="msg-text">
                                            Hi, go ahead and send me a message. 😄
                                        </div>
                                    </div>
                                </div>
                                <div class="msg left-msg">
                                    <div
                                            class="msg-img"
                                            style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">User</div>
                                            <div class="msg-info-time">12:45</div>
                                        </div>

                                        <div class="msg-text">
                                            Hi, go ahead and send me a message. 😄
                                        </div>
                                    </div>
                                </div>
                                <div class="msg left-msg">
                                    <div
                                            class="msg-img"
                                            style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">User</div>
                                            <div class="msg-info-time">12:45</div>
                                        </div>

                                        <div class="msg-text">
                                            Hi, go ahead and send me a message. 😄
                                        </div>
                                    </div>
                                </div>
                                <div class="msg left-msg">
                                    <div
                                            class="msg-img"
                                            style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">User</div>
                                            <div class="msg-info-time">12:45</div>
                                        </div>

                                        <div class="msg-text">
                                            Hi, go ahead and send me a message. 😄
                                        </div>
                                    </div>
                                </div>
                                <div class="msg left-msg">
                                    <div
                                            class="msg-img"
                                            style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">User</div>
                                            <div class="msg-info-time">12:45</div>
                                        </div>

                                        <div class="msg-text">
                                            Hi, go ahead and send me a message. 😄
                                        </div>
                                    </div>
                                </div>
                                <div class="msg left-msg">
                                    <div
                                            class="msg-img"
                                            style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">User</div>
                                            <div class="msg-info-time">12:45</div>
                                        </div>

                                        <div class="msg-text">
                                            Hi, go ahead and send me a message. 😄
                                        </div>
                                    </div>
                                </div>

                                <div class="msg right-msg">
                                    <div
                                            class="msg-img"
                                            style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">Sajad</div>
                                            <div class="msg-info-time">12:46</div>
                                        </div>

                                        <div class="msg-text">
                                            Hello ! This is a test message
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </main>

                        <form class="msger-inputarea">
                            <input type="text" class="msger-input" placeholder="Enter your message...">
                            <button type="submit" class="msger-send-btn">Send</button>
                        </form>
                    </section>
                </div>

            </div>

        </div>


        <div class="container_center col-md-3 col-sm-3">
            <?php require "full_profile.php" ?>
        </div>



    </div>
</body>

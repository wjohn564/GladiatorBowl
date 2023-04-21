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
    <link rel="stylesheet" href="Gladiator_Bowl_Home.css">
    <link rel="stylesheet" href="message.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <script type="text/javascript" src="message.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        
    </style>

</head>


<body>

    <div id="main">
          

        <div class="container3">  
            
            <div class="container_title"> 
                <h1> <i class="material-icons ">chat</i> Message </h1>
            </div>
            

            <div class="row">
                <div class="container_pp">       
                    <img class="profile_picture" src="https://www.journaldugeek.com/content/uploads/2022/11/copie-de-ajouter-un-titre-50.jpg">
                    <br>
                    <img class="profile_picture" src="https://www.journaldugeek.com/content/uploads/2022/11/copie-de-ajouter-un-titre-50.jpg">
                    <br>
                    <img class="profile_picture" src="https://www.journaldugeek.com/content/uploads/2022/11/copie-de-ajouter-un-titre-50.jpg">
                    <br>
                    <img class="profile_picture" src="https://www.journaldugeek.com/content/uploads/2022/11/copie-de-ajouter-un-titre-50.jpg">
                </div>

                <div class="col-md-9 col-sm-9">
                    <section class="msger">
                      <header class="msger-header">
                        <div class="msger-header-title">
                          <i class="fas fa-comment-alt"></i> Name
                        </div>
                        <div class="msger-header-options">
                          <span><i class="fas fa-cog"></i></span>
                        </div>
                      </header>

                      <main class="msger-chat">
                        <div class="msg left-msg">
                          <div
                           class="msg-img"
                           style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                          ></div>

                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">BOT</div>
                              <div class="msg-info-time">12:45</div>
                            </div>

                            <div class="msg-text">
                              Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
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
                              You can change your name in JS section!
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



    </div>
</body>

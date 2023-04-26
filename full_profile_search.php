<?php
session_start();
?>



<link rel="stylesheet" href="css/full_profile_search.css">
<body class="general_full_profile">

    <br>
    <img id="search_profile_picture" class="profile_picture" src=""
         onerror="this.onerror=null; this.src='https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png';">
    <br><br>
    <h2 id="search_name" style="color: white;"></h2>
    <h3 id="search_type" style="color: #0b5ed7 "></h3>
    <hr style="color: grey"><br>

    <h4 id="search_description" style="color: #999999;"> </h4>

    <br>

    <div id="show_more2">
        
            
        <h6 style="color: white; text-align: left;" > Fight result</h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h3 id="search_wins" style="color: white;"> </h3>
        <h3 id="search_draws" style="color: white;">  </h3>
        <h3 id="search_losses" style="color: white;"> </h3>
        
        
        <br>
        <h6 style="color: white; text-align: left;" > Specification </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h3 id="search_fighting_style" style="color: white; "></h3>
        <h3 id="search_gender" style="color: white;"></h3>
        <h3 id="search_age" style="color: white;"> </h3>
        <h3 id="search_weight" style="color: white;"></h3>
        <h3 id="search_height" style="color: white;">  </h3>

        <br>
        <h6 style="color: white; text-align: left;" > Medical history </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <h4 id="search_medical_history" style="color: #999999;">  </h4>

        <br>

        <h6 style="color: white; text-align: left;" > Fight videos </h6>
        <hr style="color: #a8a8a8 ; height: 3px; background-color: #a8a8a8;" ><br>
        <iframe src=""></iframe> 
        

    </div>


    <script>
        var show_more2 = document.querySelector('#show_more2');
        show_more2.style.display = 'none';
    </script>

    

</body>
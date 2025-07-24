<?php

  include("connection.php");

  session_start();
  $flag = false;
  if(isset($_SESSION['username'])){
    $button_name = $_SESSION['username'];
    $flag = true;
  }

  if(isset($_POST['room_clicked_id'])){
    $id = (int)$_POST['room_clicked_id'];
    $query = "Update room_info set room_status = 'Booked' where room_id = $id";
    $run = mysqli_query($conn,$query);

    $query = "INSERT INTO `booking_info` (`room_id`, `username`)
    VALUES ($id, '$button_name')";
    $run = mysqli_query($conn,$query);
  }

  if( isset(   $_GET['ac'],$_GET['catagories']    ) ){
    $catagories = $_GET['catagories'];
    $ac = $_GET['ac'];
    $cat = "";
    foreach($catagories as $c){
        $cat .= "'$c',";
    }
    $cat = rtrim($cat,',');

    $query = "SELECT * FROM room_info where room_catagory in($cat) and room_condition = '$ac'";


}
else if( isset(   $_GET['ac']   ) ){
    $ac = $_GET['ac'];
    $query = "SELECT * FROM room_info where  room_condition = '$ac'";

}
else if( isset(  $_GET['catagories']    ) ){
    $catagories = $_GET['catagories'];
    $cat = "";
    foreach($catagories as $c){
        $cat .= "'$c',";
    }
    $cat = rtrim($cat,',');

    $query = "SELECT * FROM room_info where room_catagory in($cat)";


}
else if( isset(  $_GET['search']   ) ){
    $search = $_GET['search'];
    $query = "SELECT * FROM room_info WHERE room_name LIKE '%$search%'";
}
else{
    $query = "select * from room_info";
   
}
$data = mysqli_query($conn,$query);

  
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    .body{
      position:relative;
    }
    .login_form{
      width: 30%;
      position: fixed;
      top: 80px;
      left: 40%;
      background-color: white;
      box-sizing: border-box;
      padding: 15px;
      padding-bottom: 25px;
      border-radius: 8px;
      z-index: 10;
      display: none;
      
    }

    .login_form_head{
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
      height: 40px;
      box-sizing: border-box;
      padding-bottom: 50px;
    }
    .login_form_head >div{
      display: flex;
      justify-content: space-between;
    }
    .login_form_head >div>p{
      margin-top: 5px;
      font-size: 21px;
      font-weight: 500;
    }
    .alert{
      position: absolute;
      top:100px;
      right: 50px;
    }
    .mnu {
    position: absolute;
    width: 260px;
    background-color: white;
    top: 100px;
    right: 150px;
    border-radius: 20px;

    visibility: hidden;
    opacity: 0;
    transition: 0.5s;

    }

    .active2{
      visibility: visible;
      opacity: 1;
      top: 100px;

    }

    .mnu::before{
      content: "";
      background-color: white;
      width: 15px;
      height: 15px;
      position: absolute;
      top: -8px;
      right: 35px;
      rotate: 45deg;
    }

    .mnu h3{
      font-size: 1.4rem;
      text-align: center;
      margin: 18px 0 5px;
    }

    .mnu p{
      font-size: 1rem;
      text-align: center;
      color: #b9b9b9;
      margin-bottom: 20px;
    }

    .mnu ul{
      margin-bottom: 20px;
      list-style-type: none;
      margin-left: -30px;

    }
    .mnu ul li{
      padding: 15px 20px;
      border-top: 1px solid #33333310;
      background: #ffffff;
      transition: 0.5s;
    }

    .mnu ul li:hover{
      background: #e7e7e7;
    }

    .mnu ul li a{
      font-size: 1 rem;
      color: #292929;
      margin-left: 20px;
    }     

    .search-container {
      background-color: white;
      border-radius: 50px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      padding: 8px;
      max-width: 500px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .search-container:hover {
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .form-control.search-input {
      border: none;
      background: transparent;
      padding-left: 20px;
      font-size: 1rem;
      height: 50px;
    }

    .form-control.search-input:focus {
      box-shadow: none;
      outline: none;
    }

    .btn-search {
      background-color: var(--primary-color);
      color: white;
      border-radius: 50px;
      padding: 10px 20px;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-search:hover {
      background-color: var(--primary-color-dark);
      transform: scale(1.05);
      color: white;
    }

    .search-icon {
      color: #6c757d;
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
    }

    .container {
      margin-top: 30px;
    }

    .body {

      position: relative;
    }

    .filter {
      position: absolute;
      border: 2px solid var(--primary-color);
      top: 140px;
      right: 430px;


    }

    .filter:hover {
      background-color: var(--primary-color);
      color: white;
    }


    .menu3 {
      position: absolute;
      width: 285px;
      background-color: white;

      border-radius: 20px;

      display: none;

      border: 2px solid var(--primary-color);
    }

    .active {
      display: block;
      top: 200px;
      right: 400px;

    }

    .before1::before {
      content: "";
      background-color: white;
      width: 15px;
      position: absolute;
      top: -8px;
      right: 30px;
      rotate: 45deg;
      border: 1px solid var(--primary-color);
    }

    .before2::before {
      content: "";
      background-color: white;
      width: 15px;
      position: absolute;
      top: -8px;
      right: 40px;
      rotate: -45deg;
      border: 1px solid var(--primary-color);
    }

    h3 {
      font-size: 1.2rem;
      margin: 18px 0 5px;
      text-align: center;
      padding: 2px;

    }

    .menu p {
      font-size: 1rem;
      text-align: center;
      color: #b9b9b9;
      margin-bottom: 20px;
    }



    .insideform {
      margin-left: 15px;
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
      gap: 10px;
      padding-bottom: 10px;


    }

    .newform {
      padding-bottom: 10px;
      z-index: 200;
      isolation: isolate;
    }

    .first {
      opacity: 0;
    }

    .applyf {
      margin-top: 5px;
      margin-left: 90px;
      font-size: 1 rem;
      background-color: var(--primary-color);
      color: white;
    }

    .applyf:hover {
      background-color: var(--primary-color-dark);
      color: white;
    }
   
    
    
  </style>

</head>

<body>
  <script src="https://unpkg.com/scrollreveal"></script>
    <div class="login_form">
      <form action ="#"method="post">
        <div class="login_form_head">
          <div>
            <i class="bi bi-person-circle fs-3 me-2"></i>
            <p>User Login</p>
          </div>
          <button type="reset" id ="login-reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" >
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" >
        </div>
        <button type="button" onclick="validate_login()" id = "login-submit"name="user_login" class=" btn btn-dark shadow-none">Login</button>
      </form>
    
    </div>
    <div class="modal fade" id="registerModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="process.php" id ="myForm" method ="post">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-person-lines-fill fs-3 me-2"></i>
              User Registration
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" name="name" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Email</label>
                    <input type="text" name="email" id = "email" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="text" name="phone" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">User ID</label>
                  <input type="text" name="user_id" id="user-id" class="form-control shadow-none" >
                </div>

                <div class="col-md-12 p-0 mb-3">
                  <label class="form-label">Address</label>
                  <textarea class="form-control shadow-none" name="address" rows="1"></textarea>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">NID NO</label>
                  <input type="text" name="nid_no" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Age</label>
                  <input type="text" name="age" class="form-control shadow-none" >
                </div>
              
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" class="form-control shadow-none" >
                </div>
              </div>   
              <div class="text-conter my-1">
                <button type="button" onclick="validate_reg()"  name = "register" class =" btn btn-dark shadow-none">REGISTER</button>
              </div>
            </div>
          </div> 
        </form>
      </div>
      </div>
    </div> 
  <div class="newheader">
    <nav class="newnav">
      <div class="nav__bar">
        <div class="logo">
          <a href="index.html"><img src="assets/laxariya.png" alt="logo" /></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-line"></i>
        </div>
      </div>
      <ul class="nav__links " id="nav-links" style="margin-top: 10px;">
        <li><a href="index.php">Home</a></li>
        <li><a href="rooms.php">Rooms</a></li>
        <li><a href="index.php#service">Services</a></li>
        <li><a href="index.php#explore">Explore</a></li>
        <li><a href="About.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <button class="bttn nav__btn"> <i class="ri-menu-line"></i>  <?php if($flag)echo"$button_name"; else echo"Sign In"; ?></button>

      <?php

        if($flag){
          echo"

          <div class='mnu mnu2'>
            <h3>".$_SESSION['fullname']."</h3>
          <p>Star Client</p>
          <ul>
              
              <li>
                <a href='user.php'> Profile </a>
              </li>
              <li>
                  <a href='user_logout.php'>Log Out</a>
              </li>


          </ul>
        </div>


          ";
        }
        else{
            echo"

            <div class='mnu mnu2'>
              <h3>Sign In</h3>
              <p>Not a Member?&nbsp;<a id = 'usr-reg' style ='color: black; text-decoration: underline;' href = '#' data-bs-toggle='modal' data-bs-target='#registerModel'>Register</a></p>
              <ul>
                  
                  <li id = 'usr-login'>
                    <a href='#' > User Login </a>
                  </li>
                  <li >
                      <a href='admin_login.php' >Admin Login</a>
                  </li>


              </ul>
            </div>

                ";
          }

      ?>


    </nav>
  </div>


  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="search-container position-relative">
          <form class="d-flex align-items-center" action = "rooms.php" method="get">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="search-icon feather feather-search">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input class="form-control search-input ps-5" type="search" name = "search" placeholder="Search a room" aria-label="Search">
            <button class="btn btn-search ms-2" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <button class="btn filter ms-2" onclick="show_filters()"><i class="ri-equalizer-line"></i>&nbsp;Filter</button>
  <div class="menu menu3">
    <span class="before1"></span>
    <span class="before2"></span>

    <form class="newform" action = "rooms.php" method="get">
      <h3>Catagories</h3>

      <div class="insideform">
        <div class="formitem">
          <input type="checkbox" id="sdeluxe" value="Super Deluxe" name="catagories[]" />
          <label for="sdeluxe">Super Deluxe</label>
        </div>
        <div class="formitem">
          <input type="checkbox" id="deluxe" value="Deluxe" name="catagories[]" />
          <label for="deluxe">Deluxe</label>
        </div>
        <div class="formitem">
          <input type="checkbox" id="exec" value="Executive" name="catagories[]" />
          <label for="exec">Executive</label>
        </div>
        <div class="formitem">
          <input type="checkbox" id="family" value="Family" name="catagories[]" />
          <label for="family">Family</label>
        </div>
        <div class="formitem">
          <input type="checkbox" id="regular" value="Regular" name="catagories[]" />
          <label for="regular">Regular</label>
        </div>
      </div>

      <h3>Air Condition</h3>
      <div class="insideform">

        <div class="formitem">
          <input type="radio" id="ac" value="AC" name="ac" />
          <label for="ac">AC</label>
        </div>
        <div class="formitem ">
          <input type="radio" id="non-ac" value="NON-AC" name="ac" />
          <label for="non-ac">NON-AC</label>
        </div>


      </div>




      <button class="btn applyf" type="submit">Apply Filter</button>

    </form>
  </div>


  <?php
              if(mysqli_num_rows($data)>0){

                            echo"

                  <section class='section__container room__container'>
                  <p class='section__subheader'>OUR LIVING ROOMS</p>
                  <h2 class='section__header'>The Most Memorable Rest Time Starts Here.</h2>
                  <div class='room__grid'>"; }
              else {
                echo"
                     <section class='section__container room__container'>
                          <h2 class='section__header' style = 'margin-left: 200px;'>Sorry! No Rooms Available</h2>
                    </section>

              ";
              };
        
              while($row = mysqli_fetch_assoc($data)){
                echo"
                    <div class='room__card'>
                      <div class='room__card__image'>
                        <img src=".$row['room_image']."alt='room' />
                        <div class='room__card__icons'>
                          
                          <span><i >".$row['room_catagory']."</i></span>
                          <span><i >".$row['room_condition']."</i></span>
                        </div>
                      </div>
                      <div class='room__card__details'>
                        <h4>".$row['room_name']."</h4>
                        <p>"
                          .$row['room_desc'].
                        "</p>
                        <h5>Starting from <span>$".$row['room_price']."/night</span></h5>
                        ";

                        if($row['room_status']=="Booked"){
                          echo" <button class='btn btn-danger' >".$row['room_status']."</button>";
                        }
                        else{
                          echo"<button onclick='book_room(".(int)$row['room_id'].",".$flag.")' class='bttn'>Book Now</button>" ; }
                       echo" 
                      </div>
                    </div>

              ";
              };

              
      echo"</div>
    </section>";



                
                
              
      ?>
  


  <footer class="footer" id="contact">
    <div class="section__container footer__container">
      <div class="footer__col">
        <div class="logo">
          <a href="#home"><img src="assets/laxariya.png" alt="logo" /></a>
        </div>
        <p class="section__description">
          Discover a world of comfort, luxury, and adventure as you explore
          our curated selection of hotels, making every moment of your getaway
          truly extraordinary.
        </p>
        <button class="bttn">Book Now</button>
      </div>
      <div class="footer__col">
        <h4>QUICK LINKS</h4>
        <ul class="footer__links">
          <li><a href="#">Browse Destinations</a></li>
          <li><a href="#">Special Offers & Packages</a></li>
          <li><a href="#">Room Types & Amenities</a></li>
          <li><a href="#">Customer Reviews & Ratings</a></li>
          <li><a href="#">Travel Tips & Guides</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h4>OUR SERVICES</h4>
        <ul class="footer__links">
          <li><a href="#">Concierge Assistance</a></li>
          <li><a href="#">Flexible Booking Options</a></li>
          <li><a href="#">Airport Transfers</a></li>
          <li><a href="#">Wellness & Recreation</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h4>CONTACT US</h4>
        <ul class="footer__links">
          <li><a href="#">laxariya@info.com</a></li>
        </ul>
        <div class="footer__socials">
          <a href="#"><img src="assets/facebook.png" alt="facebook" /></a>
          <a href="#"><img src="assets/instagram.png" alt="instagram" /></a>
          <a href="#"><img src="assets/youtube.png" alt="youtube" /></a>
          <a href="#"><img src="assets/twitter.png" alt="twitter" /></a>
        </div>
      </div>
    </div>
    <div class="footer__bar">
      Copyright © 2025 Muhammad Talha. All rights reserved.
    </div>
  </footer>
  <script >
    const scrollRevealOption = {
        distance: "50px",
        origin: "bottom",
        duration: 1000
      }

      ScrollReveal().reveal(".room__card", {
        ...scrollRevealOption,
        interval: 500,
      });
    let navbutton = document.querySelector(".nav__btn");
    let menu = document.querySelector(".mnu");
    let menu2 = document.querySelector(".mnu2");
 

    navbutton.addEventListener("click", ()=>{
          menu2.classList.toggle("active2");
      });  

    usrlogin = document.getElementById("usr-login");
      usrReg = document.getElementById("usr-reg");
      usrlogin.addEventListener("click",()=>{
        document.querySelector(".login_form").style.display = "block";
        ScrollReveal().reveal(".login_form", {
              distance: "80px",
          origin: "top",
          duration: 800
        });
        document.querySelector(".origin").style.filter = "blur(2px)";
        document.querySelector("body").style.overflow = "hidden";
        
        menu2.classList.toggle("active");



      });

      const buttons = document.querySelectorAll("#login-submit,#login-reset");

    buttons.forEach(b=>{
      b.addEventListener("click",()=>{
        document.querySelector(".login_form").style.display = "none";
        
        document.querySelector(".origin").style.filter = "none";
        document.querySelector("body").style.overflow = "scroll";      });
    });
      
     function show_filters() {
      let menu3 = document.querySelector(".menu3");
      menu3.classList.toggle("active");

    }

    function book_room(room_id,flag){
        
      if(!flag){
        
        alert("You must log in first");
        
      }
      else{
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "rooms.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
         xhr.onreadystatechange = function() {
           if (xhr.readyState === 4 && xhr.status === 200) {
            window.location.href = "rooms.php";
             
           }
         };

        //username=JohnDoe&email=john@example.com
         let data = "room_clicked_id="+room_id;
          xhr.send(data);
        }
    }

    let login_uname,login_pass;
      function validate_login(){
        login_uname = document.getElementById("username").value;
        login_pass = document.getElementById("password").value;
    
    
        valid_login_php();
      }
      function valid_login_php(){
      
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "process.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Display response from the server
          let res  = xhr.responseText;
          
          if(res == "Okay"){
            alert("Login Successfull");

            window.location.href = "rooms.php";

          }
          else{

            alert("Wrong user credentials");
          }
        }
      };

      //username=JohnDoe&email=john@example.com
       let data = "login_uname="+login_uname+"&login_pass="+login_pass;
        xhr.send(data);
    }
    
      
  </script>
</body>

</html>
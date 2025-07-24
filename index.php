<?php
  session_start();
  $flag = false;
  if(isset($_SESSION['username'])){
    $button_name = $_SESSION['username'];
    $flag = true;
    
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css"
      rel="stylesheet"

    />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" />

    <title>Web Design Mastery | Rayal Park</title>
    <script src="https://unpkg.com/scrollreveal"></script>

  <style>
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

    .active{
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



  </style>

  </head>
  <body>
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
                  <input type="password" id = "pass" name="password" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password"id ="c_pass" class="form-control shadow-none" >
                </div>
                <div class="col-md-12 p-0 mb-3 text-center">
                  <span id='p_span' style="color: red"> </span>
                </div>
              </div>   
              <div class="text-center my-1">
                <button type="button" onclick="validate_reg()"  name = "register" class =" btn btn-dark shadow-none">REGISTER</button>
              </div>
            </div>
          </div> 
        </form>
      </div>
      </div>
    </div> 

    
   
   
   
      <div class = "origin">
    <header class="header">

      <nav class="landing_nav">
        <div class="nav__bar">
          <div class="logo">
            <a href="#"><img src="assets/laxariya.png" alt="logo" /></a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links " id="nav-links" style="margin-top: 10px;">
          <li><a href="#home">Home</a></li>
          <li><a href="rooms.php">Rooms</a></li>
          <li><a href="#service">Services</a></li>
          <li><a href="#explore">Explore</a></li>
          <li><a href="About.php" >About</a></li>
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
      
        
      
      <div class="section__container header__container" id="home">
        <p>Simple - Unique - Friendly</p>
        <h1>Make Yourself At Home<br />In Our <span>Hotel</span>.</h1>

      </div>
      
     
    </header>
   

    <section class="section__container booking__container">
      <form action="/" class="booking__form">
        <div class="input__group">
          <span><i class="ri-calendar-2-fill"></i></span>
          <div>
            <label for="check-in">CHECK-IN</label>
            <input type="text" placeholder="Check In" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="ri-calendar-2-fill"></i></span>
          <div>
            <label for="check-out">CHECK-OUT</label>
            <input type="text" placeholder="Check Out" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="ri-user-fill"></i></span>
          <div>
            <label for="guest">GUEST</label>
            <input type="text" placeholder="Guest" />
          </div>
        </div>
        <div class="input__group input__btn">
          <button class="bttn">CHECH OUT</button>
        </div>
      </form>
    </section>



    <section class="section__container room__container">
      <p class="section__subheader">OUR LIVING ROOM</p>
      <h2 class="section__header">The Most Memorable Rest Time Starts Here.</h2>
      <div class="room__grid">
        <div class="room__card">
          <div class="room__card__image">
            <img src="assets/room-1.jpg" alt="room" />
            <div class="room__card__icons">
              <span><i >DELUX</i></span>
              <span><i >NON-AC</i></span>
            </div>
          </div>
          <div class="room__card__details">
            <h4>Deluxe Ocean View</h4>
            <p>
              Bask in luxury with breathtaking ocean views from your private
              suite.
            </p>
            <h5>Starting from <span>$299/night</span></h5>
            <button class="bttn">Book Now</button>
          </div>
        </div>
        <div class="room__card">
          <div class="room__card__image">
            <img src="assets/room-2.jpg" alt="room" />
            <div class="room__card__icons">
              <span><i >EXECUTIVE</i></span>
              <span><i >AC</i></span>
            </div>
          </div>
          <div class="room__card__details">
            <h4>Executive Cityscape Room</h4>
            <p>
              Experience urban elegance and modern comfort in the heart of the
              city.
            </p>
            <h5>Starting from <span>$199/night</span></h5>
            <button class="bttn">Book Now</button>
          </div>
        </div>
        <div class="room__card">
          <div class="room__card__image">
            <img src="assets/room-3.jpg" alt="room" />
            <div class="room__card__icons">
              <span><i >DELUXE</i></span>
              <span><i >AC</i></span>
            </div>
          </div>
          <div class="room__card__details">
            <h4>Family Garden Retreat</h4>
            <p>
              Spacious and inviting, perfect for creating cherished memories
              with loved ones.
            </p>
            <h5>Starting from <span>$249/night</span></h5>
            <button class="bttn">Book Now</button>
            
          </div>
        </div>
      </div>
    </section>

    <section class="service" id="service">
      <div class="section__container service__container">
        <div class="service__content">
          <p class="section__subheader">SERVICES</p>
          <h2 class="section__header">Strive Only For The Best.</h2>
          <ul class="service__list">
            <li>
              <span><i class="ri-shield-star-line"></i></span>
              High Class Security
            </li>
            <li>
              <span><i class="ri-24-hours-line"></i></span>
              24 Hours Room Service
            </li>
            <li>
              <span><i class="ri-headphone-line"></i></span>
              Conference Room
            </li>
            <li>
              <span><i class="ri-map-2-line"></i></span>
              Tourist Guide Support
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="section__container banner__container">
      <div class="banner__content">
        <div class="banner__card">
          <h4>25+</h4>
          <p>Properties Available</p>
        </div>
        <div class="banner__card">
          <h4>350+</h4>
          <p>Bookings Completed</p>
        </div>
        <div class="banner__card">
          <h4>600+</h4>
          <p>Happy Customers</p>
        </div>
      </div>
    </section>

    <section class="explore" id="explore">
      <p class="section__subheader">EXPLORE</p>
      <h2 class="section__header">What's New Today.</h2>
      <div class="explore__bg">
        <div class="explore__content">
          <p class="section__description">8th APR 2025</p>
          <h4>A New Menu Is Available In Our Hotel.</h4>
          <button class="bttn">Continue</button>
        </div>
      </div>
    </section>

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
   </div>

    
  

    <script src="main.js"></script>
    <script>
    let navbutton = document.querySelector(".nav__btn");
    let menu = document.querySelector(".mnu");
    let menu2 = document.querySelector(".mnu2");
 

    navbutton.addEventListener("click", ()=>{
          menu2.classList.toggle("active");
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

    
   
    function showalert(){

      // let newAlert = document.createElement("div");
      // newAlert.className = "alert alert-warning alert-dismissible fade show";
      // newAlert.role = "alert";
      // newAlert.innerHTML = `
      //     <strong>Holy guacamole!</strong> You should check in on some of those fields below.
      //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      // `;

      // document.body.appendChild(newAlert);

      // new bootstrap.Alert(newAlert);

    }
    let login_uname,login_pass,reg_email,reg_uname;
      function validate_login(){
        login_uname = document.getElementById("username").value;
        login_pass = document.getElementById("password").value;
      
    
        valid_login_php();
      }

     function validate_reg(){
       reg_uname = document.getElementById("user-id").value;
       reg_email = document.getElementById("email").value;
       pass = document.getElementById("pass").value;
       c_pass = document.getElementById("c_pass").value;

       if(pass!=c_pass){
        document.getElementById("p_span").innerHTML = "Passwords do not match";       
        return;
      }
       valid_reg_php();
      

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

              window.location.href = "index.php";

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

      function valid_reg_php(){
      
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "process.php", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
              // Display response from the server
              let res  = xhr.responseText;
              
              if(res == "Okay"){
                alert("Registration Successful");
                document.getElementById("myForm").submit();
                
                
              }
              else{

                alert("This email or username has already been used");
              
              }
            }
          };

          //username=JohnDoe&email=john@example.com
          let data = "reg_uname="+reg_uname+"&reg_email="+reg_email;
            xhr.send(data);
    }

      
   
 
     


      
    </script>
    
  </body>
</html>

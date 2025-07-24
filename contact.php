
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


    .section__description2 {
      width: 200%;
      margin-bottom: 1rem;
      color: var(--text-light);
    }

    .section__subheader2 {
      margin-bottom: 0.5rem;
      position: relative;
      font-weight: 500;
      letter-spacing: 2px;
      color: var(--text-dark);
    }

    .section__subheader2::after {
      position: absolute;
      content: "";
      top: 50%;
      transform: translate(1rem, -50%);
      height: 2px;
      width: 4rem;
      background-color: var(--primary-color);
    }

    .section__header2 {
      max-width: 600px;
      margin-bottom: 1rem;
      font-size: 1.4rem;
      font-weight: 600;
      line-height: 3rem;
      color: var(--text-dark);
    }

    .body{
      position: relative;
    }
    .main-area{
        width:90%;
        height: 400px;
        margin: 40px auto;
        box-sizing: border-box;
        display: grid;
        grid-template-columns: 60% 30%;
        column-gap: 50px;
        grid-auto-flow: column;
        position: relative;
        padding: 30px;
    }
    .follow{
        height: 135px;
        background-color: white;
        position: absolute;
        top:200px;
        right: 90px;
        padding: 15px;
        box-sizing: border-box;
        box-shadow: 4px 4px 8px 4px rgba(0,0,0,0.1);
        width: 30%;

    }
    .call{
        height:150px;
        box-sizing: border-box;
        padding: 15px;
        box-shadow: 4px 4px 8px 4px rgba(0,0,0,0.1);

        background-color: white;


        
    }
  
    iframe{
            height: 300px;
            width:100%;
            box-shadow: 4px 4px 8px 4px rgba(0,0,0,0.1);

        }
        .reach{
            margin-top: 50px;
            text-align: center;
            font-size: 2.6rem;
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
          <a href="#"><img src="assets/laxariya.png" alt="logo" /></a>
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
  <h1 class="reach">Reach us</h1>

  <section class ="main-area">
    
    <div class="map">
        
        <iframe   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4346.971551178232!2d90.31837114359737!3d23.87821573854881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8ada2664e21%3A0x3c872fd17bc11ddb!2sDaffodil%20International%20University!5e0!3m2!1sen!2sbd!4v1698689423773!5m2!1sen!2sbd"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      
    </div>
    <div class ="call">
        <h2 class="section__header2">Call us</h2>
        <span><i class="ri-phone-fill"></i>+88018631118395</span><br>
        <span><i class="ri-phone-fill"> </i>+88018631118395</span>

    </div>
    <div class="follow">
        <h2 class="section__header2">Follow Us</h2>
         <div class="footer__socials">
          <a href="#"><img src="assets/facebook.png" alt="facebook" /></a>
          <a href="#"><img src="assets/instagram.png" alt="instagram" /></a>
          <a href="#"><img src="assets/youtube.png" alt="youtube" /></a>
          <a href="#"><img src="assets/twitter.png" alt="twitter" /></a>
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
  <script>
    
    let navbutton = document.querySelector(".nav__btn");
    let menu = document.querySelector(".mnu");
    let menu2 = document.querySelector(".mnu2");
 

    navbutton.addEventListener("click", ()=>{
          menu2.classList.toggle("active");
      });  


    const scrollRevealOption = {
      distance: "50px",
      origin: "bottom",
      duration: 1000
    }

    // about container
    ScrollReveal().reveal(".about__image img", {
      ...scrollRevealOption,
      origin: "left",
    });

    ScrollReveal().reveal(".about__content .section__subheader", {
      ...scrollRevealOption,
      delay: 500,
    });

    ScrollReveal().reveal(".about__content .section__header", {
      ...scrollRevealOption,
      delay: 1000,
    });

    ScrollReveal().reveal(".about__content .section__description", {
      ...scrollRevealOption,
      delay: 1500,
    });

    ScrollReveal().reveal(".about__btn", {
      ...scrollRevealOption,
      delay: 2000,
    });


    function f(){
      x = document.querySelector(".history");
      x.style.display = "block";

      document.querySelector(".about__btn").style.display = "none";

      ScrollReveal().reveal(".about__content2 .section__subheader2", {
        ...scrollRevealOption,
      });
      
      ScrollReveal().reveal(".about__content2 .section__header2", {
        ...scrollRevealOption,
      });
      
      ScrollReveal().reveal(".about__content2 .section__description2", {
        ...scrollRevealOption,
      });
    }


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





  </script>
</body>

</html>
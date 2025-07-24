<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="login_form">
        <form class ='f' >
          <div class="login_form_head">
            
              <p>Admin Login</p>
           
          </div>
          <div class="login_ad  mb-3">
            <label for="username" class="form-label">Admin ID</label>
            <input type="text" name= 'username' class="form-control" id="username"  require>
          </div>
          <div class="login_ad mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name ='password' class="form-control" id="password" require>
          </div>
          <button type="button" onclick ='validate_login()' id = "login-submit"name="admin_login" class=" btn btn-dark shadow-none">Login</button>
        </form>
      
      </div>


     <script>
          function validate_login(){
            login_uname = document.getElementById("username").value;
            login_pass = document.getElementById("password").value;
        
        
            valid_login_php();
        }
        function valid_login_php(){
      
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "process.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xhr.onload = function() {
              
                // Display response from the server
                let res  = xhr.responseText;
                
                if(res == "Okay"){
                  alert("Login Successfull");

                  window.location.href = "admin.php";

                }
                else{

                  alert("Wrong user credentials");
                  window.location.href = "admin_login.php";

                
              }
            };

            //username=JohnDoe&email=john@example.com
            let data = "admin_login_uname="+login_uname+"&admin_login_pass="+login_pass;
              xhr.send(data);
    }


     </script>
</body>
</html>
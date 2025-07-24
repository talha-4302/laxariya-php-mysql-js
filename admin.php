<?php

include "connection.php";

session_start();

if(isset($_SESSION['admin_username'])){
}
else{
  header("Location: admin_login.php");
}


$query = "SELECT * FROM 
  booking_info inner JOIN room_info on booking_info.room_id = room_info.room_id ";
$data1 = mysqli_query($conn,$query);

$query = "select * from user_info";
$data2 = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
    ">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
    "></script>
    <link rel="stylesheet" href="admin_style.css">
</head>
<style>
  .item1 h3{
    margin-left: 15px;
    padding-top: 10px;
  }
</style>
<body>

    <div class="header">
        <h1><i>Laxariya</i></h1>
        <a href="admin_logout.php" class="btn  btn-light ">LOG OUT</a>
    </div>
    <div class="nav_vertical">
        <h1>ADMIN PANEL</h1>
        <div class="d-flex align-items-start ">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              
              <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><a href="admin.php">Bookings</a></button>
              <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"  type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><a href="admin.php#users">Users</a></button>
              <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"  type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><a href="admin_rooms.php">Rooms</a></button>
              <button style="color:white;" class="nav-link disabled" id="v-pills-settings-tab" data-bs-toggle="pill"  type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
            </div>
            
        </div>
    </div>
    <div class="card item1">
        <h3 >Booked Rooms</h3>
      
        <div class="card-body  overflow-auto">
            <table class="table table-hover  ">
            <thead class="table-dark">
                  <th>Room Id</th>
                  <th>Room Name</th>
                  <th>Room Price</th>
                  <th>Booked By</th>
                  <th>Action</th>

                </thead>
                <tbody >
                    
                <?php
                  while($row = mysqli_fetch_assoc($data1)){
                    echo"

                            <tr>
                                <td>".$row['room_id']."</td>
                                <td>".$row['room_name']."</td>
                                <td>".$row['room_price']."</td>
                                <td>".$row['username']."</td>
                                
                                <td> 
                                <button type='button' onclick='cancel_booking(".$row['room_id'].")' class='btn btn-danger btn-sm shadow-none'>
                                Cancel Booking
                                </button>
                                </td>
                            </tr>

                    ";
                  }
                ?>
                    
                </tbody>
              </table>
        </div>
      </div>
      <div class="card item2" id ="users">
        <h3 >Users</h3>


        <div class="card-body  overflow-auto">
            <table class="table table-hover  ">
                <thead class="table-dark">

                
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Age</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Phone</th>
                  <th>NID NO</th>
                  <th>Address</th>
                  

                </thead>
                <tbody >

                <?php
                  $i=1;
                    while($row = mysqli_fetch_assoc($data2)){
                      echo"

                              <tr>
                                  <td>".$i."</td>
                                  <td>".$row['name']."</td>
                                  <td>".$row['email']."</td>
                                  <td>".$row['age']."</td>
                                  <td>".$row['username']."</td>
                                  <td>".$row['password']."</td>
                                  <td>".$row['phone']."</td>
                                  <td>".$row['nid']."</td>
                                  <td>".$row['address']."</td>
                                  
                            
                              </tr>

                      ";
                      $i = $i + 1;
                    }
                  ?>

                    
                   
                    
                </tbody>
              </table>
        </div>
      </div>
      
      <script>
          function cancel_booking(room_id){


          let xhr = new XMLHttpRequest();
            xhr.open("POST","process.php",true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

            xhr.onload = function(){
                
              window.location.href = "admin.php";

              }
              xhr.send('get_cancel_booking= '+room_id);
         }
      </script>
      
</body>
</html>
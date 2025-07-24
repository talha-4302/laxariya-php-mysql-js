<?php
include("connection.php");
session_start();

if(isset($_SESSION['admin_username'])){
}
else{
  header("Location: admin_login.php");
}

$query = "select * from room_info";
$data = mysqli_query($conn,$query);
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
    <style>
       
        .btns{
            display: inline-flex;
        }
        .item1{
          height:600px;
        }
      
    </style>
</head>
<body>

    <div class="header">
        <h1><i>Laxariya</i></h1>
        <a href="admin_logout.php" class="btn  btn-light ">LOG OUT</a>
    </div>
    <div class="nav_vertical">
        <h1>ADMIN PANEL</h1>
        <div class="d-flex align-items-start ">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              
                <button class="nav-link " id="v-pills-home-tab" data-bs-toggle="pill" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><a href="admin.php">Bookings</a></button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"  type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><a href="admin.php#users">Users</a></button>
                <button class="nav-link active" id="v-pills-messages-tab" data-bs-toggle="pill"  type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><a href="admin_rooms.php">Rooms</a></button>
                <button style="color:white;" class="nav-link disabled" id="v-pills-settings-tab" data-bs-toggle="pill"  type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
              </div>
            
        </div>
    </div>
    <div class="card item1">
        <div class="booked-head">
            <h3 >Booked Rooms</h3>
            <button type="button" class =" btn btn-dark btn-md" data-bs-toggle="modal" data-bs-target ="#add-room">
                 Add

               </button>
               
        </div>
        
        
     <?php
          if(mysqli_num_rows($data)>0){
              echo"
              
                  <div class='card-body overflow-auto'>
                <table class='table table-hover'>
                <thead class='table-dark'>
                  <th> Room ID</th>
                  <th> Name</th>
                  <th> Description</th>
                  <th> Price</th>
                  <th> Catagory</th>
                  <th> Conditon</th>
                  <th> Image Link</th>
                  <th> Status</th>
                  <th>Action</th>
                </thead>
                <tbody >
              
              ";
              while($row = mysqli_fetch_assoc($data)){
                echo"
                <tr>
                <td>".$row['room_id']."</td>
                <td>".$row['room_name']."</td>
                <td>".$row['room_desc']."</td>
                <td>".$row['room_price']."</td>
                <td>".$row['room_catagory']."</td>
                <td>".$row['room_condition']."</td>
                <td>".$row['room_image']."</td>
                <td>".$row['room_status']."</td>
                
                <td class='btns'>
                    &nbsp;
                    <button type='button' onclick='edit_room(".$row['room_id'].")' class ='btn btn-primary  btn-sm' data-bs-toggle='modal' data-bs-target ='#edit-room'>
                        Edit
                  </button>
                  <button type='button' onclick='del_room(".$row['room_id'].")' class='btn btn-danger btn-sm shadow-none'>
                     Delete
                  </button>
                </td>

            </tr>

                ";
              }
              echo "
                        </tbody>
                    </table>
              </div>
            </div>
              
              ";
          }

     ?>
        
      
                    
                    
                    
              


      <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="process.php" id ="myForm" method ="post">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                Add New Room
              </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Room ID</label>
                    <input type="number" name="room_id" class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Room Name</label>
                      <input type="text" name="room_name" id = "room_name" class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="room_price" class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Catagory</label>
                    <input type="text" name="room_catagory"  class="form-control shadow-none" >
                  </div>
  
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control shadow-none" name="room_desc" rows="1"></textarea>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Condition</label>
                    <input type="text" name="room_condition" class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Image Link</label>
                    <input type="text" name="room_image" class="form-control shadow-none" >
                  </div>
                
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Booking Status</label>
                    <input type="text" name="room_status" value="Unbooked" class="form-control shadow-none" >
                  </div>
                  
                </div>   
                <div class="text-center my-1">
                  <button type="submit" name = "add_room" class =" btn btn-dark shadow-none">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
        </div>
      </div> 

      <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="process.php" id ="myForm-edit" method ="post">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                Edit Room
              </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Room Name</label>
                      <input type="text" name="room_name" id = "room_name" class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="room_price" class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Catagory</label>
                    <input type="text" name="room_catagory"  class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Condition</label>
                    <input type="text" name="room_condition" class="form-control shadow-none" >
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control shadow-none" name="room_desc" rows="1"></textarea>
                  </div>
                 
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Image Link</label>
                    <input type="text" name="room_image" class="form-control shadow-none" >
                  </div>
                
                  
                  <input type="hidden" name ="hidden_id" />
                  
                </div>   
                <div class="text-center my-1">
                  <button type="submit"  name = "submit_edit_room" class =" btn btn-dark shadow-none">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
        </div>
      </div> 
      
      <script>

            function edit_room(room_id){

              let form = document.getElementById("myForm-edit")

              let xhr = new XMLHttpRequest();
                xhr.open("POST","process.php",true);
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

                xhr.onload = function(){
                  
                    let data = JSON.parse(this.responseText);
                    console.log(data);

                    

                   form.elements['hidden_id'].value = data.room_id;
                   form.elements['room_name'].value = data.room_name;
                   form.elements['room_desc'].value = data.room_desc;
                   form.elements['room_price'].value = data.room_price;
                   form.elements['room_catagory'].value = data.room_catagory;
                   form.elements['room_condition'].value = data.room_condition;
                   form.elements['room_image'].value = data.room_image;
                    

                    

                  }
                  xhr.send('get_edit_room= '+room_id);
            }
            function del_room(room_id){


                  let xhr = new XMLHttpRequest();
                  xhr.open("POST","process.php",true);
                  xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

                  xhr.onreadystatechange = function() {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display response from the server
                    console.log(xhr.responseText);
                    window.location.href = "admin_rooms.php";
                  }
        };

                  xhr.send('get_del_room= '+room_id);
                }
                            

      </script>
      
      
</body>
</html>
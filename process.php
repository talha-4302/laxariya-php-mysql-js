<?php
    include "connection.php";

    if( isset($_POST["login_uname"]) ){
        
        $uname = $_POST['login_uname'];
        $query = "select * from user_info where username = '$uname' ";
        $data = mysqli_query($conn,$query);
        $row;
        $flag = false;

        if(   mysqli_num_rows($data) == 0      ) $flag = true;
        else{
            $row = mysqli_fetch_assoc($data);
            $pass = $row['password'];

            if($_POST['login_pass'] != $pass)$flag = true;
        }

        if($flag == true) echo "Wrong";
        else {
            session_start();
            $_SESSION['username'] = $_POST['login_uname'];
            $_SESSION['password'] = $_POST['login_pass'];
            $_SESSION['fullname'] = $row['name'];

            echo "Okay";}


    }
    else if( isset($_POST["reg_uname"]) ){
        
        $uname = $_POST['reg_uname'];
        $email = $_POST['reg_email'];
        $query = "select * from user_info where username = '$uname' ";
        $data1 = mysqli_query($conn,$query);

        $query = "select * from user_info where email = '$email' ";
        $data2 = mysqli_query($conn,$query);

        $flag = false;

        if(   mysqli_num_rows($data1) > 0  ||  mysqli_num_rows($data2) > 0     ) $flag = true;
        else{
            $query = "select * from user_info where username = '$uname' ";
        $data1 = mysqli_query($conn,$query);
        }

        if($flag == true) echo "Wrong";
        else echo "Okay";
    }
    else if(isset($_POST['edit-profile'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $user = $_POST['user_id'];
        $address = $_POST['address'];
        $nid = $_POST['nid_no'];
        $age = $_POST['age'];
        $pass = $_POST['password'];
        $id = $_POST['id'];

        $query = "update user_info 
        set name = '$name',email = '$email',phone = '$phone',username = '$user',address = '$address',nid = '$nid',age = '$age',password = '$pass'
        where id = $id";

        $run = mysqli_query($conn,$query);
        header("location: user.php");


    }
    else if(isset($_POST['get_edit_room']))
    {
     $room_id = $_POST['get_edit_room'];
    
      $query = "select * from room_info WHERE room_id = $room_id ";
      $query_run = mysqli_query($conn,$query);
    
      $room_data = mysqli_fetch_assoc($query_run);
          
      $data = json_encode($room_data);
    
      echo $data;
      
    
    }

    else if(isset($_POST['add_room'])){
        
        $room_id = $_POST['room_id'];
        $room_name = $_POST['room_name'];
        $room_desc = $_POST['room_desc'];
        $room_price = $_POST['room_price'];
        $room_catagory= $_POST['room_catagory'];
        $room_condition= $_POST['room_condition'];
        $room_image= $_POST['room_image'];
        $room_status= $_POST['room_status'];
        
        


        $query = "INSERT INTO `room_info` (`room_id`, `room_name`, `room_desc`, `room_price`, `room_catagory`, `room_condition`, `room_image`, `room_status`)
        VALUES ($room_id, '$room_name', '$room_desc', $room_price, '$room_catagory', '$room_condition','$room_image','$room_status')";
        $run = mysqli_query($conn,$query);
        header("location: admin_rooms.php");

    }
    else if(isset($_POST['submit_edit_room'])){
        $org_room_id = $_POST['hidden_id'];
        $room_name = $_POST['room_name'];
        $room_desc = $_POST['room_desc'];
        $room_price = $_POST['room_price'];
        $room_catagory= $_POST['room_catagory'];
        $room_condition= $_POST['room_condition'];
        $room_image= $_POST['room_image'];
        $room_status= $_POST['room_status'];
        
        $query = "update room_info 
        set room_name = '$room_name',room_desc = '$room_desc',room_price = $room_price,
        room_catagory = '$room_catagory',room_condition = '$room_condition',room_image = '$room_image',room_status = '$room_status'
        where room_id = $org_room_id ";

        $run = mysqli_query($conn,$query);
        header("location: admin_rooms.php");
    }
    else if(isset($_POST['get_del_room']))
    {
      $room_id = $_POST['get_del_room'];
    
      $query = "delete from room_info WHERE room_id = $room_id ";
      $query_run = mysqli_query($conn,$query);
    
      echo "Okay";
    
    }
    else if(isset($_POST['get_cancel_booking']))
    {
      $room_id = $_POST['get_cancel_booking'];
    
      $query = "delete from booking_info WHERE room_id = $room_id ";
      $query_run = mysqli_query($conn,$query);

      $query = "update  room_info set room_status = 'Unbooked' WHERE room_id = $room_id ";
      $query_run = mysqli_query($conn,$query);

      echo " OKAAY";
    
    
    }
    else if( isset($_POST["admin_login_uname"]) ){
        
        $uname = $_POST['admin_login_uname'];
        $query = "select * from admin_info where username = '$uname' ";
        $data = mysqli_query($conn,$query);

        $flag = false;

        if(   mysqli_num_rows($data) == 0      ) $flag = true;
        else{
            $row = mysqli_fetch_assoc($data);
            $pass = $row['password'];

            if($_POST['admin_login_pass'] != $pass)$flag = true;
        }

        if($flag == true) echo "Wrong";
        else {
            session_start();
            $_SESSION['admin_username'] = $_POST['admin_login_uname'];
            $_SESSION['admin_password'] = $_POST['admin_login_pass'];

            echo "Okay";}


    }
    
    else{
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $user = $_POST['user_id'];
            $address = $_POST['address'];
            $nid = $_POST['nid_no'];
            $age = $_POST['age'];
            $pass = $_POST['password'];
            

            $query = "INSERT INTO `user_info` (`id`, `name`, `email`, `phone`, `username`, `address`, `nid`, `age`, `password`)
                VALUES (NULL, '$name', '$email', '$phone', '$user', '$address', '$nid','$age','$pass')";
                $run = mysqli_query($conn,$query);
                header("location: index.php");
    }

?>
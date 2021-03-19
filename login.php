<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

      $sql = "SELECT * FROM student_details WHERE regno = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];

      $count = mysqli_num_rows($result);
      if($count == 1) {

         $change_res= mysqli_query($conn, "SELECT * FROM submitted_applications WHERE reg_no = '$myusername' ");
         if (mysqli_num_rows($change_res) > 0) {
           header("location: profile.php?submitted=true");
         }
         else{
           header("location: profile.php");
         }

         $_SESSION['login_user'] = $myusername;
         $_SESSION['data'] = $row;

      }else {
         $error = "Your Login Name or Password is invalid";
         echo "<script>alert(".$error.")</script>";
      }
   }
?>
<html>

   <head>
      <title>Login Page</title>
         <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
         <meta charset="utf-8">
         <meta name="viewport" content="width-device-width, initial-scale=1">
         <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="bootstrap/js/bootstrap.min.js"></script>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">
      <div class="box1" align = "center" style="padding:2rem;">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
               <form class="form-control" action = "" method = "post">
                  <label  font-family: Lucida Console;>UserName  :</label><input class="form-control" type = "text" name = "username" class = "box" required="required" /><br /><br />
                  <label>Password  :</label><input class="form-control" type = "password" name = "password" class = "box"  required="required"/><br/><br />
                  <input type = "submit" value = "LOGIN "/><br />
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php //echo $error; ?></div>

            </div>

         </div>

      </div>

   </body>
</html>

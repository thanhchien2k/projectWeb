<?php
  session_start();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
 integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 <link rel="stylesheet" href="styleloggedin.css">

 <title>TheFutureDev - Thế giới tri thức trong tay bạn</title>
 </head>
  <body>
    <div class="topnav" id="myTopnav">
    <a href="loggedin.php" class="active">Trang chủ</a>
        <?php
        if (isset($_SESSION['userId'])){
          echo '<a href="loggedin/profile.php" name="profile">Hồ sơ</a>
                <a href="includes/logout.inc.php" name="logout-submit">Đăng xuất</a>';
        }else{
          echo '<a href="#aboutus">VỀ CHÚNG TÔI</a>
          <a href="#contact">LIÊN HỆ VỚI CHÚNG TÔI</a>
          <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
          </a>
          <a href="signup.php">ĐĂNG KÝ</a>';
          echo '<a href="signin.php">ĐĂNG NHẬP</a>';
        }
         ?>

       </div>

  </header>

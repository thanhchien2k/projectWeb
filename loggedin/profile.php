<?php
  session_start();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="../style.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
 integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 <link rel="stylesheet" href="styleprofile.css">


 <title>TheFutureDev</title>
 </head>
  <body>
    <div class="topnav" id="myTopnav">
    <a href="../loggedin.php" class="active">Trang chủ</a>
        <?php
        if (isset($_SESSION['userId'])){
          echo '<a href="../loggedin/profile.php" name="profile">Hồ sơ</a>
                <a href="../includes/logout.inc.php" name="logout-submit">Đăng xuất</a>';
        }
         ?>
       </div>
  </header>
  <?php
  try{
    $db=new PDO('mysql:host=localhost;dbname=loginsystem;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $err){
    die('Connection Failed :'.$err->getMessage());
  }

  $req=$db->prepare('SELECT * FROM users WHERE emailUsers=:e');
  $req->execute(array('e'=>$_SESSION['userEmail']));
  if($enreg=$req->fetch()){/*If we find the person with the login email*/
    $id=$enreg['idUsers'];
    $req2=$db->query("SELECT * FROM imgupload WHERE userid='$id'");
    while($rowImg=$req2->fetch()){
      echo '<div class="wrapper">
      <div class="profile-card js-profile-card">
          <div class="profile-card__img">';
      if ($rowImg['status']==0){
        echo "<img src='../uploads/profile".$id.".jpg' alt='profile pic'>";
      }else{
        echo "<img src='../uploads/profiledefault.jpg' alt='default profile pic'>";
      }
      echo '</div>';
    }
  }
   ?>
   <div class="profile-card__cnt js-profile-cnt">
        <div class="profile-card__name"><?php echo isset($_SESSION['userUid']) ? $_SESSION['userUid']: '';?></div>
        <div class="profile-card__txt"><strong>ID: </strong><?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : '';?></div>
        <div class="profile-card__txt"><strong>Email: </strong><?php echo isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : '';?></div>

    <form  action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file" class="btn" style="border-radius: 20px;
          border: 1px solid #7971ea;
          background-color: #7971ea;
          color: #FFFFFF;
          font-size: 12px;
          font-weight: bold;
          padding: 12px 45px;
          letter-spacing: 1px;
          text-transform: uppercase;
          transition: transform 80ms ease-in;">
      <button type="submit" name="submit" class="btn" style="border-radius: 20px;
          border: 1px solid #7971ea;
          background-color: #7971ea;
          color: #FFFFFF;
          font-size: 12px;
          font-weight: bold;
          padding: 12px 45px;
          letter-spacing: 1px;
          text-transform: uppercase;
          transition: transform 80ms ease-in;">Cập nhật ảnh đại diện</button>
    </form>
    <?php
    if (isset($_GET['upload'])){
      echo '<div class="alert alert-success" role="alert">Ảnh đại diện đã được cập nhật</div>';
    }else if (isset($_GET['error'])){
      if ($_GET['error']=='bigfile'){
        echo '<div class="alert alert-danger" role="alert">Kích thước ảnh quá lớn !</div>';
      }elseif($_GET['error']=='uploaderror'){
        echo '<div class="alert alert-danger" role="alert">Lỗi khi upload ảnh, vui lòng thực hiện lại!</div>';
      }elseif ($_GET['error']=='unlistedtype'){
        echo '<div class="alert alert-danger" role="alert">Vui lòng chọn ảnh!</div>';
      }
    }
     ?>
  </center>

<?php require "../footer.php"; ?>

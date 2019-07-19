<?php
session_start();
$id = $_GET['variable1'];
$title = $_GET['variable2'];
 if(!isset($_SESSION['username']))
  {
    $_SESSION['msg'] = "You must login first";
    header('location: login.php');
  }
 if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }
 
$db  = mysqli_connect('localhost', 'root', '', 'registration');
$username = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>FORM</title>
  <style type="text/css">
    body{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: url(m.jpg) no-repeat;
        background-size: cover;
    }
    .Response{
          width: 425px;
          position: absolute;
          background: #1a1a1a;
          box-sizing: border-box;
          padding: 20px;
          border-radius: 20px;
          box-shadow: 0 15px 25px rgba(0,0,0,.5);
          top: 50%;
          left: 50%;
          transform: translate(-50%,-50%);
          color: white;
    }
    .Response .h1{
          text-align: center;
          font-size: 15px;
          border-top:4px solid #4caf50;
          border-bottom: 4px solid #4caf50;
    }
    .Response a{
      color: #1498cc;
      float: right;
    }
    .content{
      width: 100%;
      overflow: hidden;
      font-size: 20px;
      padding: 8px 0;
      border-bottom: 10px 0;
    }
    #tab {
      text-align: center;
    }
    #tab th{
      background-color: #4caf50;
      color: black;
    }
  </style>
</head>
<body>
  <div class="Response">
    <div class="h1">
     <h1>Form ID:<?php echo $id; ?></h1>
     <h1>Form Name:<?php echo $title; ?></h1>
    </div>
    <h2><a href="response.php">Go Back</a></h2>

  <div class="content">
    <?php if (isset($_SESSION['username'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p> <a href="index.php?logout='1'" style="color: red;">logout</a></p>
    <?php endif ?>
  <?php
    $query = "select value from user_inputs where form_id='$id' ";
      $query2 = "select distinct entry_id from user_inputs where form_id='$id' ";

      $numresult = mysqli_query($db,$query2) or die(mysqli_error($db));
      $result = mysqli_query($db,$query) or die(mysqli_error($db));
      $count = mysqli_num_rows($result);
      $countrow = mysqli_num_rows($numresult); ?>
      
      <table border="1" id="tab">
          <thead>
            <th>S.no</th>
            <th colspan="<?php echo $countrow; ?>">values</th>
          </thead>
          <tbody><?php
          $j=1;
              $query_user = "select * from users where form_id='$id'";
              $result_user = mysqli_query($db,$query_user);
              while($row_user = mysqli_fetch_array($result_user))
              {
                $user_id = $row_user['id'];
                $i=1;
                $query_values = "select value from user_inputs where user_id='$user_id'";
                $result_values = mysqli_query($db,$query_values);
                while($row_fields = mysqli_fetch_array($result_values))
                {
                  
                   $cols[] =  $row_fields['value'];
                   $i++;
                } ?>
                <tr>
                  <td><?php echo $j; ?></td><?php
                  
                  for($k=0; $k<count($cols);$k++)
                  { ?>
                      <td><?php echo $cols[$k]; ?></td><?php
                  } 
                  unset($cols);
                  ?>
                </tr><?php 
                $j++;
              } ?>
              
          
          </tbody>
      </table>
    </div>
  </div>
</body>
</html>
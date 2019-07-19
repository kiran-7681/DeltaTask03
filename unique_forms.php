<?php 
$db = mysqli_connect('localhost','root','','registration');
$id = $_REQUEST['id'];
$query = "select * from fields where form_id='$id'";
$result = mysqli_query($db,$query) or die(mysqli_error($db));

$query_forms = "select id,title,description from forms  where id='$id'";
$result_forms = mysqli_query($db,$query_forms) or die(mysqli_error($db));
$row_form = mysqli_fetch_array($result_forms);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $row_form['title']; ?></title>
	<style type="text/css">
		body{
          margin: 0;
          padding: 0;
          font-family: sans-serif;
          background: url(m.jpg) no-repeat;
          background-size: cover;
        }  
        .page{
        width: 350px;
        position: absolute;
        top: 50%;
        left: 50%;
        background: #1a1a1a;
        box-sizing: border-box;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 15px 25px rgba(0,0,0,.5);
        transform: translate(-50%,-50%);
        color: white;
     }
       .page h1{
       	text-align: center;
        font-size: 40px;
        border-top: 4px solid #4caf50;
        border-bottom: 4px solid #4caf50;
        margin-top: 2px;
        margin-bottom: 3px;
        padding: 2px;
       }
       .page h2{
       	text-align: center;
       	font-size: 30px;
        padding: 0px;
        margin: 0;
        margin-bottom: 10px;
        border-bottom: 2px solid #4caf50;
       }
       .textbox{
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        border-bottom: 10px 0;
     }
       .textbox input{
       	border: 2px solid #4caf50;
        outline: none;
        background: none;
        color: white;
        font-size: 15px;
        width: 140px;
        margin: 0 8px;
       }
       .btn {
            width: 100%;
            background: none;
            border: 2px solid #4caf50;
            color: white;
            padding: 4px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
     }
	</style>
</head>
<body>
	<div class="page">
		<h1> Name:<?php echo $row_form['title']; ?></h1>
  		<h2>Description:<?php echo $row_form['description']; ?></h2>
	<div class="textbox">
		<?php if (isset($_SESSION['form_result'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['form_result']; 
          	unset($_SESSION['form_result']);
          ?>
      	</h3>
      </div>
      <?php endif ?>

    	<!-- logged in user information -->
    	<?php  if (isset($_SESSION['username'])) : ?>
    		<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    		<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    	<?php endif ?>
	</div>
	<form action="server.php?" id="fill_response" method="post">
		<input type="hidden" name="form_id" value="<?php echo $id; ?>"/>
		 <?php
		$i=1;
		while($row = mysqli_fetch_array($result))
		{ extract($row);?>
			<div class="textbox">
			<label for=""><?php echo $label;?></label>
			<input type="hidden" name="fields_id[]" value="<?php echo $fields_id;?>"/>
			<input type="<?php echo $type; ?>" name="value<?php echo $i++; ?>" value=""/> <br><?php
		} ?>
	</div>
		<button type="submit" class="btn" name="fill_response">Submit</button>
	</div>
	</form>
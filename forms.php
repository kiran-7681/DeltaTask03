<?php
session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

  $db = mysqli_connect('localhost', 'root', '', 'registration');
  $username = $_SESSION['username']; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Forms</title>
    <style type="text/css">
    	body{
          margin: 0;
          padding: 0;
          font-family: sans-serif;
          background: url(m.jpg) no-repeat;
          background-size: cover;
        }
        .Form{
          width: 425px;
          position: absolute;
          top: 70%;
          left: 50%;
          background: #1a1a1a;
          box-sizing: border-box;
          padding: 20px;
          border-radius: 20px;
          box-shadow: 0 15px 25px rgba(0,0,0,.5);
          transform: translate(-50%,-50%);
          color: white;
        }
        .Form h1{
        	text-align: center;
        	font-size: 50px;
        	border-top: 4px solid #4caf50;
            border-bottom: 4px solid #4caf50;
            margin-top: 2px;
            margin-bottom: 3px;
            padding: 2px;
        }
        .Form h2{
            float: right;
            margin-right: 2px;
            font-size: 35px;
            margin-left: 5px;
            padding: 0px;
            margin: 0;
        }
        .Form a{
            color: #1498cc;
        }
        .textbox{
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            border-bottom: 10px 0;
        }
        .textbox a{
        	float: right;
        	margin-right: 20px;
        	margin-bottom: 10px;
        }
        #forms th{
        	background-color: #4caf50;
        	color: black;
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
	<div class="Form">
		<h1>Active Forms</h1>
  		<h2><a href="index.php">Home Page</a></h2>
  		<h2><a href="response.php">View response</a></h2>
	<div class="textbox">
    	<!-- logged in user information -->
    	<?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    	<?php endif ?>
	 <?php
	$query ="select * from forms where status=1";
	$result = mysqli_query($db,$query) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result);?>
		<table border="2" id="forms">
			<thead>
				<th>S. No</th>
				<th>Form name</th>
				<th>Title</th>
				<!-- <th>User Email</th> -->
				<th>Share</th>
			</thead>
			<tbody><?php
				$i=1;
				while($row = mysqli_fetch_array($result))
				{ extract($row);  ?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $title; ?></td>		
						<td><?php echo $description; ?> </td>
						<td>
							<input type="text" id="<?php echo $id; ?>" value="http://localhost/sample_master/unique_forms.php?id=<?php echo $id;?>" readonly/>
							<button type="button" class ="btn" onclick="copy_url('<?php echo $id; ?>')">Copy the url</button>
						</td>
						<!-- <form action="save.php" method="POST">
							<input type="hidden" name="form_name" value="share_form">
							<input type="hidden" name="form_id" value="<?php echo $id; ?>">
							<td><input type="text" name="email<?php echo $i;?>" placeholder="Please enter user email"/></td>
							<td><input type ="submit"class="submit" id="<?php echo $id; ?>" value="Submit" /></td>
						</form> -->
					</tr><?php
				} ?>
			</tbody>
		</table>
		</div>
	</div>
</body>
<script type="text/javascript">
	function copy_url(id)
	{
		var copyText = document.getElementById(id);
		copyText.select();
		document.execCommand("copy");
	  	
	}
</script>
</html>

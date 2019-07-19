<?php
session_start();

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

 $db = mysqli_connect('localhost', 'root', '', 'registration');
 $username = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Response Page</title>
    <style type="text/css">
        body{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: url(m.jpg) no-repeat;
        background-size: cover;
      }
        .Response{
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
        .Response h1{
        text-align: center;
        font-size: 44px;
        border-top: 4px solid #4caf50;
        border-bottom: 4px solid #4caf50;
        margin-top: 2px;
        margin-bottom: 3px;
        padding: 2px;
      }
        .Response h2{
            float: right;
            margin-right: 2px;
            font-size: 32px;
            margin-left: 5px;
            padding: 0px;
            margin: 0;
        }
        .Response a{
            color: #1498cc;
        } 
        .content{
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            border-bottom: 10px 0;
        } 
        .content a{
            float: right;
            margin-right: 10px;
            margin-bottom: 5px;
            padding-bottom: 5px;
        } 
        
        #buto{
            text-align: center;
        }
        #buto th{
            background-color: #4caf50;
            color: black;
        }  
    </style>
</head>
<body>
	
	<div class="Response">
		<h1>View Response</h1>
        <h2><a href="index.php">Home Page</a></h2>
		<h2><a href="forms.php">View Forms</a></h2>

	<div class="content">
		<?php if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a></p>
		<?php endif ?>
      <?php
        $query = "select * from forms where status=1";
        $result = mysqli_query($db,$query) or die(mysqli_error($conn));
        $count = mysqli_num_rows($result);?>
        <table border="1" id="buto">
        	<thead>
        		<th>Form ID</th>
        		<th>Forms</th>
        	</thead>
        	<tbody><?php
        	    $i=1;
        	    while ($row = mysqli_fetch_array($result))
        	    { extract($row); ?>
        	    	<tr>
        	    		<td><?php echo $id; ?> </td>
        	    		<td><a href="view.php?variable1=<?php echo $id; ?>&variable2=<?php echo $title; ?>"><?php echo $title; ?></a></td>
        	    	</tr><?php	
        	    }?>
        		
        	</tbody>
        </table>
	</div>
</div>
</body>
</html>    
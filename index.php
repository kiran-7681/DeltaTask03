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
  $username = $_SESSION['username'];
            
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
  <style type="text/css">
    body{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: url(m.jpg) no-repeat;
        background-size: cover;
    }
    .img_tag{
            width: 18px;
    }
    .Home-Page{
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
    .Home-Page h1{
        text-align: center;
        font-size: 35px;
        border-top: 4px solid #4caf50;
        border-bottom: 4px solid #4caf50;
        margin-top: 2px;
        margin-bottom: 3px;
        padding: 2px;
    } 
    .Home-Page h2{
      float: right;
      font-size: 27px;
      padding: 0px;
      margin: 0;
    }
    .Home-Page h3{
        text-align: center;
        font-size: 25px;
        border-top: 4px solid #4caf50;
        border-bottom: 4px solid #4caf50;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .Home-Page a{
      color: #1498cc;
    }
    .logout{
      color: red;
      text-align: right;
      margin-right: 40px;
      margin-top: 0;
    }
    .textbox{
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        border-bottom: 10px 0;
     }
     .textbox input{
        border: none;
        outline: none;
        background: none;
        color: white;
        font-size: 15px;
        width: 140px;
        margin-top: 5px;
        border-bottom: 1px solid #4caf50;
        margin: 0 8px;
     }
     .textbox textarea{
        border: none;
        outline: none;
        background: none;
        color: white;
        font-size: 15px;
        width: 140px;
        margin-top: 5px;
        border-bottom: 1px solid #4caf50;
        margin: 0 8px;
     }
     .btn{
        width: 100%;
        background: none;
        border: 2px solid #4caf50;
        color: white;
        padding: 4px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
     }
     .btn1{
      width: 100%
      text-align: center;
      float: none;
      cursor: pointer;
      border: 2px solid #4caf50;
     }
  </style>
  <script type="text/javascript">

     var tcounter = 0;
     var dcounter = 0;


     function nameFunction()
     {
      var span_tag = document.createElement('span');
      var name_tag = document.createElement('INPUT');
      name_tag.setAttribute("type","text");
      name_tag.setAttribute("placeholder","Enter Label Name");
      var img_tag = document.createElement("IMG");
      img_tag.setAttribute("src","delete.png");
      img_tag.setAttribute("class","img_tag");
      
      var select_tag = document.createElement('SELECT');
      select_tag.options.add( new Option("text","text", true, true) );
      select_tag.options.add( new Option("number","number"));

      var mybr = document.createElement('br');
      span_tag.appendChild(mybr);

      increment();
      name_tag.setAttribute("Name","textelement[]");
      name_tag.setAttribute("id","textelement_"+ i);
      span_tag.appendChild(name_tag);

      span_tag.appendChild(select_tag);
      select_tag.setAttribute("Name","options[]");
      span_tag.appendChild(select_tag);

      img_tag.setAttribute("onclick","removeElement('myForm','id_"+ i +"')");
      span_tag.appendChild(img_tag);

      span_tag.setAttribute("id","id_"+i);
      document.getElementById("myForm").appendChild(span_tag)
    }
    var i = 0; /* Set Global Variable i */
    function increment()
    {
      i += 1; /* Function for automatic increment of field's "Name" attribute. */
    }


    function removeElement(parentDiv, childDiv)
    {
      if (childDiv == parentDiv)
      {
        alert("The parent div cannot be removed.");
      }
      else if (document.getElementById(childDiv))
      {
        var child = document.getElementById(childDiv);
        var parent = document.getElementById(parentDiv);
        parent.removeChild(child);
      }
      else
      {
        alert("Child div has already been removed or does not exist.");
        return false;
      } 
    }
</script>
</head>
<body>

<div class="Home-Page">
	<h1>Home Page</h1>
  <h2><a href="forms.php">View Forms</a></h2>
  <h2><a href="response.php">View Responses</a></h2>
<div class="textbox">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <div class="logout">
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    </div>
    <?php endif ?>
</div>
    <form method="POST" action="server.php">
      <div class="textbox">
        <h3>Web Form</h3>
     
       <div id="dynamicInput">
       </div>

      <input type="text" name="title" placeholder="Enter Form Name" value=""></p>

      <textarea name="description" placeholder="Enter Description"></textarea><br>

       <span id="myForm"></span><br>
       <button type="button" class ="btn" onclick="nameFunction()">Add Field</button><br>
       <input type="submit" class="btn1" name="create_form" value="Submit Form">
     </div>
     </div>
    </form>
		
</body>
</html>

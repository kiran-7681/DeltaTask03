<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$created_at = date('d/m/Y');
$entryid ="";
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admin WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO admin (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	$result = mysqli_query($db, $query);
    $_SESSION['id'] = mysqli_insert_id($db);

  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = $password;
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    $row = mysqli_fetch_array($results);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      $_SESSION['id'] = $row['id'];
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
if(isset($_POST['create_form']))
{
  $title = mysqli_real_escape_string($db,$_POST['title']);
  $description = mysqli_real_escape_string($db,$_POST['description']);
  //$form = mysqli_real_escape_string($db,$_POST['form']);
  $textelement = $_POST['textelement'];
  $options = $_POST['options'];
  $admin_id = $_SESSION['id'];
  $query ="insert into forms(title,description,admin_id,created_by,created_at,status)values('$title','$description','$admin_id','$admin_id','$created_at',1)";
  $result = mysqli_query($db,$query) or die(mysqli_error($db));
  $form_id = mysqli_insert_id($db);

  for($i=0; $i<count($textelement);$i++)
  {
    $query_fields = "insert into fields(label,type,form_id,created_at,created_by,status)values('$textelement[$i]','$options[$i]','$form_id','$created_at','$admin_id',1)";
    $result_fields = mysqli_query($db,$query_fields) or die(mysqli_error($db));
  } 
  if($result)
    header('location:forms.php');
}
if(isset($_POST['fill_response']))
{
  $entryid++;
  $form_id = $_POST['form_id'];
  $count = count($_POST['fields_id']);
  $query_user = "insert into users(form_id)values('$form_id')";
  $result_user = mysqli_query($db,$query_user) or die(mysqli_error($conn));
  $last_insert_id = mysqli_insert_id($db);
  for($i=0;$i<$count;$i++)
  {
    $j=$i+1;
    $fields_id = $_POST['fields_id'][$i];
    $values ='value'.$j;
    $values  = $_POST[$values];
    $query ="insert into user_inputs(form_id,user_id,fields_id,entry_id,value,created_at,status)values('$form_id','$last_insert_id','$fields_id','$entryid','$values','$created_at',1)";
    $result = mysqli_query($db,$query) or die(mysqli_error($db));
    if($result)
    {
      $_SESSION['form_result'] ="success";
      $entryid++;
      echo "<script>window.location='http://localhost/sample_master/unique_forms.php?id=$form_id'</script>";
    }
  }
}
?>

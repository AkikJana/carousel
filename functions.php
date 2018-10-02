<?php 
function redirect($location){
	header("LOCATION:$location");
}

function query($sql)
{
	global $connection;
	return mysqli_query($connection, $sql);
}

function confirm($reasult)
{
	global $connection;
	if(!$reasult)
	{
		echo "Connection failed".mysqli_error($connection);
	}
}

function escape_string($string){
global $connection;
return mysqli_real_escape_string($connection, $string);

}

function fetch_array($reasult)
{
 global $connection;
 return mysqli_fetch_array($reasult);
}
function display_internships()
{
	$city=$_GET['id'];
	echo $city;
	$query=query("SELECT *  FROM `cities` WHERE `city_id` = $city");
	confirm($query);
	$row=fetch_array($query);
	$cityname=$row['city_name'];
	$query=query("SELECT * FROM `internships` WHERE `location` LIKE '$cityname' ");
	confirm($query);
	while ($row=fetch_array($query)) {
		# print out all the internships associated with theparticular place
		$deli=<<<_delimeter
		<div class="card w-75 mx-auto mt-5  text-center" >
  <div class="card-header">
    {$row['internship_name']}
  </div>
  <div class="card-body">
    <h5 class="card-title">{$row['internship_company']}</h5>
    <p class="card-text"></p>
    <form action="place.php">
    <input value={$row['internship_id']} type="hidden">
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
_delimeter;
echo $deli;
	}
}
function place()
{
	if (isset($_POST['submit'])) {
		# code...
		echo "fuck";
	}
}
function display_cities()
{
	$query=query("SELECT * FROM `cities`");
	confirm($query);
	while ($row=fetch_array($query)) {
		# display the cities
		$deli=<<<_delimeter
		<div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>{$row['city_name']}</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="internships.php?id={$row['city_id']}" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
_delimeter;
          echo $deli;
	}
}
function login(){
	if (isset($_POST['submit'])) {
		# checks if the credentials match to the database
		//redirect("index.php");
		$mail=escape_string($_POST['mail']);
		$password=escape_string($_POST['password']);
		
		$query=query("SELECT * FROM `users` WHERE `user_mail` LIKE '$mail' AND `user_password` LIKE '$password'");
		confirm($query);
	//echo "$query";
		$row=fetch_array($query);
		if (confirm($query)=="" && mysqli_num_rows($query)!=0) {
			# if there are no errors it sets the session variable
			
			//echo $row['user_name'];
			$_SESSION['username']=$row['user_name'];
			$_SESSION['mail']=$row['user_mail'];
			$_SESSION['password']=$row['user_password'];
			//echo $_SESSION['username'];
			redirect("index.php");
		}
	else{
		echo "Your number or password is wrong.Please try again";
	}
	}
}

function is_signed_in(){
	if(!isset($_SESSION['username'])){
		$deli=<<<_delimeter
		 <ul class="navbar-nav mr-auto">
           
            <li class="nav-item">
              <a class="nav-link" href="login.php">Log In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sign-up.php">Sign up</a>
            </li>
          </ul>
_delimeter;
       echo $deli;
   }
	
	else {
		
		$deli=<<<_delimeter
<ul class="navbar-nav mr-auto">
		<li class="nav-item">

		<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {$_SESSION['username']}
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="profile.php">Profile</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
</li>
		 
           
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Log Out</a>
            </li>
            
          </ul>
		
		
_delimeter;
		echo $deli;
		}
}

function logout(){
	unset($_SESSION['username']);
 unset($_SESSION['password']);
 unset($_SESSION['mail']);
 session_destroy();
 redirect('index.php');

}

 function sign_up(){
	if (isset($_POST['submit']))
	{
		
		$username=escape_string($_POST['inputName']);
		$email=escape_string($_POST['inputEmail']);
		$password=escape_string($_POST['inputPassword']);
		//$number=escape_string($_POST['inputNumber']);
		if (unique($email)) {
			# checks if the email or password has been inserted into the table already
			
			redirect("sign-up.php");
			echo "the email or number is already taken";
		}
		else{
		$query=query("INSERT INTO `users` (`user_name`, `user_mail`, `user_password`, `user_internship`) VALUES ('$username', '$email', '$password', '')");
		//$query=query("INSERT INTO 'users'  VALUES('$username', '$number', '$email', '$password', '', '')");
			confirm($query);
			if (confirm($query)=="") {
				$_SESSION['username']=$username;
			$_SESSION['mail']=$email;
			$_SESSION['password']=$password;
				redirect("index.php");
				# code...
			}
		}
	}
}

function unique($email){

	$query=query("SELECT * FROM `users` WHERE `user_mail` LIKE '$email' ");
	if (mysqli_num_rows($query)!=0) {
		echo "in unique";
		return true;

	}
	else
		return false;
	
}
function usereducation()
{
	$mail=$_SESSION['mail'];
	$name=$_SESSION['username'];
	$query=query("SELECT * FROM `users` WHERE `user_name` LIKE '$name' AND `user_mail` LIKE '$mail' ");
	confirm($query);
	$row=fetch_array($query);
	echo $row['user_education'];
}
function sum() { 
	$mail=$_SESSION['mail'];
	$name=$_SESSION['username'];
    $query=query("SELECT * FROM `users` WHERE `user_name` LIKE '$name' AND `user_mail` LIKE '$mail' ");
    $temp=0;
	confirm($query);
	$row=fetch_array($query);
    $num=$row['user_internship']; 
    for ($i = 0; $i < strlen($num); $i++){ 
        $temp=$num[$i]; 
        $query=query("SELECT * FROM `internships` WHERE `internship_id` = $temp ");
        confirm($query);
        $rows=fetch_array($query);

        echo $rows['internship_name'];
        echo "       ";
        echo $rows['internship_company'];
        echo "<br>";
    } 
     
} 
/*function modal()
{
	$deli=<<<_delimeter
	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
_delimeter;
echo $deli;

}*/



 ?>
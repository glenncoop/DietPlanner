<?php

if (!defined('included')){
	die('You cannot access this file directly!');
}

//log user in --------------------------------
function login($user, $pass){
	//strip tags from variable
	$user = strip_tags(mysql_real_escape_string($user));
	$pass = strip_tags(mysql_real_escape_string($pass));

	$pass = md5($pass);

	//check if username and password combo exist in database
	$sql = "SELECT * FROM members WHERE username = '$user' AND password = '$pass'";
	$result = mysql_query($sql) or die('Query Failed: ' . mysql_error());

	if (mysql_num_rows($result) == 1){
		//username and password match
		//set the session
		$_SESSION['authorized'] = true;

		//direct to admin
		header('Location: '.DIRADMIN);
		exit();
	} else {
		//define an error mesesage
		$_SESSION['error'] = 'Sorry, wrong username or passsword'
	}
}

//check if the authorized session is true
function logged_in(){
	if($_SESSION['authorized'] == true){
		return true;
	} else {
		return false;
	}
}

//check outcome of logged_in
//redirect user to login if false
function login_required(){
	if(logged_in()){
		return true;
	} else {
		header('Location: '.DIRADMIN.'login.php');
		exit();
	}
}

//logout function, unsets sessions and redirects user
function logout(){
	unset($_SESSION['authorized']);
	header('Location: '.DIRADMIN.'login.php');
	exit();
}

//shows messages stored in a session
function messages(){
	$message = '';
	if($_SESSION['success'] != ''){
		$message = '<div class="msg-ok">'.$_SESSION['success'].'</div>';
		$_SESSION['success'] = '';
	}

	if($_SESSION['error'] != ''){
		$message = '<div class="msg-error">'.$_SESSION['error'].'</div>';
		$_SESSION['success'] = '';
	}
	echo "$message";
}

//loops through all errors and shows to user
function errors($error){
	if(!empty($error)){
		$i = 0;
		while ($i < count($error)){
			$showError.='<div class="msg-error">'.$error[$i].'</div>';
			$i++
		}
	echo $showError;
	}
}


?>
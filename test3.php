<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', True);

session_start();

if (isset($_GET['logout']))
{
	$_SESSION = array();
	if ($_COOKIE[session_name()])
	{
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
	header('Location: test3.php');
}

if (isset($_POST['username']))
{
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);
	
	if ($username == 'bob' and $password == '123')
	{
		$_SESSION['username'] = $username;
		echo 'Login Successful<br/>';
		echo  'Welcome, ' . $username;
	}
	else
	{
		echo '<span style="color: red">Login Failed</span>';
		echo  $username . ', does not exsit';
	}
}
?>

<html>
<head>
	<title>My login</title>
</head>
<body>
	<div></div>
	<?php if (isset($_SESSION['username'])) { ?>
	You are now logged in
	<a href="test3.php?logout=1">Logout</a>
	<?php } else { ?>
	<form action="" method="post">
		username: <input name="username" type="text" />
		password: <input name="password" type="password" />
		<input type="submit" />
	</form>
	<?php } ?>
</body>
</html>
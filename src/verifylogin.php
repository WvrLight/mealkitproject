<?php
	Session_start();

    $sql = "SELECT * FROM Customer WHERE custUsername = '" . $_REQUEST['username'] . "' AND custPassword = '" . $_REQUEST['password'] . "'";
    $stmt = $pdo->prepare($sqluser);
    $stmt->execute();
	$check = stmt->rowCount();
	
	if($check == 1)
	{
		$_SESSION['id']= $check['id'];
		$_SESSION['username']= $_REQUEST['username'];
		echo "<script>alert('Login successful!');</script>";
		echo "<script>window.location.href='inventory.php'</script>";
	}
	else {
		echo "<script>alert('Incorrect login details.');</script>";
		echo "<script>window.location.href='index.php'</script>";		
	}
?>
<?php 
	$con=mysqli_connect("localhost","root","","inventory_management_system") or die ("Eroor in Connection");

	$username='';$password='';

	if(isset($_COOKIE['INV_ADMINNAME']))
	$username=trim($_COOKIE['INV_ADMINNAME']);
	
	if(isset($_COOKIE['INV_ADMINPASS']))
	$password=trim($_COOKIE['INV_ADMINPASS']);

	if($username!='' || $password!='')
	{
		$query="SELECT * FROM `inv_admin` WHERE user_name='$username' and password='$password'";
		$res=mysqli_query($con,$query);
		$rowcount=mysqli_num_rows($res);
		if($rowcount==0)
		{
			header('Location:index.php');
		}
	}
	else
	{
			header('Location:index.php');
	}

?>
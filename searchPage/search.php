<?php
	session_start();
	
	$_SESSION['cerca']=$_POST['cerca'];
	$_SESSION['prod']=$_POST['prod'];
	$_SESSION['cat']=$_POST['cat'];
	
	if($_SESSION['cerca']=="Cosa vuoi cercare?") 			
		unset($_SESSION['cerca']);

	if($_SESSION['prod']=="null")				
		unset($_SESSION['prod']);

	if($_SESSION['cat']=="null")				
		unset($_SESSION['cat']);	




	session_write_close();

	if($_POST['provenienza']=="home")
		header( "refresh:0;url=../index.php");

	if($_POST['provenienza']=="offerte")
		header( "refresh:0;url=../offerte.php");

	if($_POST['provenienza']=="last")
		header( "refresh:0;url=../last.php");

?>
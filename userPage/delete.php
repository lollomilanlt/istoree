<?php
	session_start();
	$u=$_SESSION['user'];
	$p=$_POST['idProd'];
	$qe=$_POST['num'];

	
	$conn = mysql_connect("localhost","lorenzo","lorenzo");
	if(!$conn)
	{
		echo "Connessione fallita";
		exit;
	}
	
	$DB = mysql_select_db("my_istoree");
	if(!$DB)
	{
		echo "Selezione DB fallita";
		exit;
	}

	$query= "select * from carrello where fkProdotto=".$p." AND fkUtente=".$u;
	$result= mysql_query($query);
	if(!$result)
	{
		echo "Query fallita1";
		exit;
	}
	$pres=0;
	
	while($Dati = mysql_fetch_object($result))
	{
		$qp=$Dati->quantita;       
	}
	
	if($qe==$qp)
	{
			$query= "delete from carrello where fkProdotto=".$p." AND fkUtente=".$u;
			$result= mysql_query($query);
			if(!$result)
			{
				echo "Query fallita2";
				exit;
			}
	}
	else
	{	
			$qf=$qp-$qe;
			$query= "update carrello set quantita = ".$qf." where fkProdotto=".$p." AND fkUtente=".$u;
			$result= mysql_query($query);
			if(!$result)
			{
				echo "Query fallita3";
				exit;
			}
	}
	
	mysql_close($conn);
	
	header( "refresh:0;url=index.php");
		
?>
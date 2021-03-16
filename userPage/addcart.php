<?php
/*Solo php, prendo dalla search page quantità,idUtente alias fkUtente,idProdotto alias fkProdotto
nel post ho quantità e prodotto
nella session ho l'id utente

refreshare verso search page*/

	session_start();
	$u=$_SESSION['user'];
	$p=$_POST['idProd'];
	$q=$_POST['num'];

	
	$conn = mysqli_connect("localhost","istoree","lorenzo");
	if(!$conn)
	{
		echo "Connessione fallita";
		exit;
	}
	
	$DB = mysqli_select_db($conn,"my_istoree");
	if(!$DB)
	{
		echo "Selezione DB fallita";
		exit;
	}

	$query= "select * from carrello where fkProdotto=".$p." AND fkUtente=".$u;
	$result= mysqli_query($conn,$query);
	if(!$result)
	{
		echo "Query fallita";
		exit;
	}
	$pres=0;
	
	while($Dati = mysqli_fetch_object($result))
	{
		if($Dati->fkProdotto)	
		{
			$q=$q+$Dati->quantita;
			$pres=1;
		}	       
	}
	
	if($pres==0)
	{
			$query= "insert into carrello values(".$u.",".$p.",".$q.")";
			$result= mysqli_query($conn,$query);
			if(!$result)
			{
				echo "Query fallita";
				exit;
			}
	}
	else
	{
		//aggiornare il valore quantità ALTER TABLE....where fkProdotto=".$p." AND fkUtente=".$u;
		/*
		UPDATE nome_tabella
SET nome_campo = 'nuovo_valore'
WHERE altro_campo = 'valore'
		*/
		
		
			$query= "update carrello set quantita = ".$q." where fkProdotto=".$p." AND fkUtente=".$u;
			$result= mysqli_query($conn,$query);
			if(!$result)
			{
				echo "Query fallita";
				exit;
			}
	}
	
	mysqli_close($conn);
	
	header( "refresh:0;url=../index.php");
		
?>
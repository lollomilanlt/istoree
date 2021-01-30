<html>
    
    <head>
        <title>Cancellazione</title>    
    </head>
        
    <body>
		<?php
			$id=$_POST['idProd'];
			
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
		
		
		
			$query= "delete from offerta where fkProdotto=".$id;
			$result= mysql_query($query);
			if(!$result)
			{
				echo "Query fallita";
				exit;
			}
			else
				echo "<b>Sconto eliminato correttamente!</b>";
			
			mysql_close($conn);
		
		
			echo "<br/><i>sarai rindirizzato alla pagina principale tra 5 secondi</i>";
			echo "<br/><a href=\"index.php\"><u>Clicca qui se non vuoi attendere oltre</u></a>";
		
			header( "refresh:50;url=index.php");
			
		?>
		
	</body>
	</html>
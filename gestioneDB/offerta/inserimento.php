<html>
    
    <head>
        <title>Invio</title>    
    </head>
        
    <body>
	
	<p align="center">
    <?php
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
        
        $query= "insert into offerta values (".$_POST['idProd'].",".$_POST['sconto'].")";
        $result= mysql_query($query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
		else
			echo "<b>Sconto inserito correttamente!</b>";
		mysql_close($conn);
		
		
		echo "<br/><i>sarai rindirizzato alla pagina principale tra 5 secondi</i>";
		echo "<br/><a href=\"index.php\"><u>Clicca qui se non vuoi attendere oltre</u></a>";
		
		header( "refresh:5;url=index.php");
		
	?> 
	</p>
	
	
	</body>
	
</html>
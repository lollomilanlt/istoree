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
        
        $query= "insert into utente(username,password) values ('".$_POST['user']."','".$_POST['pass']."')";
        $result= mysql_query($query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
		else
			echo "<div align=\"center\"><b><h3>Registrazione effettuata con successo!</b></h3></div>";
		mysql_close($conn);
		
		
		
		
		header( "refresh:1;url=index.php");
?>       




<html>
    
    <head>
        <title>Inserimento</title>    
    </head>
        
    <body>
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
        
        $query= "select * from categorie";
        $result= mysql_query($query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
        
        echo "
            <table border=\"2\">
                <tr>
                    <th>ID</th>
                    <th>Descrizione</th>
                    
                </tr>
        ";
        
        while($Dati = mysql_fetch_object($result))
        {
            echo"<tr>
                <td>".$Dati->idCategorie."</td>
                <td>".$Dati->Descrizione."</td>
                </tr>";
        }
        echo "</table>";
        
        mysql_close($conn);
    ?>
        
    <br/><br/><br/><br/><br/><br/>
    
    <form action="inserimento.php" method="POST">
        inserisci categoria <input type="text" name="desc"/><br/>
     
        
        <input type="submit" value="INVIA"/>
        <input type="reset" value="ELIMINA"/>
		
		
		</br></br></br><a href="..\index.php">Torna indietro</a>
        
        
        
        
        
        
        
        
    </body>    
</html>


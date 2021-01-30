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
        
        $query= "select * from produttore";
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
                    <th>Nome</th>
                    <th>N. telefono</th>
                </tr>
        ";
        
        while($Dati = mysql_fetch_object($result))
        {
            echo"<tr>
                <td>".$Dati->idProduttore."</td>
                <td>".$Dati->nome."</td>
                <td>".$Dati->nTelefono."</td>
                </tr>";
        }
        echo "</table>";
        
        mysql_close($conn);
    ?>
        
    <br/><br/><br/><br/><br/><br/>
    
    <form action="inserimento.php" method="POST">
        inserisci nome <input type="text" name="nome"/><br/>
        inserisci numero di telefono <input type="text" name="telefono"/><br/>
        
        <input type="submit" value="INVIA"/>
        <input type="reset" value="ELIMINA"/>
        
    </br></br></br><a href="..\index.php">Torna indietro</a>    
        
        
        
        
        
        
    </body>    
</html>


<html>
    
    <head>
        <title>Inserimento</title>    
    </head>
        
    <body>
    <?php
        $conn = mysqli_connect("localhost","lorenzo","lorenzo");
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
        
	
		echo "
			<br/><br/>
		
			<form action=\"inserimento.php\" method=\"POST\" enctype=\"multipart/form-data\">
			inserisci nome <input type=\"text\" name=\"nome\"/><br/>
			inserisci versione<input type=\"text\" name=\"ver\"/><br/>
			inserisci prezzo <input type=\"text\" name=\"prezzo\"/><br/>
			inserisci lingua <input type=\"text\" name=\"lingua\"/><br/>";
//DEVI INSERIRE I CAMPI CORRETTI
		
	
//Tendina produttori
		echo "Seleziona produttore";
		$query= "select * from produttore";
        $result= mysqli_query($conn,$query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
        echo "<select name=\"prod\">";
        while($Dati = mysqli_fetch_object($result))
        {
			
			echo "<option value=\"".$Dati->idProduttore."\">".$Dati->nome."</option>";

            
        }
        echo "</select><br/>";			

//Tendina categorie		
		echo "Seleziona categoria";
		$query= "select * from categorie";
        $result= mysqli_query($conn,$query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
        echo "<select name=\"cat\">";
        while($Dati = mysqli_fetch_object($result))
        {
			
			echo "<option value=\"".$Dati->idCategorie."\">".$Dati->Descrizione."</option>";

            
        }
        echo "</select>";	

//Upload immagini

	echo "<br/> Carica immagine: <input type=\"file\" name =\"img\"/>";

		
		
			
			
		echo "<br/>
			<input type=\"submit\" value=\"Inserisci\"/>
			<input type=\"reset\" value=\"ELIMINA\"/>
			</form>
		";
		

		
		
		
//stampa della lista dei prodotti

		//form che rimanda alla pagina delete.php ceh eseguirà una query che cancelllerà a seconda della chiave primaria inviata
		
		echo "<form action=\"delete.php\" method=\"POST\">";
			  
		
		echo "
            <table border=\"2\">
                <tr>
					<th>ID</th>
                    <th>Nome</th>
                    <th>Versione</th>
                    <th>Prezzo</th>
					<th>Lingua</th>
					<th>fkProduttore</th>
					<th>fkCategorie</th>
					<th>Img</th>
					<th>DataInserimento</th>
					<th>Elimina</th>
                </tr>
        ";
        
		$query= "select * from prodotto";
        $result= mysqli_query($conn,$query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
		
		
		
		
		while($Dati = mysqli_fetch_object($result))
        {
            echo"<tr>
				<td>".$Dati->idProdotto."</td>
                <td>".$Dati->nome."</td>
                <td>".$Dati->versione."</td>
                <td>".$Dati->prezzo."</td>
				<td>".$Dati->lingua."</td>
				<td>".$Dati->fkProduttore."</td>
				<td>".$Dati->fkCategorie."</td>
				<td><img src=\"".$Dati->img."\" height=\"30\"/></td>
				<td>".$Dati->dataInserimento."</td>
				<td><input type=\"radio\" name=\"idProd\" value=\"".$Dati->idProdotto."\" /></td>
                </tr>";
        }
        echo "</table>";
	        mysqli_close($conn);

		//pulsante di invio della form e chiusura di form
		
		echo "</br><input type=\"submit\" value= \"Elimina\"/></form>";
		
        
    ?>
        

    </br></br></br><a href="..\index.php">Torna indietro</a>    
        
        
        
        
        
        
        
    </body>    
</html>


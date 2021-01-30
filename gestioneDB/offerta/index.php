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
        
			$query= "select * from offerta";
			$result= mysql_query($query);
			if(!$result)
			{
				echo "Query fallita";
				exit;
			}
			echo "<form action=\"delete.php\" method=\"POST\">";
				  
			echo "
				<table border=\"2\">
					<tr>
						<th>ID Prodotto</th>
						<th>Sconto</th>
						<th>Elimina</th>
					</tr>
			";
			
			
			while($Dati = mysql_fetch_object($result))
			{
				echo"<tr>
					<td>".$Dati->fkProdotto."</td>
					<td>".$Dati->sconto." %</td>
					<td><input type=\"radio\" name=\"idProd\" value=\"".$Dati->fkProdotto."\" /></td>
					 
					</tr>";
			}
			echo "</table>";
		echo "</br><input type=\"submit\" value= \"Elimina\"/></form>";

        
		//inserimento sconti
		
		echo "<br/><br/>
				<table align=\"center\" border=\"2\" width=\"65%\">
					<tr align=\"center\">
						<th>Img</th>
						<th>Nome</th>
						<th>Versione</th>
						<th>Lingua</th>
						<th>Produttore</th>
						<th>Categorie</th>
						<th>Prezzo</th>
						<th>Aggiungi sconto</th>";
	
		echo"</tr>";
			
			$query= "select img, p.nome, versione, prezzo, lingua, pr.nome as Produttore, Descrizione, idProdotto from categorie join (prodotto p join produttore pr on fkProduttore = idProduttore) on fkCategorie = idCategorie";
			
			
			
			
			$result= mysql_query($query);
			if(!$result)
			{
				echo "Query fallita";
				//exit;
			}
			
				
			
			
			while($Dati = mysql_fetch_object($result))
			{
				echo"<tr>
					<td align=\"center\"><img src=\"../prodotto/".$Dati->img."\" height=\"100\"/></td>
					<td align=\"center\">".$Dati->nome."</td>
					<td align=\"center\">".$Dati->versione."</td>
					<td align=\"center\">".$Dati->lingua."</td>
					<td align=\"center\">".$Dati->Produttore."</td>
					<td align=\"center\">".$Dati->Descrizione."</td>
					<td align=\"center\">".$Dati->prezzo." &#8364</td>
					";
						echo "<td align=\"center\">
								<form action=\"inserimento.php\" method=\"POST\">
								<input type=\"hidden\" name=\"idProd\" value=\"".$Dati->idProdotto."\" />
								<select name=\"sconto\">";
						for($i=10;$i<=100;$i+=10)
							echo "<option value=\"".$i."\">".$i." %</option>";
						echo "	</select>
								<input type=\"submit\" value=\"Aggiungi sconto\"/>
								</form>
							</td>";
						
			}
			echo "</tr>";
			echo "</table>";
			
		
		
		
		
		
		
		
		
		
		
        mysql_close($conn);
    ?>
       </br></br></br><a href="..\index.php">Torna indietro</a> 
    <br/><br/><br/><br/><br/><br/>
    
        
        
        
        
        
        
        
        
    </body>    
</html>


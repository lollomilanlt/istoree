<html>
	<head>
		<title>Searchpage</title>
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

//barra di ricerca        
		echo "
			<br/><br/>
		
			<form action=\"search.php\" method=\"POST\">
			<input type=\"text\" name=\"cerca\" value=\"Cosa vuoi cercare?\"/>";
		
	
//Tendina produttori
		echo "Produttore";
		$query= "select * from produttore";
        $result= mysql_query($query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
        echo "<select name=\"prod\">";
		echo "<option value=\"null\">---</option>";
        while($Dati = mysql_fetch_object($result))
        {
			
			echo "<option value=\"".$Dati->nome."\">".$Dati->nome."</option>";

            
        }
        echo "</select>";			

//Tendina categorie		
		echo "Categoria";
		$query= "select * from categorie";
        $result= mysql_query($query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
        echo "<select name=\"cat\">";
		echo "<option value=\"null\">---</option>";
        while($Dati = mysql_fetch_object($result))
        {
			
			echo "<option value=\"".$Dati->Descrizione."\">".$Dati->Descrizione."</option>";

            
        }
        echo "</select>";	
			
			
		echo "
			<input type=\"submit\" value=\"Cerca\"/>
			<input type=\"reset\" value=\"Reset\"/>
			</form>
		";
//fine barra di ricerca

//risultati ricerca

		session_start();
		

		echo "
				<table align=\"center\" border=\"2\" width=\"65%\">
					<tr align=\"center\">
						<th>Img</th>
						<th>Nome</th>
						<th>Versione</th>
						<th>Lingua</th>
						<th>Produttore</th>
						<th>Categorie</th>
						<th>Prezzo</th>";
		if(isset($_SESSION['user'])) echo "<th>Aggiungi</th>";
		echo"</tr>";
			
			$query= "select img, p.nome, versione, prezzo, lingua, pr.nome as Produttore, Descrizione, idProdotto from categorie join (prodotto p join produttore pr on fkProduttore = idProduttore) on fkCategorie = idCategorie";
			$condition = "";
			
			
			if(isset($_SESSION['cerca'])||isset($_SESSION['prod'])||isset($_SESSION['cat']))
			{
				$condition = " where ";
				if(isset($_SESSION['cerca']))//isset session [nome]
				{	
					$condition = $condition."p.nome like '%".$_SESSION['cerca']."%'";
					if(isset($_SESSION['cat']))
						$condition = $condition." AND Descrizione = '".$_SESSION['cat']."'";
					if(isset($_SESSION['prod']))
						$condition = $condition." AND pr.nome = '".$_SESSION['prod']."'";
				}
				else
				{
					if(isset($_SESSION['cat']))
					{	$condition = $condition."Descrizione = '".$_SESSION['cat']."'";
					if(isset($_SESSION['prod']))
						$condition = $condition." AND pr.nome = '".$_SESSION['prod']."'";
					}
					else 
						if(isset($_SESSION['prod']))
							$condition = $condition."pr.nome = \"".$_SESSION['prod']."\"";	
				}
			}	
			
			
			
			$result= mysql_query($query.$condition);
			if(!$result)
			{
				echo "Query fallita";
				//exit;
			}
			
				
			
			
			while($Dati = mysql_fetch_object($result))
			{
				echo"<tr>
					<td align=\"center\"><img src=\"../gestioneDB/prodotto/".$Dati->img."\" height=\"100\"/></td>
					<td align=\"center\">".$Dati->nome."</td>
					<td align=\"center\">".$Dati->versione."</td>
					<td align=\"center\">".$Dati->lingua."</td>
					<td align=\"center\">".$Dati->Produttore."</td>
					<td align=\"center\">".$Dati->Descrizione."</td>
					<td align=\"center\">".$Dati->prezzo." &#8364</td>
					";
					if(isset($_SESSION['user']))
					{
						echo "<td align=\"center\">
								<form action=\"../userPage/addcart.php\" method=\"POST\">
								<input type=\"hidden\" name=\"idProd\" value=\"".$Dati->idProdotto."\" />
								<select name=\"num\">";
						for($i=1;$i<=10;$i++)
							echo "<option value=\"".$i."\">".$i."</option>";
						echo "	</select>
								<input type=\"submit\" value=\"Aggiungi al carrello\"/>
								</form>
							</td>";
						
					}
				echo "</tr>";
			}
			echo "</table>";
			
			
			//echo $_SESSION['cerca']." ".$_SESSION['prod']." ".$_SESSION['cat']."<br/>";
			if(isset($_SESSION['cerca'])||isset($_SESSION['prod'])||isset($_SESSION['cat']))
			{
				
				unset($_SESSION['cerca']);
				unset($_SESSION['prod']);
				unset($_SESSION['cat']);	
				session_write_close();
			}
			
			mysql_close($conn);

			?>
	</body>

</html>
<html>
	<head>
		<title>Carrello</title>
		<link href="../stili/stili.css" rel="stylesheet" type="text/css">
		<link href="../stili/btn.css" rel="stylesheet" type="text/css">
		<link href="../stili/form.css" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php
			session_start();
			
			
			if(isset($_SESSION['user']))
			{
				$idUser=$_SESSION['user'];
				//messaggio di benvenuto al nome utente
					
				$conn = mysql_connect("localhost","istoree","lorenzo");
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
				
					echo"
				<table border=\"0\" class=\"head\">
					<tr valign=\"center\">
						<td width=\"150\" rowspan=\"2\">
					
						<a href=\"../index.php\"><img src=\"../images/logo.png\" width=\"100px\"></a>
						</td>
						<td valign=\"center\">";
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
							echo "<br/><form action=\"../searchPage/search.php\"  class=\"form-inline\" method=\"POST\" >
								<input type=\"text\" class=\"form-control\" name=\"cerca\" value=\"Cosa vuoi cercare?\"/ size=\"120\">
							
								<input type=\"hidden\" name=\"provenienza\" value=\"home\"/>";
							
						
					//Tendina produttori
							echo "&nbsp&nbsp&nbsp&nbspProduttore:&nbsp&nbsp&nbsp&nbsp";
							$query= "select * from produttore";
							$result= mysql_query($query);
							if(!$result)
							{
								echo "Query fallita";
								exit;
							}
							echo "<select class=\"form-control\" name=\"prod\">";
							echo "<option value=\"null\">Produttore</option>";
							while($Dati = mysql_fetch_object($result))
							{
								
								echo "<option value=\"".$Dati->nome."\">".$Dati->nome."</option>";

								
							}
							echo "</select>";			

					//Tendina categorie		
							echo "&nbsp&nbsp&nbsp&nbspCategoria:&nbsp&nbsp&nbsp&nbsp";
							$query= "select * from categorie";
							$result= mysql_query($query);
							if(!$result)
							{
								echo "Query fallita";
								exit;
							}
							echo "<select class=\"form-control\"  name=\"cat\">";
							echo "<option value=\"null\">Categoria</option>";
							while($Dati = mysql_fetch_object($result))
							{
								
								echo "<option value=\"".$Dati->Descrizione."\">".$Dati->Descrizione."</option>";

								
							}
							echo "</select>";	
								
								
							echo "&nbsp&nbsp&nbsp&nbsp
								<input type=\"submit\" class=\"btn btn-success\" value=\"Cerca\"/>
								</form>";
								
					//fine barra di ricerca
						echo"</td>
					</tr>
					<tr><td>
						<table border=\"0\" width=\"100%\" height=\"100%\"><tr>
							<td class=\"menu\" valign=\"bottom\">
								<a href=\"../index.php\">Home</a>
							</td>
							<td class=\"menu\" valign=\"bottom\">
								<a href=\"../offerte.php\">Offerte</a>
							</td>
							<td class=\"menu\" valign=\"bottom\">
								<a href=\"../last.php\">Nuovi arrivi</a>
							</td>
							<td align=\"right\" valign=\"bottom\">";
								if(!isset($_SESSION['user']))
									echo "<a href=\"../login.html\">Effettua il login</a>&nbsp&nbsp";
								else
								{	$idUser=$_SESSION['user'];
									$q="select * from utente where codiceUtente=".$idUser;
									$r= mysql_query($q);
									if(!$r)
									{
										echo "Query fallita";
										exit;
									}
									while($D = mysql_fetch_object($r))
									{
										$user=$D->username;
									}
									
									echo "<table border=\"0\"><tr>
										<td valign=\"center\">";
											if($user=="Lorenzo")
											echo "<a href=\"..\gestioneDB/index.php\"><font color=\"#FFBD39\"><b>Amministra&nbsp&nbsp&nbsp&nbsp</b></font></a>";
											echo "<b>Bentornato ".$user."&nbsp&nbsp</b></td><td  valign=\"center\">";
											
										
											echo "<form action=\"..\logout.php\">
											<input type=\"submit\"  class=\"btn btn-warning btn-xs\" value=\"Logout\"/>&nbsp&nbsp</form>
										</td>
										
										
										
										
										</tr></table>";
								}
							echo "</td>
							
						</tr></table>
					</td></tr>
				</table>";
		
				echo "<p align=\"center\">Questo &egrave il tuo carrello</p>";
				//Visualizza il contenuto del carrello 
			//possibile banner
				echo "<table border=\"0\" align=\"center\" height=\"75%\" width=\"100%\"><tr>
				<td  align=\"center\"  valign=\"center\" width=\"17%\">
				<img src=\"../images/banner-1.png\" width=\"180px\"/></td>
				<td  valign=\"top\" width=\"66%\">
				<div style=\"height: 100%; overflow-y:true; overflow:auto; scroll;border:0px solid black;\">";	
				
						$query= "select img, p.nome, versione, prezzo, lingua, pr.nome as Produttore, Descrizione, quantita, idProdotto 
						from carrello c join (categorie join (prodotto p join produttore pr on fkProduttore = idProduttore) on fkCategorie = idCategorie) on c.fkProdotto = idProdotto
						where fkUtente=".$idUser;
						
						$r= mysql_query($query);
						if(!$r)
						{
							echo "Query fallita";
							exit;
						}
						
						echo "
							<table align=\"center\" border=\"0\" width=\"95%\">
								<tr align=\"center\">
									<th>Immagine</th>
									<th>Nome</th>
									<th>Versione</th>
									<th>Lingua</th>
									<th>Produttore</th>
									<th>Categoria</th>
									<th>Quantit&agrave</th>
									<th>Prezzo Tot</th>";
						
						$tot=0;
						$sc=0;
						while($Dati = mysql_fetch_object($r))
						{
						if($sc%2==0)
							$color="#C6C6FF";
						else
							$color="#E3E3FF";
						
						$sc++;
						//calcolo sconto
						$sconto=0;
						$innerquery="select * from offerta where fkProdotto = ".$Dati->idProdotto;
						$innerres=mysql_query($innerquery);
						if(!$innerres)
						{
							echo "Query fallita";
							//exit;
						}
						
						while($innerDati = mysql_fetch_object($innerres))
								$sconto=$innerDati->sconto;

						if($sconto!=0)
							$prezzo=$Dati->prezzo-($Dati->prezzo/100*$sconto);
						else
							$prezzo=$Dati->prezzo;
						//fine calcolo sconto
							echo"<tr bgcolor=\"".$color."\">
								<td align=\"center\"><img src=\"../gestioneDB/prodotto/".$Dati->img."\" height=\"100\"/></td>
								<td align=\"center\">".$Dati->nome."</td>
								<td align=\"center\">".$Dati->versione."</td>
								<td align=\"center\">".$Dati->lingua."</td>
								<td align=\"center\">".$Dati->Produttore."</td>
								<td align=\"center\">".$Dati->Descrizione."</td>
								<td align=\"center\">".$Dati->quantita."</td>
								<td align=\"center\">";
								if($sconto!=0)
									echo "<font class=\"sconto\">".number_format($prezzo*$Dati->quantita, 2)." &#8364</font><img valign=\"center\" src=\"../images/sconto.png\" width=\"30\" /></td>";
								else
									echo number_format($prezzo*$Dati->quantita, 2)." &#8364</td>";
								
							
									echo "<td align=\"center\">
											<form action=\"delete.php\" method=\"POST\">
											<input type=\"hidden\" name=\"idProd\" value=\"".$Dati->idProdotto."\" />
											<select class=\"btn btn-default dropdown-toggle\" name=\"num\">";
									for($i=1;$i<=$Dati->quantita;$i++)
										echo "<option value=\"".$i."\">".$i." </option>";
									echo "	</select>
											<input type=\"submit\" class=\"btn btn-primary btn-sm\" value=\"Elimina dal carrello\"/>
											</form>
										</td>";
									
								
							echo "</tr>";
							$tot+=$prezzo*$Dati->quantita;
						}
						echo "</table>";
				
				
				echo "</div></td>
				<td align=\"center\"  valign=\"center\"  width=\"17%\"><img src=\"../images/banner-2.png\"  width=\"180px\"/ /></td>
				</tr>
				<tr><td colspan=\"3\"><center><p><font class=\"sconto\">Totale: ".number_format($tot, 2)." &#8364</font></p></center></td></tr>
				</table>";
				echo "";
			}
			else
				header( "refresh:0;url=../");

		
		
		?>
	</body>
</html>
<html>
	<head>
		<title>E-commerce</title>
		<link href="stili/stili.css" rel="stylesheet" type="text/css">
		<link href="stili/btn.css" rel="stylesheet" type="text/css">
		<link href="stili/form.css" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	</head>
	<body>
		
		<?php
			session_start();

			echo"
				<table border=\"0\" class=\"head\">
					<tr valign=\"center\">
						<td width=\"150\" rowspan=\"2\">
					
						<a href=\"index.php\"><img src=\"images/logo.png\" width=\"100px\"></a>
						</td>
						<td valign=\"center\">";
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

					//barra di ricerca        
							echo "<br/><form action=\"searchPage/search.php\"  class=\"form-inline\" method=\"POST\" >
								<input type=\"text\" class=\"form-control\" name=\"cerca\" value=\"Cosa vuoi cercare?\"/ size=\"120\">
							
								<input type=\"hidden\" name=\"provenienza\" value=\"last\"/>";
							
						
					//Tendina produttori
							echo "&nbsp&nbsp&nbsp&nbspProduttore:&nbsp&nbsp&nbsp&nbsp";
							$query= "select * from produttore";
							$result= mysqli_query($conn,$query);
							if(!$result)
							{
								echo "Query fallita";
								exit;
							}
							echo "<select class=\"form-control\" name=\"prod\">";
							echo "<option value=\"null\">Produttore</option>";
							while($Dati = mysqli_fetch_object($result))
							{
								
								echo "<option value=\"".$Dati->nome."\">".$Dati->nome."</option>";

								
							}
							echo "</select>";			

					//Tendina categorie		
							echo "&nbsp&nbsp&nbsp&nbspCategoria:&nbsp&nbsp&nbsp&nbsp";
							$query= "select * from categorie";
							$result= mysqli_query($conn,$query);
							if(!$result)
							{
								echo "Query fallita";
								exit;
							}
							echo "<select class=\"form-control\"  name=\"cat\">";
							echo "<option value=\"null\">Categoria</option>";
							while($Dati = mysqli_fetch_object($result))
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
								<a href=\"index.php\">Home</a>
							</td>
							<td class=\"menu\" valign=\"bottom\">
								<a href=\"offerte.php\">Offerte</a>
							</td>
							<td class=\"menu\" valign=\"bottom\">
								<a href=\"last.php\"><b><font color=\"#FFBD39\">Nuovi arrivi</b></font></a>
							</td>
							<td align=\"right\" valign=\"bottom\">";
								if(!isset($_SESSION['user']))
									echo "<a href=\"login.html\">Effettua il login</a>&nbsp&nbsp";
								else
								{	$idUser=$_SESSION['user'];
									$q="select * from utente where codiceUtente=".$idUser;
									$r= mysqli_query($conn,$q);
									if(!$r)
									{
										echo "Query fallita";
										exit;
									}
									while($D = mysqli_fetch_object($r))
									{
										$user=$D->username;
									}
									
									echo "<table border=\"0\"><tr>
										<td valign=\"center\">";
											if($user=="Lorenzo")
											echo "<a href=\"gestioneDB/index.php\"><font color=\"#FFBD39\"><b>Amministra&nbsp&nbsp&nbsp&nbsp</b></font></a>";
											echo "<b>Bentornato ".$user."&nbsp&nbsp</b></td><td  valign=\"center\">";
											
										
											echo "<form action=\"logout.php\">
											<input type=\"submit\"  class=\"btn btn-warning btn-xs\" value=\"Logout\"/>&nbsp&nbsp</form>
										</td>
										<td align=\"center\"  valign=\"center\">
											<a href=\"userpage\">
												<img src=\"images/cart.png\" width=\"40\"/>
											</a>
										</td>
										</tr></table>";
								}
							echo "</td>
							
						</tr></table>
					</td></tr>
				</table>";
		
//risultati ricerca

		
		echo "<br/>";
		
//possibile banner
		echo "<table border=\"0\" align=\"center\" height=\"85%\" width=\"100%\"><tr>
				<td  align=\"center\"  valign=\"center\" width=\"17%\">
				<img src=\"images/banner-1.png\" width=\"180px\"/></td>
				<td  valign=\"top\" width=\"66%\">
				<div style=\"height: 100%; overflow-y:true; overflow:auto; scroll;border:0px solid black;\">";
//risultati
		echo "
				<table align=\"center\" border=\"0\" width=\"95%\">
					<tr align=\"center\">
						<th></th>
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
			
			
			
			$result= mysqli_query($conn,$query.$condition);
			if(!$result)
			{
				echo "Query fallita";
				//exit;
			}
			
				
			
			$sc=0;
			while($Dati = mysqli_fetch_object($result))
			{	
				$last=date('Y/m/d');
				$nlast= strtotime ( '-30 day' , strtotime ( $last ) ) ;
				$last=date('Y/m/d',$nlast);
				
				$innerquerytop="select * from prodotto where dataInserimento>'".$last."'";
				$innerrestop=mysqli_query($conn,$innerquerytop);
				if(!$innerrestop)
				{
					echo "Query fallita";
					//exit;
				}
				
				while($innerDatitop = mysqli_fetch_object($innerrestop))
				{		
					if($Dati->idProdotto==$innerDatitop->idProdotto)
					{
					
						if($sc%2==0)
							$color="#C6C6FF";
						else
							$color="#E3E3FF";
						
						$sc++;
						
						//calcolo sconto
						$sconto=0;
						$innerquery="select * from offerta where fkProdotto = ".$Dati->idProdotto;
						$innerres=mysqli_query($conn,$innerquery);
						if(!$innerres)
						{
							echo "Query fallita";
							//exit;
						}
						
						while($innerDati = mysqli_fetch_object($innerres))
								$sconto=$innerDati->sconto;

						if($sconto!=0)
							$prezzo=$Dati->prezzo-($Dati->prezzo/100*$sconto);
						else
							$prezzo=$Dati->prezzo;
						//fine calcolo sconto
						echo"<tr bgcolor=\"".$color."\">
							<td align=\"center\"><img src=\"gestioneDB/prodotto/".$Dati->img."\" height=\"100\"/></td>
							<td align=\"center\">".$Dati->nome."</td>
							<td align=\"center\">".$Dati->versione."</td>
							<td align=\"center\">".$Dati->lingua."</td>
							<td align=\"center\">".$Dati->Produttore."</td>
							<td align=\"center\">".$Dati->Descrizione."</td>
							<td align=\"center\">";
							if($sconto!=0)
								echo "<font class=\"sconto\">".number_format($prezzo, 2)." &#8364</font><img valign=\"center\" src=\"images/sconto.png\" width=\"30\" /></td>";
							else
								echo number_format($prezzo, 2)." &#8364</td>";
							
							if(isset($_SESSION['user']))
							{
								echo "<td align=\"center\">
										<form action=\"userPage/addcart.php\" method=\"POST\">
										<input type=\"hidden\" name=\"idProd\" value=\"".$Dati->idProdotto."\" />
										<select class=\"btn btn-default dropdown-toggle\" size=\"1\" name=\"num\">";
								for($i=1;$i<=10;$i++)
									echo "<option value=\"".$i."\">".$i."</option>";
								echo "	</select>
										<input type=\"submit\" class=\"btn btn-primary btn-sm\" value=\"Aggiungi al carrello\"/>
										</form>
									</td>";
								
							}
						echo "</tr>";
					}
				}
			}
			echo "</table>";
			
			echo "</div></td>
				<td align=\"center\"  valign=\"center\"  width=\"17%\"><img src=\"images/banner-2.png\"  width=\"180px\"/ /></td>
				</tr></table>";
			
			
			//echo $_SESSION['cerca']." ".$_SESSION['prod']." ".$_SESSION['cat']."<br/>";
			if(isset($_SESSION['cerca'])||isset($_SESSION['prod'])||isset($_SESSION['cat']))
			{
				
				unset($_SESSION['cerca']);
				unset($_SESSION['prod']);
				unset($_SESSION['cat']);	
				session_write_close();
			}
			
			mysqli_close($conn);

			?>
		
	
		



		

	</body>


</html>
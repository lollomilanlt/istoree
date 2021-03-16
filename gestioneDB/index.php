<html>
	<head>
		<title>Gestione</title>
	</head>
	<body>
		<?php
			session_start();
			
			if(!isset($_SESSION['user'])) header( "refresh:0;url=..\\");
			else 
				if($_SESSION['user']!=1) header( "refresh:0;url=..\\");
				else{
					
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

					echo"
					<a href=\"..\index.php\">Torna al sito</a>";
					echo"
					<table border=\"1\" width=\"100%\" height=\"100%\">
						<tr>
							<td width=\"20%\" align=\"center\">"; 
							
							//utenti
							$query= "select * from utente";
							$result= mysqli_query($conn,$query);
							if(!$result)
							{
								echo "Query fallita";
								exit;
							}
							
							echo "
								<table border=\"2\">
									<tr>
										<th>ID</th>
										<th>User</th>
										<th>Pass</th>
									</tr>
							";
			
							while($Dati = mysqli_fetch_object($result))
							{
								echo"<tr>
									<td>".$Dati->codiceUtente."</td>
									<td>".$Dati->username."</td>
									<td>".$Dati->password."</td>
									</tr>";
							}
							echo "</table>";
							
							
							echo "</td>
							<td>
								<table width=\"100%\" height=\"100%\" border=\"1\">
									<tr>
										<td width=\"33%\" align=\"center\">";
					//cat			
											$query= "select * from categorie";
											
											$result= mysqli_query($conn,$query);
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
											
											while($Dati = mysqli_fetch_object($result))
											{
												echo"<tr>
													<td>".$Dati->idCategorie."</td>
													<td>".$Dati->Descrizione."</td>
													</tr>";
											}
											echo "</table>";
											echo "<a href=\"categoria/index.php\">Modifica</a>";
										
										
										echo"</td>
										<td width=\"33%\" align=\"center\">";
							//offerte
									    $query= "select * from offerta";
										$result= mysqli_query($conn,$query);
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
												
												</tr>
										";
										
										
										while($Dati = mysqli_fetch_object($result))
										{
											echo"<tr>
												<td>".$Dati->fkProdotto."</td>
												<td>".$Dati->sconto." %</td>
												 
												</tr>";
										}
										echo "</table>";	
										echo "<a href=\"offerta/index.php\">Modifica</a>";
										
										
								
										
										
										echo"</td>
										<td width=\"33%\" align=\"center\">";
							//produttori 
											$query= "select * from produttore";
											$result= mysqli_query($conn,$query);
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
											
											while($Dati = mysqli_fetch_object($result))
											{
												echo"<tr>
													<td>".$Dati->idProduttore."</td>
													<td>".$Dati->nome."</td>
													<td>".$Dati->nTelefono."</td>
													</tr>";
											}
											echo "</table>";
											echo "<a href=\"produttore/index.php\">Modifica</a>";
										
										echo "</td>
									</tr>
									<tr>
										<td height=\"70%\" colspan=\"3\" width=\"100%\"  align=\"center\">"; 
										
										
										//prodotti
											echo "
												<table border=\"2\" width=\"80%\">
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
													<td><img src=\"prodotto/".$Dati->img."\" height=\"30\"/></td>
													<td>".$Dati->dataInserimento."</td>
													</tr>";
											}
											echo "</table>";		

											echo "<a href=\"prodotto/index.php\">Modifica</a>";
																		
																		
																		
										echo "</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>";
				}
			
		?>
	</body>
</html>

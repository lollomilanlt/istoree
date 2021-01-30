<html>

	<head>
		<title>Registrazione e Login</title>

	</head>

	<body>
		<?php

			$conn = mysql_connect("localhost","lorenzo","lorenzo");
			if(!$conn)
			{
				echo "Connessione fallita";
				exit;
			}
			
			$DB = mysql_select_db("mercato");
			if(!$DB)
			{
				echo "Selezione DB fallita";
				exit;
			}
			session_start();
									//session_destroy();

			
			if(!isset($_SESSION['user']))
			{
				echo "
				<table border=\"2\">
						<tr>
							<td valign=\"top\">
								<h4>Registrati</h4><br/>
								<form action=\"reg.php\" method=\"POST\">
									<table><tr>
										<td>
											inserisci Username <br/>
											inserisci Password	<br/>					
										</td>
										<td>
											<input type=\"text\" name=\"user\"/><br/>
											<input type=\"password\" name=\"pass\"/><br/>
										</td>
									</tr></table>
									<br/>
					
									<input type=\"submit\" value=\"INVIA\"/>
									<input type=\"reset\" value=\"ELIMINA\"/>
								</form>
							</td>
							<td valign=\"top\">
								<h4>Login</h4><br/>
								<form action=\"login.php\" method=\"POST\">
									<table><tr>
										<td>
											inserisci Username <br/>
											inserisci Password	<br/>					
										</td>
										<td>
											<input type=\"text\" name=\"user\"/><br/>
											<input type=\"password\" name=\"pass\"/><br/>
										</td>
									</tr></table>
									<br/>
					
									<input type=\"submit\" value=\"INVIA\"/>
									<input type=\"reset\" value=\"ELIMINA\"/>
								</form>
							</td>
						</tr>
				
					</table>
					";
			}
			else
			{
				$idUser=$_SESSION['user'];
				//messaggio di benvenuto al nome utente
		
				
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
				
				echo "<b>Bentornato ".$user." :) </b>";
				echo "
					<form action=\"logout.php\">
					<input type=\"submit\" value=\"Logout\"/>
					</form>
				";
				//inserire pulsante per il logout e creare la relativa pagina php. (usare il session_destroy)
			}	
			
		echo "<br/><br/><br/><br/>";
        
        $query= "select * from utente";
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
                    <th>User</th>
                    <th>Pass</th>
                </tr>
        ";
        
        while($Dati = mysql_fetch_object($result))
        {
            echo"<tr>
                <td>".$Dati->codiceUtente."</td>
                <td>".$Dati->username."</td>
                <td>".$Dati->password."</td>
                </tr>";
        }
        echo "</table>";
        
        mysql_close($conn);
    ?>
		
	
		



		

	</body>


</html>
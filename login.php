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
        
        $query= "select * from utente";
        $result= mysqli_query($conn,$query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
        

        $accesso=0;
        while($Dati = mysqli_fetch_object($result))
        {
			if(($_POST['user']==$Dati->username) && ($_POST['pass']==$Dati->password))	
			{
				$accesso=1;
				$userId=$Dati->codiceUtente;
				break;	
			}	       
        }
		
		if($accesso==1)
		{
			if($userId==1)
				$p="gestioneDB/index.php";
			else 
				$p="userPage/index.php";
			
			session_start();
			$_SESSION['user']=$userId; 
			header( "refresh:0;url=".$p);
		}
		else
		{
			echo "<div align=\"center\"><br/><b><h3>Login errato sarai rindirizzato alla pagina principale</h3></b>";
			echo "<br/><a href=\"index.php\"><h2>Clicca qui se non vuoi attendere oltre</h2></a></div>";
		
			header( "refresh:5;url=index.php");
		}

        
        mysqli_close($conn);
    ?>

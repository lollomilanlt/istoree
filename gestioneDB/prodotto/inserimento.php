<html>
    
    <head>
        <title>Invio</title>    
    </head>
        
    <body>
	
	<p align="center">
    <?php
		$id=-1;
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
	
	
	
		$query= "select * from prodotto";
        $result= mysqli_query($conn,$query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
		
		while($Dati = mysqli_fetch_object($result))
        {
            $id=$Dati->idProdotto;
        }
       

	
		
	
		define("UPLOAD_DIR","./images/");
		
		if(isset($_FILES['img']))
		{
			$file = $_FILES['img'];
			if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name']))
			{
				if($id==-1) 
					$id=0;
				$file['name'] = ($id+1).".".substr($file['type'],6);
				$img_p=$file['name'];
				move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$file['name']);
			}
		}
	
		
		$img_p="images/".$img_p;
	
	
	

        
        $query= "insert into prodotto(nome,versione,prezzo,lingua,fkProduttore,fkCategorie,img,dataInserimento) values ('".$_POST['nome']."','".$_POST['ver']."',".$_POST['prezzo'].",'".$_POST['lingua']."',".$_POST['prod'].",".$_POST['cat'].",'".$img_p."','".date('Y/m/d')."')";
        $result= mysqli_query($conn,$query);
        if(!$result)
        {
            echo "Query fallita";
            exit;
        }
		else
			echo "<b>Prodotto inserito correttamente!</b>";
		mysqli_close($conn);
		
		
		echo "<br/><i>sarai rindirizzato alla pagina principale tra 5 secondi</i>";
		echo "<br/><a href=\"index.php\"><u>Clicca qui se non vuoi attendere oltre</u></a>";
		
		header( "refresh:50;url=index.php");
		
	?> 
	</p>
	
	
	</body>
	
</html>
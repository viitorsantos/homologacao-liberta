<?Php

		include "include/conexao.php";
		include "include/config.php";
		include "include/funcoes.php";
		include "include/verifica_usuario.php";
		
		
		if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];

        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
        if(pg_num_rows($res_paciente) > 0){
             $nome           = pg_fetch_result($res_paciente, 0, 'nome');
            
        }
    }
	
		if(isset($_GET["atestado"])){
		$atestado = (int)$_GET["atestado"];
		$sql_atestado = "SELECT observacao FROM tbl_atestado 
						WHERE paciente_id= $paciente_id and empresa = ".EMPRESA." and atestado = $atestado";
		$res_atestado = pg_query($con, $sql_atestado);
		if(pg_num_rows($res_atestado) > 0){
             $observacao           = pg_fetch_result($res_atestado, 0, 'observacao');
		}
	}



?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	  <title></title>
</head>	

	
<style>
	
    div#interface{
    	margin: 0 auto;
    	padding: 0px;
    }
	img#logo{
		width: 70px;
		height: 70px;
	}
	div#cabecalho{
		font-family: arial, sans-serif;
    	font-size: 12pt;
    	text-transform: uppercase;
    	font-weight: bolder;
		margin-top: -50px;
		margin-left: 120px;
	}
	 span.resposta{
    	font-family: arial, sans-serif;
    	font-size: 11pt;
    	font-weight: normal;
	 }
	 div#atestado{
		 margin: 0 auto;
		 box-shadow: 0px 0px 5px black;
		 width: 500px;
		 height: 600px; 
		 padding: 10px;
	 }
	 h1{
		 text-align: center;
		 font-family: arial, sans-serif;
		 font-size: 15pt;
		 font-weight: bolder;  
		 
	 }
	 div#assinatura{
		font-family: arial, sans-serif;
    	font-size: 12pt;
		font-weight: bolder;
		margin-left: 50px;
	 }
</style>

<body>
	<div id="interface">
		<header id="cabecalho">
			<div><img src="images/logo3.png" id="logo"></div>
			<div id="cabecalho">Nome: <span class = "resposta"><?php echo $nome?></span><br><br>
			</div><br>
		</header>


		<section>
			<h1>Declaração</h1>
				<div id= "atestado">
					<span class = "resposta"><?php echo $observacao?></span> 
				</div><br><br><br>
				
				<div id = "assinatura">
				Assinatura: <span class = "resposta">_________________________________________________</span>
				</div>
		</section>
		
			
	</div>
</body>
</html>
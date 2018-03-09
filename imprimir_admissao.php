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
				 $crm            = pg_fetch_result($res_paciente, 0, 'crm');
            
        }
    }
	
		if(isset($_GET["admissao"])){
		$admissao = (int)$_GET["admissao"];
		$sql_admissao = "SELECT observacao FROM tbl_admissao 
						WHERE paciente_id= $paciente_id and empresa_id = ".EMPRESA." and admissao = $admissao";
		$res_admissao = pg_query($con, $sql_admissao);
		if(pg_num_rows($res_admissao) > 0){
             $observacao           = pg_fetch_result($res_admissao, 0, 'observacao');
		}
	}

	if(isset($_GET['funcionario'])){
			$funcionario_id = (int)$_GET['funcionario'];

			$sql_funcionario = "select * from tbl_funcionario where funcionario = $funcionario_id  ";
			$res_funcionario = pg_query($con, $sql_funcionario);
			if(pg_num_rows($res_funcionario) > 0){
				 $funcionario_id     = pg_fetch_result($res_funcionario, 0, 'funcionario');
				 $nome_funcionario   = pg_fetch_result($res_funcionario, 0, 'nome');
				 
			}      
		}

?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
<link href="css/imprimi.css" rel="stylesheet">
		<script>
			function imprime(text){
				text=document
				print(text)
			}
			function voltei(text){
				text=documet
				voltar(text)
			}
		</script>
		<meta charset="UTF-8">
	  <title></title>
</head>	

	
<style>
	
    div#interface{
    	margin: 0 auto;
    	padding: 0px;
		margin-top:120px;
		
	}
	header#cabecalho{
		border-bottom:  2px solid black;
	}
	figure img#logo{
		width: 100px;
		height: 100px;
		float:right;
		margin-top:-100px;
		margin-right: 50px;
	}
	div#cabecalho{
		font-family: arial, sans-serif;
    	font-size: 12pt;
    	text-transform: uppercase;
    	font-weight: bolder;
		margin-left:70px;
		padding:10px;
	}
	p#cabecalho_direita{
		text-align:right;
		font-family: arial, sans-serif;
		font-size:10pt;
		margin-right: 60px;
		padding-bottom:5px;
	}
	 p#cabecalho_esquerda{
		text-align:left;
		font-family: arial, sans-serif;
		font-size:10pt;
		margin-left: 40px;
		margin-top: -50px;
	}
	 p#cabecalho_esquerda span#cabecalho{
		text-align:left;
		font-family: arial, sans-serif;
		font-size:20pt;
		
	}
	 span.resposta{
    	font-family: arial, sans-serif;
    	font-size: 11pt;
    	font-weight: normal;
	 }
	 div#atestado{
		 margin: 0 auto;
		 box-shadow: 0px 0px 5px black;
		 width: 600px;
		 height: 500px; 
		 padding: 10px;
	 }
	 h1{
		 text-align: center;
		 font-family: arial, sans-serif;
		 font-size: 15pt;
		 font-weight: bolder;  
		 
	 }
	 div#data{ 
		font-family: arial, sans-serif;
    	font-size: 11pt;
		margin-left: 50px;
	 }
	 div#assinatura{
		text-align:right;
		margin-right:70px;
	 }
	 div#assinatura span#assinatura{
		font-family: arial, sans-serif;
		font-size:10pt;
		margin-right:70px;
	 }
	 div.botao{
		margin-left:150px;
	 }
</style>

<body>
	<div id="interface">
		<header id="cabecalho">
			<figure><img src="<?php echo LOGO ?>" id="logo"></figure>
			<p id="cabecalho_direita"><?php echo ENDERECO ?> <br> Marília - SP</p>
			<p id="cabecalho_esquerda"><span id="cabecalho"><?php echo $nome_funcionario;?></span><br>
			Telefones: <?php echo TELEFONE ?></p>
				
		</header>
		
		<hgroup>
	       <div id="cabecalho">Paciente: <span class = "resposta"><?php echo $nome?></span><br><br></div>
	    </hgroup>

		<section>
			<h1>Admissão</h1>
				<div id= "atestado">
					<span class = "resposta"><?php echo $observacao?></span> 
				</div><br><br>
				
				
				<div id = "data">
				  Marília, <?= date("d")?> de <?=Mes(date("m"))?> de <?=date("Y")?>
				</div><br><br>
				<div id = "assinatura">
				  ____________________________<br>
				 <span id="assinatura"> Ass. Responsável </span>
				</div>
				<br>
		</section>
		
		<div class="botao">
					<input class="button btn_1" href="imprimir_admissao.php?paciente=<?php echo $paciente_id?>"  value="Imprimir" onclick="imprime()">
					<a href="cadastro_admissao.php?paciente=<?php echo $paciente_id?>&admissao=<?php echo $admissao_id?>&funcionario=<?php echo $_funcionario_id?>" class="btn_2">Voltar</a>
                </div>
			
	</div>
</body>
</html>
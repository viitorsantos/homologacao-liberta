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
	
	
	 if(isset($_GET["encaminhamento"])){
        $encaminhamento = (int)$_GET["encaminhamento"];
        $sql_encaminhamento = "SELECT profissional_id, observacao FROM tbl_encaminhamento 
                        WHERE paciente_id= $paciente_id and encaminhamento = $encaminhamento";
        $res_encaminhamento = pg_query($con, $sql_encaminhamento);
        if(pg_num_rows($res_encaminhamento) > 0){
             $observacao           = pg_fetch_result($res_encaminhamento, 0, 'observacao');
			 $profissional_id      = pg_fetch_result($res_encaminhamento, 0, 'profissional_id');
        }	
    }
	
	$sql_nome ="SELECT tbl_profissional.nome FROM tbl_profissional
						inner join tbl_encaminhamento on tbl_encaminhamento.profissional_id = tbl_profissional.profissional where profissional_id = '$profissional_id'";
						$res_nome = pg_query($con, $sql_nome);
						$nome_profissional    = pg_fetch_result($res_nome, 0, 'nome');
 
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
	  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
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
		margin-right:80px;
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
			<p id="cabecalho_esquerda"><span id="cabecalho">Jose Roberto Otoboni</span><br>
			Telefones: <?php echo TELEFONE ?></p>
		</header>
		
		
		<hgroup>
	       <div id="cabecalho">Paciente: <span class = "resposta"><?php echo $nome?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Profissional : <span class = "resposta"><?php echo $nome_profissional?></span><br><br>
		   </div>
		 
	    </hgroup>
		
	
		<section>
			<h1>Encaminhamento</h1>
				<div id= "atestado">
					<span class = "resposta"><?php echo $observacao?></span> 
				</div><br><br>
				
				
				<div id = "data">
				  Marília, ____de ______________ de ______
				</div><br><br>
				<div id = "assinatura">
				  _________________________<br>
				 <span id="assinatura"> Jose Roberto Otoboni </span>
				</div>
				<br>
		</section>
		
			
	</div>
	<div class="botao">
					<input class="button btn_1" href="imprimir_encaminhamento.php?paciente=<?php echo $paciente_id?>"  value="Imprimir" onclick="imprime()">
					<a href="encaminhamento.php?paciente=<?php echo $paciente_id?>" class="btn_2">Voltar</a>
    </div>
</body>

<?Php

		//include "include/conexao.php";
		include "include/config.php";
		include "include/funcoes.php";
		//include "include/verifica_usuario.php";
		
		
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
    	width: 900px;
    }
    #logo{
    	float: left;
    	width: 150px;
    	height: 100px;
    }
	img#logo{
		width: 100px;
		height: 100px;
	}
	#cabecalho{
		float: left;
		font-family: arial, sans-serif;
		text-align: center;		
		width: 600px;
		padding-top: 30px;
	}
	.nome_relatorio{
		font-size: 25px;
	}
	#data_emissao{
		padding-top: 50px;
		float: left;
		width: 150px;
		font-size: 10px;
	}
	#clear{
		clear:both;
		height: 10px;
	}
	#table{
		width: 900px;
		border-top: 1px solid #000000;
	}
	#table th {
		text-transform: uppercase;
		font-size: 12px;
		font-family: tahoma;
	}
	#table td {		
		font-size: 11px;
		font-family: tahoma;
		text-align: center;
		border-bottom: 1px solid #f8f8f8;
	}
</style>

<body>
	<div id="interface">
		<header>
			<div id="logo">
				<img src="images/logo3.png" id="logo">
			</div>
			<div id="cabecalho">				
				<div class="nome_relatorio">Nome do Relatório</div>
				<div class="filtro_relatorio">
					Filtro da Pesquisa
				</div>

			</div>
			<div id='data_emissao'>
				<div class="data"><?php echo date("d/m/Y")?></div>
				<div class="hora"><?php echo date("H:i")?></div>
			</div>
			<div id="clear"></div>
		</header>
		<section>
			<table id="table">
				<tr>
					<th>#</th>
					<th>coluna</th>
					<th>coluna</th>
					<th>coluna</th>
					<th>coluna</th>
				</tr>
				<tr>
					<td>1</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
				</tr>
				<tr>
					<td>1</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
				</tr>
				<tr>
					<td>1</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
				</tr>
				<tr>
					<td>1</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
				</tr>
				<tr>
					<td>1</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
				</tr>
				<tr>
					<td>1</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
					<td>dados</td>
				</tr>
			</table>
		</section>			
	</div>
</body>
</html>
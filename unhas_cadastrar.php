<?php
	include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
	if(isset($_POST["btnacao"])){
		$unhas_id		= fncTrataDados($_POST["unhas_id"]);
		$pe_direito_1	= fncTrataDados($_POST["pe_dereito_1"]);
		$pe_direito_2	= fncTrataDados($_POST["pe_dereito_2"]);
		$pe_direito_3	= fncTrataDados($_POST["pe_dereito_3"]);
		$pe_direito_4	= fncTrataDados($_POST["pe_dereito_4"]);
		$pe_direito_5	= fncTrataDados($_POST["pe_dereito_5"]);
		$pe_esquerdo_1	= fncTrataDados($_POST["pe_esquerdo_1"]);
		$pe_esquerdo_2	= fncTrataDados($_POST["pe_esquerdo_2"]);
		$pe_esquerdo_3	= fncTrataDados($_POST["pe_esquerdo_3"]);
		$pe_esquerdo_4	= fncTrataDados($_POST["pe_esquerdo_4"]);
		$pe_esquerdo_5	= fncTrataDados($_POST["pe_esquerdo_5"]);
		$paciente_id	= (int)$_POST["paciente_id"];
		$empresa_id		= EMPRESA;
		
		if(strlen(trim($pe_direito_1)) == 0){
            $erro .="O campo pe_dereito_1 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_direito_2)) == 0){
            $erro .="O campo pe_dereito_2 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_direito_3)) == 0){
            $erro .="O campo pe_dereito_3 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_direito_4)) == 0){
            $erro .="O campo pe_dereito_4 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_direito_5)) == 0){
            $erro .="O campo pe_dereito_5 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_esquerdo_1)) == 0){
            $erro .="O campo pe_esquerdo_1 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_esquerdo_2)) == 0){
            $erro .="O campo pe_esquerdo_2 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_esquerdo_3)) == 0){
            $erro .="O campo pe_esquerdo_3 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_esquerdo_4)) == 0){
            $erro .="O campo pe_esquerdo_4 deve ser preenchido.<br>";
        }
		if(strlen(trim($pe_esquerdo_5)) == 0){
            $erro .="O campo pe_esquerdo_5 deve ser preenchido.<br>";				
        }
		
		if(empty($erro)){
			if($unhas_id == 0){
				$sql_unhas = "INSERT INTO tbl_unhas(pe_dereito_1, pe_dereito_2, pe_dereito_3, pe_dereito_4,
				pe_dereito_5, pe_esquerdo_1, pe_esquerdo_2, pe_esquerdo_3, pe_esquerdo_4, pe_esquerdo_5,
				paciente_id, empresa_id)
				VALUES('$pe_direito_1', '$pe_direito_2', '$pe_direito_3', '$pe_direito_4', '$pe_direito_5',
				'$pe_esquerdo_1', '$pe_esquerdo_2', '$pe_esquerdo_3', '$pe_esquerdo_4', '$pe_esquerdo_5',
				'$paciente_id', $empresa_id )";
			}else{
				$sql_unhas = "UPDATE tbl_unhas SET pe_dereito_1 = '$pe_direito_1', pe_dereito_2 = '$pe_direito_2',
				pe_dereito_3 = '$pe_direito_3', pe_dereito_4 = '$pe_direito_4', pe_dereito_5 = '$pe_direito_5',
				pe_esquerdo_1 = '$pe_esquerdo_1', pe_esquerdo_2 = '$pe_esquerdo_2', pe_esquerdo_3 = '$pe_esquerdo_3', 
				pe_esquerdo_4 = '$pe_esquerdo_4', pe_esquerdo_5 = '$pe_esquerdo_5', paciente_id = '$paciente_id'
				WHERE empresa_id = $empresa_id AND unhas = '$unhas_id'";
			}
		
			$res = pg_query($con, $sql_unhas);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
			}
		}
	}	
	if(isset($_GET["paciente"])){
		$paciente_id = (int)$_GET["paciente"];
		
		$sql_unhas = "SELECT * FROM tbl_unhas WHERE paciente_id = $paciente_id";
		$res_unhas = pg_query($con, $sql_unhas);
		if(pg_num_rows($res_unhas) > 0){
			$pe_direito_1	= pg_fetch_result($res_unhas, 0, 'pe_dereito_1');
			$pe_direito_2	= pg_fetch_result($res_unhas, 0, 'pe_dereito_2');
			$pe_direito_3	= pg_fetch_result($res_unhas, 0, 'pe_dereito_3');
			$pe_direito_4	= pg_fetch_result($res_unhas, 0, 'pe_dereito_4');
			$pe_direito_5	= pg_fetch_result($res_unhas, 0, 'pe_dereito_5');
			$pe_esquerdo_1	= pg_fetch_result($res_unhas, 0, 'pe_esquerdo_1');
			$pe_esquerdo_2	= pg_fetch_result($res_unhas, 0, 'pe_esquerdo_2');
			$pe_esquerdo_3	= pg_fetch_result($res_unhas, 0, 'pe_esquerdo_3');
			$pe_esquerdo_4	= pg_fetch_result($res_unhas, 0, 'pe_esquerdo_4');
			$pe_esquerdo_5	= pg_fetch_result($res_unhas, 0, 'pe_esquerdo_5');
			$unhas_id		= pg_fetch_result($res_unhas, 0, 'unhas');
			$empresa_id		= pg_fetch_result($res_unhas, 0, 'empresa_id');
		}			
	}
	
	/*if(isset($_GET["excluir"])){
		$unhas = (int)$_GET["excluir"];
		
		$sql_unhas = "DELETE FROM tbl_unhas WHERE unhas = $unhas_id";
		$res_unhas = pg_query($con, $sql_unhas);
		
		if(strlen(trim(pg_last_error($con))) == 0 AND empty($erro)){
			$ok .="Tipo de unha exclu�da com sucesso.";
		}else{
			$erro .="Falha ao excluir o tipo de unha. <br> Consulte o administrador do sistema.";
		}
	}*/
?>

<!DOCTYPE HTML>
<html lang="PT-BR">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo AUTOR ?>">
        <meta charset="UTF-8">
		<title><?php echo TITLE_ADMIN ?></title>
        <link href="<?php echo RAIZ ?>/css/bootstrap.css" rel="stylesheet">
		<link rel="shortcut icon" href="<?php echo RAIZ?>/images/<?php echo LOGO_FAVICON ?>" type="image/x-icon" />
        <link href="<?php echo RAIZ ?>css/dashboard.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->		
        <script src="include/funcoes.js"></script>
        <script src="js/script.js" ></script>
	</head>
	
	<body>
		<div class="container">
			<div class="container-fluid">
				<div class="row">
					<?php include RAIZ."include/cabecalho.php" ?>
					<div class="col-md-2">
						<?php include RAIZ."include/menu_admin.php" ?>
					</div>
					<div class="col-md-10 corpo">
						<div class="page-header">
							<div class="col-md-10 titulo_tela"> Tipo de Unhas </div>
							<div class="col-md-1 link_tela">
                                <a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-info btn-sm"><i class="fa fa-list-alt"></i>Paciente</a>     
                            </div>
						</div>	
						<?php
							if(strlen(trim($erro)) > 0){
								?>
								<div class="alert alert-danger">
								<i class="icon-remove-sign"></i>
								<?php
								echo $erro;
								?>
								</div>
								<?php
							}
							if(strlen(trim($ok)) > 0){
								?>
								<div class="alert alert-success">
								<i class="icon-ok"></i>
								<?php
								echo $ok;
								?>
								</div>
								<?php
							}
						?>
							
						<div class="conteudo">
							<div class="col-md-12" id="home">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-4">
										<img src="images/img_tipoUnhas.png" width="580" alt="">
									</div>
								</div>
								<div class="row">
									<div class="col-md-10"><br><br></div>
								</div>
								
								<form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="">
									<div class="row">
										<div class="form-group">
											<div class="col-md-2"></div>
											<label for="formGroup" class="col-md-2 control-label">Artelhos</label>
											<div class="row>">
												<div class="col-md-1">
													<center><label>1º</label></center>
												</div>
											</div>
											<div class="row>">
												<div class="col-md-1">
													<center><label>2º</label></center>
												</div>
											</div>
											<div class="row>">
												<div class="col-md-1">
													<center><label>3º</label></center>
												</div>
											</div>
											<div class="row>">
												<div class="col-md-1">
													<center><label>4º</label></center>
												</div>
											</div>
											<div class="row>">
												<div class="col-md-1">
													<center><label>5º</label></center>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-2"></div>
										<label for="formGroup" class="col-md-2 control-label">Pé Direito</label>
										<div class="row">
											<div class="col-md-1">
												<input type="text" name="pe_dereito_1" size="1" maxlength="2" value="<?php echo "$pe_direito_1";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_dereito_2" size="1" maxlength="2" value="<?php echo "$pe_direito_2";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_dereito_3" size="1" maxlength="2" value="<?php echo "$pe_direito_3";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_dereito_4" size="1" maxlength="2" value="<?php echo "$pe_direito_4";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_dereito_5" size="1" maxlength="2" value="<?php echo "$pe_direito_5";?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-2"></div>
										<label for="formGroup" class="col-md-2 control-label">Pé Esquerdo</label>
										<div class="row">
											<div class="col-md-1">
												<input type="text" name="pe_esquerdo_1" size="1" maxlength="2" value="<?php echo "$pe_esquerdo_1";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_esquerdo_2" size="1" maxlength="2" value="<?php echo "$pe_esquerdo_2";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_esquerdo_3" size="1" maxlength="2" value="<?php echo "$pe_esquerdo_3";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_esquerdo_4" size="1" maxlength="2" value="<?php echo "$pe_esquerdo_4";?>">
											</div>
											<div class="col-md-1">
												<input type="text" name="pe_esquerdo_5" size="1" maxlength="2" value="<?php echo "$pe_esquerdo_5";?>">
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12 botao">
											<input class="btn btn-info" type="submit" name="btnacao" value="Gravar">
											<input type="hidden" name="paciente_id" value="<?php echo $paciente_id ?>">
											<input type="hidden" name="unhas_id" value="<?php echo $unhas_id ?>">
										</div>
									</div>										
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<?php include RAIZ."include/footer.php" ?>
					</div>
				</div>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
		</div>
	</body>
</html>
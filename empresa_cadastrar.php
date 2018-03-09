<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
	if(isset($_POST["btnacao"])){
		$descricao		= fncTrataDados($_POST["descricao"]);
		$clinica_id		= (int)$_POST["clinica_id"];
		$rz_social		= fncTrataDados($_POST["rz_social"]);
		$cnpj			= fncTrataDados($_POST["cnpj"]);
		$cep			= fncTrataDados($_POST["cep"]);
		$end			= fncTrataDados($_POST["end"]);
		$complemento	= fncTrataDados($_POST["complemento"]);
		$num			= fncTrataDados($_POST["num"]);
		$bairro			= fncTrataDados($_POST["bairro"]);
		$cidade_id  	= fncTrataDados($_POST["cidade_id"]);
		$ddd_tel		= fncTrataDados($_POST["ddd_tel"]);
		$tel_res		= fncTrataDados($_POST["tel_res"]);
		$ddd_cel		= fncTrataDados($_POST["ddd_cel"]);
		$celular		= fncTrataDados($_POST["celular"]);
		$site			= fncTrataDados($_POST["site"]);
		$empresa_id		= (int)$_POST["empresa_id"];
		
		$retirar = array(".", "-", ",", "*", "/", "_");
		
		$cpf = str_replace($retirar, "", $cpf);		
		$rg = str_replace($retirar, "", $rg);
		$telefone = str_replace($retirar, "", $telefone);
		$celular = str_replace($retirar, "", $celular);		
		$cep = str_replace($retirar, "", $cep);
		$data_nasc2 = str_replace($retirar, "", $data_nasc);	

		if(strlen(trim($descricao)) == 0){
			$erro .= "O campo Descrição deve ser preenchido.<br>";
		}
		if(strlen(trim($cnpj)) == 0){
			$erro .= "O campo CNPJ deve ser preenchido.<br>";
		}
		if($clinica_id == 0){
			$erro .= "O campo Tipo de Clínica deve ser preenchido.<br>";
		}
		if($cidade_id == 0){
			$erro .= "O campo Cidade deve ser preenchido.<br>";
		}

		// Verifica se a empressa já foi cadastrada.
		if($empresa_id == 0){
			$sql = "SELECT descricao, cnpj FROM tbl_empresa WHERE descricao = '$descricao' or cnpj = '$cnpj'";
			$res = pg_query($con, $sql);
			if(pg_num_rows($res) > 0){
				$erro .="Descricao ou CNPJ já cadastrado.";
			}
		}
		
		if(empty($erro)){
			if($empresa_id == 0){
				$sql = "INSERT INTO tbl_empresa (descricao, razao_social, tipo_clinica_id, cnpj, endereco, numero,
				cep, ddd1, telefone1, ddd2, celular, site, bairro, cidade_id, complemento)
				VALUES('$descricao', '$rz_social', '$clinica_id', '$cnpj', '$end', '$num', '$cep', '$ddd_tel',
				'$tel_res', '$ddd_cel', '$celular', '$site', '$bairro', '$cidade_id', '$complemento')";
			}else{
				$sql = "UPDATE tbl_empresa SET descricao = '$descricao', razao_social = '$rz_social',
				tipo_clinica_id = '$clinica_id', cnpj = '$cnpj', endereco = '$end', numero = '$num', cep = '$cep',
				ddd1 = '$ddd', telefone1 = '$tel_res', ddd2 = '$ddd_cel', celular = '$celular', site = '$site',
				bairro = '$bairro', cidade_id = '$cidade_id', complemento = '$complemento' WHERE empresa = $empresa_id";
			}
			$res = pg_query($con, $sql);
			if(strlen(trim(pg_last_error($con))) == 0 AND empty($erro)){
				$ok .= "Cadastro Realizado com Sucesso.";
			}
		}			
	}
	
	if(isset($_GET['empresa'])){
		$empresa_id = (int)$_GET['empresa'];
		
		$sql_empresa = "SELECT * FROM tbl_empresa WHERE empresa = $empresa_id";
		$res_empresa = pg_query($con, $sql_empresa);
		
		$descricao		= pg_fetch_result($res_empresa, 0, 'descricao');
		$tipo_clinica_id		= pg_fetch_result($res_empresa, 0, 'tipo_clinica_id');
		$rz_social		= pg_fetch_result($res_empresa, 0, 'razao_social');
		$cnpj			= pg_fetch_result($res_empresa, 0, 'cnpj');
		$cep			= pg_fetch_result($res_empresa, 0, 'cep');
		$end			= pg_fetch_result($res_empresa, 0, 'endereco');
		$complemento	= pg_fetch_result($res_empresa, 0, 'complemento');
		$num			= pg_fetch_result($res_empresa, 0, 'numero');
        $bairro         = pg_fetch_result($res_empresa, 0, 'bairro');
		$cidade_id      = pg_fetch_result($res_empresa, 0, 'cidade_id');
		$ddd_tel		= pg_fetch_result($res_empresa, 0, 'ddd1');
		$tel_res		= pg_fetch_result($res_empresa, 0, 'telefone1');
		$ddd_cel		= pg_fetch_result($res_empresa, 0, 'ddd2');
		$celular		= pg_fetch_result($res_empresa, 0, 'celular');
		$site			= pg_fetch_result($res_empresa, 0, 'site');
		$empresa_id		= pg_fetch_result($res_empresa, 0, 'empresa');

	}
	
	if(isset($_GET['excluir'])){
		$empresa = (int)$_GET['excluir'];
		$sql = "DELETE FROM tbl_empresa WHERE empresa = $empresa";
		$res = pg_query($con, $sql);
		
		if(strlen(trim(pg_last_error($con))) == 0 AND empty($erro)){
			$ok.= "Empresa excluída com Sucesso.";
		}else{
			$erro .= "Falha ao excluir a empresa selecionada.<br> Consulte o Adinistrador do Sistema.";
		}
	}	
?>
<!DOCTYPE html>
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
                    <div class="col-md-10 corpo" >
                        <div class="page-header">
                            <div class=" col-md-10 titulo_tela" >Empresa</div>
                            <div class="col-md-2 link_tela">
                                <!--<a href="empresa_pesquisar.php" class="btn btn-info btn-sm"><i class="fa fa-list-alt"></i>Pesquisa</a>-->
                            </div>
                        </div>
						<?php
							if(strlen(trim($erro)) > 0){
						?>
							<div class="alert alert-danger">
							<i class="icon-remove-sign"></i>
						<?php
							echo $erro
						?>
							</div>
						<?php 
							}
							if(strlen(trim($ok)) > 0){
						?>
							<div class="alert alert-success">
							<i class="icom-ok"></i>
						<?php
							echo $ok
						?>
							</div>
						<?php
							}
						?>
                        <div class="conteudo">
                            <div class="col-md-12" id="home">
								<form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="">
									<div id="funcionario_2">
                                        <div class='row'>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Descrição</label>
                                                    <input type="text" name="descricao" value="<?php echo $descricao ?>" class="form-control" id="exampleInputEmail1" placeholder="Descrição">
                                                </div>
                                            </div>
											<div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tipo de Clínica</label>
                                                    <select name="clinica_id" class="form-control">
														<option value="">Tipo de Clínica</option>       
														<?php 
															$sql_tipo_clinica = "SELECT tipo_clinica, descricao FROM tbl_tipo_clinica ";
															$res_tipo_clinica = pg_query($con, $sql_tipo_clinica);
															for($i =0; $i<pg_num_rows($res_tipo_clinica); $i++){
																$tipo_clinica = pg_fetch_result($res_tipo_clinica, $i, 'tipo_clinica');
																$descricao  = pg_fetch_result($res_tipo_clinica, $i, 'descricao');

																	if($tipo_clinica_id == $tipo_clinica){
																		$selected = " selected ";
																	}else{
																		$selected = " ";
																	}
																	echo "<option value='$tipo_clinica' $selected >$descricao</option>";
															}
														?>
													</select>
                                                </div>
                                            </div>
											
                                        </div>
                                        <div class='row'>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Razão Social</label>
                                                    <input type="text" name="rz_social" value="<?php echo $rz_social?>" class="form-control" id="exampleInputEmail1" placeholder="Razão Social">
                                                </div>
                                            </div>
											<div class="col-md-4">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">CNPJ</label>
                                                    <input type="text" name="cnpj" value="<?php echo $cnpj?>" class="form-control" maxlength="14" id="exampleInputEmail1" placeholder="CNPJ">
                                                </div>
                                            </div>
										</div>
										<div class="row">																			
											<div class="col-md-2">
												<div class="form-group">
													<label  for="exampleInputEmail1">CEP</label>
													<input type="text" name="cep" id="cep" value="<?php echo $cep ?>" class="form-control" placeholder="CEP">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-7">
												<div class="form-group">
													<label for="exampleInputEmail1">Endereço</label>
													<input type="text" name="end" id="rua" value="<?php echo $end ?>" class="form-control" placeholder="Endereço">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label  for="exampleInputEmail1">Complemento</label>
													<input type="text" name="complemento" value="<?php echo $complemento ?>" maxlength="20" class="form-control">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<div class="form-group">
													<label  for="exampleInputEmail1">Número</label>
													<input type="text" name="num" value="<?php echo $num ?>" maxlength='4' class="form-control" placeholder="Nº">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label for="exampleInputEmail1">Bairro</label>
													<input type="text" name="bairro" value="<?php echo $descricao ?>" class="form-control" id="exampleInputEmail1" placeholder="Bairro">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label  for="exampleInputEmail1">Cidade</label>
													<select name="cidade_id" class="form-control">
														<option value="">Cidade</option>       
														<?php 
															$sql_cidade = "SELECT cidade, descricao, estado FROM tbl_cidade ";
															$res_cidade = pg_query($con, $sql_cidade);
															for($i =0; $i<pg_num_rows($res_cidade); $i++){
																$cidade     = pg_fetch_result($res_cidade, $i, 'cidade');
																$estado     = pg_fetch_result($res_cidade, $i, 'estado');
																$descricao  = pg_fetch_result($res_cidade, $i, 'descricao');

																	if($cidade_id == $cidade){
																		$selected = " selected ";
																	}else{
																		$selected = " ";
																	}
																	echo "<option value='$cidade' $selected >$descricao-$estado</option>";
															}
														?>
													</select>
												</div>
											</div>	
										</div>
										<div class="row">
											<div class="col-md-1">
												<div class="form-group">
													<label  for="exampleInputEmail1">DDD</label>
													<input type="text" name="ddd_cel" value="<?php echo $ddd_cel ?>" class="form-control" placeholder="DDD">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label  for="exampleInputEmail1">Telefone</label>
													<input type="text" name="tel_res" value="<?php echo $tel_res ?>" class="form-control" placeholder="Telefone">
												</div>
											</div>
											<div class="col-md-1">
												<div class="form-group">
													<label  for="exampleInputEmail1">DDD</label>
													<input type="text" name="ddd_cel" value="<?php echo $ddd_cel ?>" class="form-control" placeholder="DDD">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label  for="exampleInputEmail1">Celular</label>
													<input type="text" name="celular" value="<?php echo $celular ?>" class="form-control" placeholder="Celular">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleInputEmail1">Site</label>
													<input type="text" name="site" value="<?php echo $site ?>" class="form-control" placeholder="Site">
												</div>
											</div>
										</div>
                                    </div>
									<div class="row">
										<div class="col-md-12 botao">
											<input class="btn btn-info" type="submit" name="btnacao" value="Gravar">
											<input type="hidden" name="empresa_id" value="<?php echo $empresa_id ?>">
										</div>
									</div>
								</form>
								   
								   

                            </div>
                       </div>
                    </div>
                </div>
                <div class="row">
                    <?php include RAIZ."include/footer.php" ?>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>
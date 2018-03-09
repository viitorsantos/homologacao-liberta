<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
	if(isset($_POST['btnacao'])){
		$dia		= fncTrataDados($_POST["dia"]);
		$mes		= fncTrataDados($_POST["mes"]);
		$ano		= fncTrataDados($_POST["ano"]);
		$descricao 	= fncTrataDados($_POST["descricao"]);
		$feriado_id	= fncTrataDados($_POST["feriado_id"]);
		
		$ano = (empty($ano))? date("Y") : $ano;
		
		if(strlen(trim($dia)) == 0){
			$erro .= "O campo Dia deve ser preenchido.<br>";
		}
		if(strlen(trim($mes)) == 0){
			$erro .=" O campo  Mês deve ser preenchido.<br>";
		}
		if(strlen(trim($descricao)) == 0){
			$erro .=" O campo Descrição deve ser preenchido.<br>";
		}
		
		if($feriado_id == 0){
			$sql = "SELECT dia, mes, ano FROM tbl_feriado WHERE dia = '$dia' and mes = '$mes' and ano = '$ano'";
			$res = pg_query($con, $sql);
			if(pg_num_rows($res)> 0){
				$erro .="Dia e Mês já cadastrado.";
			}
		}
		
		if(empty($erro)){
			if($feriado_id == 0){
				$sql = "INSERT INTO tbl_feriado (dia, mes, ano, descricao)
				VALUES ('$dia', '$mes', '$ano', '$descricao')";
			}else{
				$sql = "UPDATE tbl_feriado SET dia = '$dia', mes = '$mes', ano = '$ano', descricao = '$descricao' WHERE feriado = $feriado_id";
			}
			$res = pg_query($con, $sql);
			if(strlen(trim(pg_last_error($con))) == 0 AND empty($erro)){
				$ok .= "Cadastro realizado com sucesso.";
			}
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
                            <div class=" col-md-10 titulo_tela" >Feriado</div>
                            <!--<div class="col-md-2 link_tela">
                                <a href="feriado_pesquisa.php" class="btn btn-info btn-sm"><i class="fa fa-list-alt"></i>Pesquisa</a>		
                            </div>-->
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
									<div class="row">
										<div class="col-md-1 col-md-offset-4">
											<div class="form-group">
												<label for="exampleInputEmail1">Dia*</label>
												 <input type="text" name="dia" value="<?php echo $dia ?>" class="form-control" id="exampleInputEmail1" placeholder="Dia" maxlength="2">
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label for="exampleInputEmail1">Mês*</label>
												 <input type="text" name="mes" value="<?php echo $mes ?>" class="form-control" id="exampleInputEmail1" placeholder="Mês" maxlength="2">
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label for="exampleInputEmail1">Ano</label>
												 <input type="text" name="ano" value="<?php echo $ano ?>" class="form-control" id="exampleInputEmail1" placeholder="Ano" maxlength="4">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="row">
											<div class="col-md-4 col-md-offset-4">
												<div class="form-group">
													<label for="exampleInputEmail1">Descrição*</label>
													<input type="text" name="descricao" value="<?php echo $descricao ?>" class="form-control" id="exampleInputEmail1" placeholder="Descrição">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 botao">
										<input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
										<input type="hidden" name="paciente_id" value="<?php echo $paciente_id ?>">
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
<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";

	if(isset($_POST["btnacao"])){
		$senha_bco	= fncTrataDados($_POST["senha"]);
		$senha_nova	= fncTrataDados($_POST["n_senha"]);
		$confirme_s	= fncTrataDados($_POST["confirme_s"]); 
		
		
		if(strlen(trim($senha_bco)) == 0){
			$erro .= "O campo Senha deve ser preenchido";
		}
		if(strlen(trim($senha_nova)) == 0){
			$erro .= "O campo Nova Senha deve ser preenchido. <br>";
		}
		if(strlen(trim($confirme_s)) == 0){
			$erro .= "O campo Confirme sua Senha deve ser preenchido. <br>";
		}		
		if($senha_nova != $confirme_s){
			$erro .="Os campos Nova Senha e Confirmar Nova Senha estão diferentes. <br>";			
		}

		
		
        $sql_verifica_senha = "SELECT senha FROM tbl_usuario WHERE senha = '$senha_bco' and usuario = ".(int)$_SESSION['usuario'];
        $res_verifica_senha = pg_query($con, $sql_verifica_senha);
        if(pg_num_rows($res_verifica_senha)==0){
            $erro .= "A senha atual esta incorreta. <br>";
        }
			
	
	
		
		if(strlen(trim($erro))==0){
				$sql = "UPDATE tbl_usuario SET senha = '$senha_nova' WHERE usuario = ".(int)$_SESSION['usuario'];
				$res = pg_query($con, $sql);
				if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
					$ok .= "Cadastro Realizado com Sucesso.";
				}	
		}else{
				echo  pg_last_error();
				$erro .= "Voce não pode alterar a senha";
			}
					
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo AUTOR ?>">
        <meta charset="UTF-8">
       <title><?php echo TITLE_ADMIN ?></title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo RAIZ ?>/css/bootstrap.css" rel="stylesheet">
		<link rel="shortcut icon" href="<?php echo RAIZ?>/images/<?php echo LOGO_FAVICON ?>" type="image/x-icon" />
        <!-- Custom styles for this template -->
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
                    <div class="col-md-10 corpo" >
                        <div class="page-header">
                            <div class=" col-md-10 titulo_tela" >Alterar Senha</div>
                            <!--<div class="col-md-2 link_tela">
                                <a href="cliente_pesquisa.php" class="btn btn-info btn-sm"><i class="fa fa-list-alt"></i>Pesquisa</a>		
                            </div>-->
                        </div>
                        <?php if (strlen(trim($erro)) > 0): ?>
                            <div class="alert alert-danger">
                                <i class="icon-remove-sign"></i>
                                <?php echo utf8_encode($erro) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (strlen(trim($ok)) > 0): ?>
                            <div class="alert alert-success">
                                <i class="icon-ok"></i>
                                <?php echo utf8_encode($ok) ?>
                            </div>
                        <?php endif; ?>
                        <div class="conteudo">
                            <div class="col-md-12" id="home">
                                   
							<form action="" method="POST">		   
								<div class='row'>
                                    <div class="col-md-offset-4 col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Senha</label>
                                            <input type="password" name="senha" value="<?php echo $senha_bco?>" class="form-control" id="exampleInputEmail1" placeholder="Digite senha atual">
                                        </div>
                                    </div>
                                </div>
									
								<div class='row'>
                                    <div class="col-md-offset-4 col-md-4">
                                        <div class="form-group">
											<label for="exampleInputEmail1">Senha Nova</label>
                                            <input type="password" name="n_senha" value="<?php echo $senha_nova?>" class="form-control" id="exampleInputEmail1" placeholder="Digite a nova senha">
                                        </div>
                                    </div>
                                </div>
									
								<div class='row'>
                                    <div class="col-md-offset-4 col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Confirme a Senha Nova</label>
                                            <input type="password" name="confirme_s" value="<?php echo $confirme_s?>" class="form-control" id="exampleInputEmail1" placeholder="Confirme a nova senha">
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
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>
<?php   
    require './include/conexao.php';
    require './include/config.php';
    require './include/funcoes.php';
	require './include/verifica_usuario.php';
	
	if(isset($_GET['paciente'])){
		$paciente_id = (int)$_GET['paciente'];
	}
	
?>

<!DOCTYPE html>

<html lang="pt-br">
    <head>
	<meta charset="UTF-8">
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
                    <div class="col-md-10 corpo">
                        <div class="page-header">                            
                            <div class=" col-md-10 titulo_tela" >Imprimir Evoluções</div>  
								<div class="col-md-1 link_tela">
									<a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Paciente</a>     
								</div>							
                        </div>
                        <div class="conteudo">
                            <div id="grava"></div>
                            <form method="POST" action="imprimir_evolucoes.php?paciente=<?php echo $paciente_id?>" target="_blank">
                                 <div class='row'>
                                    <div class="col-md-2 col-md-offset-4">                                        
                                        <div class="form-group">
                                            <label>Data Inicio</label>
                                            <input type="text" name="data_inicio" id="data_inicio" maxlength="10" class="form-control" value="<?php echo $data_inicio?>" onkeypress="Formatadata(this,event)" >
                                        </div>
                                    </div>
									<div class="col-md-2">                                        
                                        <div class="form-group">
                                            <label>Data Fim</label>
                                            <input type="text" name="data_fim" id="data_fim" maxlength="10" class="form-control" value="<?php echo $data_fim?>" onkeypress="Formatadata(this,event)">
                                        </div>
                                    </div>
								</div>
                         
			
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align: center">
                                         <input type="submit" name="btnacao" value="Gerar" class="btn btn-success" > 
										 <input type="hidden" name="paciente" value="<?php echo $paciente_id ?>">
                                    </div>
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
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>
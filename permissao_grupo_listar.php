<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
		

		 if(isset($_POST['btnacao'])){
			 $grupo_usuario = $_POST['grupo_usuario_id'];
				header("Location: permissao_grupo_cadastrar.php?grupo=$grupo_usuario");
			 
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
		<script src="js/jquery.js" ></script>
		
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
                            <div class=" col-md-10 titulo_tela" >Permissão Grupo</div>
                            <a href="permissao_cadastrar.php" class="btn btn-success btn-sm">Voltar</a>
							
                        </div>
                        <?php if (strlen(trim($erro)) > 0): ?>
                            <div class="alert alert-danger">
                                <i class="icon-remove-sign"></i>
                                <?php echo $erro ?>
                            </div>
                        <?php endif; ?>
                        <?php if (strlen(trim($ok)) > 0): ?>
                            <div class="alert alert-success">
                                <i class="icon-ok"></i>
                                <?php echo $ok ?>
                            </div>
                        <?php endif; ?>
                        <div class="conteudo">
                            <div class="col-md-12" id="home">
                                   <form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="" target="_blank">
                                            <div class='row'>
                                                <div class="col-md-offset-4 col-md-4">
													<div class="form-group">
														<label  for="exampleInputEmail1">Grupos de Usuário</label>
														<select name="grupo_usuario_id" id = "grupo_usuario_id" name="grupo_usuario_id" class="form-control">
														<option value="">Tipos</option>       
														<?php 
															$sql_grupo = "SELECT grupo_usuario, descricao FROM tbl_grupo_usuario where status_id = 1 order by descricao";
															$res_grupo = pg_query($con, $sql_grupo);
															for($i =0; $i<pg_num_rows($res_grupo); $i++){
																$grupo_usuario     = pg_fetch_result($res_grupo, $i, 'grupo_usuario');
																$descricao         = pg_fetch_result($res_grupo, $i, 'descricao');

																	if($grupo_usuario_id == $grupo_usuario){
																		$selected = " selected ";
																	}else{
																		$selected = " ";
																	}
																echo "<option value='$grupo_usuario' $selected >$descricao</option>";
	
															}
														?>
														
														</select>
													</div>
                                                </div>		
                                            </div>                                 
                                       
											
										 
									<div class="row">
										<div class="col-md-12 botao">
											<input class="btn btn-success" type="submit" name="btnacao" value="Proximo">
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
		
	
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>
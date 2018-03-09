<?php

	include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";

	if(isset($_GET['grupo'])){
		$id_grupo = $_GET['grupo'];
		$sql_grupo = "SELECT grupo_usuario, descricao FROM tbl_grupo_usuario WHERE status_id = 1 AND grupo_usuario = $id_grupo";
		$res_grupo = pg_query($con, $sql_grupo);
			if(pg_num_rows($res_grupo) > 0){
				$descricao = pg_fetch_result($res_grupo, 0, 'descricao');
			}
	}
	
	if(isset($_GET['excluir'])){
        $id_permissao = (int)$_GET['excluir'];
		$id_grupo = (int)$_GET['grupo'];

        $sql_excluir = "DELETE FROM tbl_grupo_usuario_permissao WHERE grupo_usuario_id = $id_grupo AND permissao_id = $id_permissao";
		$res_excluir = pg_query($con, $sql_excluir);
        
        if(strlen(trim(pg_last_error($con))) == 0){
            $ok .= "Permissão retirada com Sucesso.";
			header("Location: permissao_grupo_cadastrar.php?grupo=$id_grupo");
        }else{
            $erro .= "Falha ao retirar a permissão. <br>Consulte o administrador do sistema. ";
        }
    }
	
	if(isset($_POST["btnacao"])){
		$grupo = $_POST['grupo'];
		for($j=0; $j<$grupo; $j++){
			
				$permissao = $_POST["permissao_$j"];
				
				$sql_verifica_permissao = "SELECT *FROM tbl_grupo_usuario_permissao WHERE grupo_usuario_id = $id_grupo AND permissao_id = $permissao";
				$res_verifica_permissao = pg_query($con, $sql_verifica_permissao);
			
				if(pg_num_rows($res_verifica_permissao) == 0){
					$sql = "INSERT INTO tbl_grupo_usuario_permissao(grupo_usuario_id, permissao_id)
							VALUES ($id_grupo, $permissao)";
					$res = pg_query($con, $sql);
				}
		}
		$ok .= "Cadastro realizado com sucesso";
    }
	
	
		$sql_permissao = "SELECT *from tbl_permissao ORDER BY descricao";
		$res_permissao = pg_query($con, $sql_permissao);

		
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
		<script type="text/javascript">
			function confirma(){
			   var press = confirm("Tem certeza que deseja retirar esta Permissão ?");
				if(press){
					alert("Permissão retirada com sucesso");
					return true;
				}else{
					return false;
				}
			}
		</script>
		
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
                            <div class=" col-md-10 titulo_tela" >Permissão Grupo: <b><?=$descricao?></b> </div>
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
                               <form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="" >
									<div class='row'>
										<div class="col-md-offset-5 col-md-2">
											<b>Permissões</b>
										</div>
									</div>
									</div>
									<div class="row">
											<div class="col-md-12">
												<table class="table table-striped">
													<tr>
														<th>#</th>
														<th>Permissão</th>
														<th>Permitir</th>
														<th>Excluir</th>
													</tr>
														<?php 
														$sql_verifica = "SELECT grupo_usuario_id, permissao_id FROM tbl_grupo_usuario_permissao 
															WHERE grupo_usuario_id = $id_grupo";
														$res_verifica = pg_query($con, $sql_verifica);
														
														
														for($i = 0; $i<pg_num_rows($res_permissao); $i++){ 
															$permissao_id      = pg_fetch_result($res_permissao, $i, 'permissao');
															$descricao         = pg_fetch_result($res_permissao, $i, 'descricao');
															
															for($j=0; $j<pg_num_rows($res_verifica); $j++){
																$id_permissao_cadastrada = pg_fetch_result($res_verifica, $j, 'permissao_id');
																if($id_permissao_cadastrada == $permissao_id){
																	$check = "checked";
																}
															}
															echo "<tr>
																<td>".($i+1)."</td>
																<td>$descricao</td>
																<td><input type='checkbox' name='permissao_$i' value='$permissao_id' $check> </td>
																<td><a href='./permissao_grupo_cadastrar.php?excluir=$permissao_id&grupo=$id_grupo' onclick='return confirma()' title='Excluir'><i class='fa fa-trash-o'></i></a></td>
															</tr>";
															
															$check = "";
														} ?>
												</table>
											</div>
									</div>					
                                       
												
									<div class="row">
										<div class="col-md-12 botao">
											<input type="hidden" name="grupo" value="<?php echo pg_num_rows($res_permissao) ?>">
											<input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
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
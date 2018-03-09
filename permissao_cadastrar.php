<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";
	
	
	if(isset($_GET['permissao'])){
			$permissao_id = (int)$_GET['permissao'];
			$sql_editar= "select * from tbl_permissao WHERE permissao = $permissao_id";
			$res_editar = pg_query($con, $sql_editar);
				$descricao = pg_fetch_result($res_editar, 0, 'descricao');
		}
		
		
    if(isset($_POST["btnacao"])){

        $descricao		= fncTrataDados($_POST["descricao"]);
		$permissao_id	= (int)$_POST["permissao"];
		

        if(strlen(trim($descricao)) == 0){
            $erro .= "O campo Descrição deve ser preenchido. <br>";
        }
       
        if(empty($erro)){
            if($permissao_id == 0){
                $sql = "INSERT INTO tbl_permissao (descricao)  
                VALUES ('$descricao')";
            }else{
                $sql = "UPDATE tbl_permissao SET descricao = '$descricao'
                WHERE permissao = $permissao_id";
            }
            $res = pg_query($con, $sql);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";

            }
        }
    }

		$sql_permissao = "SELECT *from tbl_permissao ORDER BY descricao";
		$res_permissao = pg_query($con, $sql_permissao);

    if(isset($_GET['excluir'])){
        $permissao_id = (int)$_GET['excluir'];

        $sql = "DELETE from tbl_permissao where permissao = $permissao_id";
        $res = pg_query($con, $sql);

        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Permissão excluída com Sucesso.";
        }else{
            $erro .= "Falha ao tirar a permissão usuário. <br>Consulte o administrador do sistema. ";
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
		<script type="text/javascript">
			function excluir(){
				var press = confirm("tem certeza que deseja excluir ?");
				if(press){
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
                            <div class=" col-md-10 titulo_tela" >Permissão</div>
                            <a href="permissao_cadastrar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Novo</a>
							<a href="permissao_grupo_listar.php" class="btn btn-success btn-sm">Grupo</a>
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
                                   <form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="">
                                        <div id="funcionario_2">
                                            <div class='row'>
                                                <div class="col-md-offset-4 col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Descrição</label>
                                                        <input type="text" name="descricao" value="<?php echo $descricao ?>" class="form-control" id="exampleInputEmail1" placeholder="Descrição">
                                                    </div>
                                                </div>
                                            </div>                                 
                                        </div>
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="permissao" value="<?php echo $permissao_id ?>">
                                    </div>
                                </div>
                               </form>

                            </div>
					   
							<br>
						<?php 
							if(pg_num_rows($res_permissao)>0){
								
						?>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-striped">
									<tr>
										<th>#</th>
										<th>Permissão</th>
										<th colspan="2">Ações</th>
									</tr>
								<?php for($i = 0; $i<pg_num_rows($res_permissao); $i++){ 
								$permissao_id      = pg_fetch_result($res_permissao, $i, 'permissao');
								$descricao         = pg_fetch_result($res_permissao, $i, 'descricao');
								echo "<tr>
										<td>".($i+1)."</td>
										<td>$descricao</td>
										<td class='col-md-1'><a href='permissao_cadastrar.php?permissao=$permissao_id' title='Editar'><i class='fa fa-pencil-square-o'></i></a></td>
										<td class='col-md-1'><a href='permissao_cadastrar.php?excluir=$permissao_id' onclick='return excluir()' title='Excluir'><i class='fa fa-trash-o'></i></a></td>
									</tr>";
										} ?>
									</table>

							</div>
						</div>
						<?php }  ?>    
                </div>
                <div class="row">
                    <?php include RAIZ."include/footer.php" ?>
                </div>
            </div>
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
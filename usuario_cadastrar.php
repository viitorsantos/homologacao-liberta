<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";

	if(isset($_POST["btnacao"])){
        $usuario_login  = fncTrataDados(fnc_maiusculas($_POST["usuario_login"]));
        $senha          = fncTrataDados($_POST["senha"]);
        $ativo          = fncTrataDados($_POST["ativo"]);
        $ativo          = ($ativo == "") ? "f" : "t";
        $data_expiracao = fncTrataDados($_POST["data_expiracao"]);
        $user           = (int)$_POST["user"];
		$funcionario_id = (int)$_POST["funcionario_id"];
		
		
        if(strlen(trim($usuario_login)) == 0){
            $erro .= "O campo login deve ser preenchido. <br>";
        }
        if(strlen(trim($senha)) == 0){
            $erro .= "O campo senha deve ser preenchido. <br>";
        }
        if(empty($erro)){
            if($user == 0){
                $sql = "INSERT INTO tbl_usuario (login, senha, ativo,  funcionario_id)  
                VALUES ('$usuario_login', '$senha', '$ativo',  $funcionario_id)";
            }else{
                $sql = "UPDATE tbl_usuario SET login = '$usuario_login', senha = '$senha', ativo='$ativo', funcionario_id=$funcionario_id WHERE usuario = $user"; 
            }
            $res = pg_query($con, $sql);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
            }
			
        }
    }
	
	if(isset($_GET['funcionario'])){
        $funcionario_id = (int)$_GET['funcionario'];

        $sql_user = "select * from tbl_usuario where funcionario_id = $funcionario_id";
        $res_user = pg_query($con, $sql_user);
		if(pg_num_rows($res_user)>0){
			$usuario_login      = pg_fetch_result($res_user, 0, 'login');
			$senha      		= pg_fetch_result($res_user, 0, 'senha');
			$ativo      		= pg_fetch_result($res_user, 0, 'ativo'); 
			$user      			= pg_fetch_result($res_user, 0, 'usuario'); 			
		}         
    }
	
	

    /*if(isset($_GET['usuario'])){
        $user = (int)$_GET['usuario'];

        $sql_user = "select * from tbl_usuario where usuario = $user";
        $res_user = pg_query($con, $sql_user);
        $login      = pg_fetch_result($res_user, 0, 'login');
        $senha      = pg_fetch_result($res_user, 0, 'senha');
        $ativo      = pg_fetch_result($res_user, 0, 'ativo');   
    }*/
    /*
    if(isset($_GET['excluir'])){
        $user = (int)$_GET['excluir'];

        $sql = "DELETE from tbl_usuario where usuario = $user";
        $res = pg_query($con, $sql);

        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Cadastro excluído com Sucesso.";
        }else{
            $erro .= "Falha ao excluir o cadastro. <br>Consulte o administrador do sistema. ";
        }
    }
*/
    

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
                            <div class=" col-md-10 titulo_tela" >Usuário</div>
                            <div class="col-md-2 link_tela">
                                
                            </div>
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
                                                        <label for="exampleInputEmail1">Login</label>
                                                        <input type="text" name="usuario_login" value="<?php echo $usuario_login?>" class="form-control" id="exampleInputEmail1" placeholder="Login">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class='row'>
                                                <div class="col-md-offset-4 col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Senha</label>
                                                        <input type="password" name="senha" value="<?php echo $senha?>" class="form-control" id="exampleInputEmail1" placeholder="Digite sua senha">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-offset-4 col-md-4">
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" name="ativo" id="inlinecheckbox" value="t" <?php  if($ativo== t) echo " checked "; ?>>Ativo
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class='row'>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tipo de Usuário</label>
                                                        <input type="text" name="tp_usuario" value="<?php echo $tp_usuario ?>" class="form-control" id="exampleInputEmail1" placeholder="Tipo de Usuário">
                                                    </div>
                                                </div>
                                            </div>-->
                                        </div>
                                    
                                    </div>
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="user" value="<?php echo $user ?>">
										<input type="hidden" name="funcionario_id" value="<?php echo $funcionario_id ?>">
										
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
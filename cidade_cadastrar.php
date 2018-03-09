<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";

    if(isset($_POST["btnacao"])){

        $descricao          =   fncTrataDados($_POST["descricao"]);
        $estado             =   fncTrataDados($_POST["estado"]);
        $codigo             =   fncTrataDados($_POST["codigo"]);
        $cidade_id          =   fncTrataDados($_POST["cidade_id"]);


        if(strlen(trim($descricao)) == 0){
            $erro .= "O campo Cidade deve ser preenchido. <br>";
        }
        if(strlen(trim($estado)) == 0){
            $erro .= "O campo Estado deve ser preenchido. <br>";
        }
       
        if(empty($erro)){
            if($cidade_id == 0){
                $sql = "INSERT INTO tbl_cidade (descricao, estado)  
                VALUES ('$descricao', '$estado')";
            }else{
                $sql = "UPDATE tbl_cidade SET descricao = '$descricao', estado = '$estado'
                WHERE cidade = $cidade_id";
            }
            $res = pg_query($con, $sql);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
                $descricao          =   "";
                $estado             =   "";
                $cidade_id          =  "";
            }
        }
    }

    if(isset($_GET['cidade'])){
        $cidade_id = (int)$_GET['cidade'];

        $sql_cidade = "select * from tbl_cidade where cidade = $cidade_id ";
        $res_cidade = pg_query($con, $sql_cidade);
            $descricao      = pg_fetch_result($res_cidade, 0, 'descricao');
            $estado         = pg_fetch_result($res_cidade, 0, 'estado');
    }

  if(isset($_GET['excluir'])){
        $cidade_id = (int)$_GET['excluir'];

        $sql = "UPDATE tbl_cidade SET status_id = 2 where cidade = $cidade_id";
        $res = pg_query($con, $sql);
        
        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Cidade excluída com Sucesso.";
			header("Location: cidade_listar.php");
        }else{
            $erro .= "Falha ao excluir a Cidade. <br>Consulte o administrador do sistema. ";
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
                            <div class=" col-md-10 titulo_tela" >Cidade</div>
                            <div class="col-md-2 link_tela">
                                <a href="cidade_listar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Lista</a>        
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
                                                <div class="col-md-offset-3 col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Cidade*</label>
                                                        <input type="text" name="descricao" value="<?php echo $descricao ?>" class="form-control" id="exampleInputEmail1" placeholder="Nome da Cidade">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Estado*</label>
                                                        <input type="text" name="estado" value="<?php echo $estado ?>" class="form-control" id="exampleInputEmail1" placeholder="UF" maxlength="2">
                                                    </div>
                                                </div>
                                            </div>                                 
                                        </div>
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="cidade_id" value="<?php echo $cidade_id ?>">
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
<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";

    if(isset($_POST["btnacao"])){

        $nome               =   fncTrataDados($_POST["nome"]);
        $email              =   fncTrataDados($_POST["email"]);
        $telefone           =   fncTrataDados($_POST["telefone"]);
        $ddd_tel            =   fncTrataDados($_POST["ddd_tel"]);
        $celular            =   fncTrataDados($_POST["celular"]);
        $ddd_cel            =   fncTrataDados($_POST["ddd_cel"]);
        $cidade_id          =   fncTrataDados($_POST["cidade_id"]);
        $fornecedor_id      =   fncTrataDados($_POST["fornecedor_id"]);
	    $empresa_id         =   fncTrataDados($_POST["empresa_id"]);


        if(strlen(trim($nome)) == 0){
            $erro .= "O campo Nome deve ser preenchido. <br>";
        }
        if(strlen(trim($email)) == 0){
            $erro .= "O campo Email deve ser preenchido. <br>";
        }
		 
        if(strlen(trim($ddd_cel)) == 0){
            $erro .= "O campo DDD deve ser preenchido. <br>";
        }
        if(strlen(trim($celular)) == 0){
            $erro .= "O campo Celular deve ser preenchido. <br>";
        }
		if(strlen(trim($cidade_id)) == 0){
            $erro .= "O campo Cidade deve ser preenchido. <br>";
        }

        if(empty($erro)){
            if($fornecedor_id == 0){
                $sql = "INSERT INTO tbl_fornecedor (nome, email, telefone, ddd_tel, celular, ddd_cel, cidade_id, empresa_id)  
                VALUES ('$nome', '$email', '$telefone', '$ddd_tel', '$celular', '$ddd_cel', '$cidade_id',  ".EMPRESA.")";
            }else{
                $sql = "UPDATE tbl_fornecedor SET nome = '$nome', email = '$email', telefone = '$telefone', ddd_tel = '$ddd_tel', celular = '$celular', ddd_cel = '$ddd_cel',  cidade_id = $cidade_id, empresa_id = ".EMPRESA."
                WHERE fornecedor = $fornecedor_id";
            }
               
            $res = pg_query($con, $sql);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
            }
        }
    }

    if(isset($_GET['fornecedor'])){
        $fornecedor_id = (int)$_GET['fornecedor'];

        $sql_fornecedor = "select * from tbl_fornecedor where fornecedor = $fornecedor_id ";
        $res_fornecedor = pg_query($con, $sql_fornecedor);
            $nome           = pg_fetch_result($res_fornecedor, 0, 'nome');
            $email          = pg_fetch_result($res_fornecedor, 0, 'email');
            $telefone       = pg_fetch_result($res_fornecedor, 0, 'telefone');
            $ddd_tel        = pg_fetch_result($res_fornecedor, 0, 'ddd_tel');
            $celular        = pg_fetch_result($res_fornecedor, 0, 'celular');
            $ddd_cel        = pg_fetch_result($res_fornecedor, 0, 'ddd_cel');      
            $cidade_id      = pg_fetch_result($res_fornecedor, 0, 'cidade_id');
          
    }
	
     if(isset($_GET['excluir'])){
        $fornecedor_id = (int)$_GET['excluir'];

        $sql = "UPDATE tbl_fornecedor SET status_id = 2 where fornecedor = $fornecedor_id";
        $res = pg_query($con, $sql);
        
        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Fornecedor excluído com Sucesso.";
			header("Location: fornecedor_listar.php");
        }else{
            $erro .= "Falha ao excluir o Fornecedor. <br>Consulte o administrador do sistema. ";
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
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
        
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
			$(document).ready(function(){
				$("#campoData").mask("99/99/9999");
				$("#campoCpf").mask("999.999.999-99");
				$("#campoCep").mask("99.999-999");
				$("#campoRg").mask("99.999.999-*");
				$("#campoDdd").mask("999");
				$("#campoTel").mask("9999-9999");
				$("#campoCel").mask("99999-9999")
			});
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
                            <div class=" col-md-10 titulo_tela" >Fornecedor</div>
							 <a href="fornecedor_listar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Lista</a>
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
                                                <div class="col-md-11">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nome*</label>
                                                        <input type="text" name="nome" value="<?php echo $nome ?>" class="form-control" id="exampleInputEmail1" placeholder="Nome">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class="col-md-11">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">E-mail*</label>
                                                        <input type="text" name="email" value="<?php echo $email ?>" class="form-control" id="exampleInputEmail1" placeholder="E-Mail">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">DDD</label>
                                                        <input type="text" name="ddd_tel" value="<?php echo $ddd_tel?>" class="form-control" id="exampleInputEmail1" id="campoDdd" placeholder="DDD" maxlength="2">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Telefone</label>
                                                        <input type="text" name="telefone" value="<?php echo $telefone ?>" class="form-control" id="exampleInputEmail1" placeholder="Telefone" maxlength="8">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">DDD*</label>
                                                        <input type="text" name="ddd_cel" value="<?php echo $ddd_cel?>" class="form-control" id="exampleInputEmail1" placeholder="DDD" maxlength="2">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Celular*</label>
                                                        <input type="text" name="celular" value="<?php echo $celular ?>" class="form-control" id="exampleInputEmail1" placeholder="Celular" maxlength="9">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Cidade*</label>
                                                    <select name="cidade_id" class="form-control">
                                                    <option value="">Cidade</option>       
                                                    <?php 
                                                        $sql_cidade = "SELECT cidade, descricao, estado FROM tbl_cidade where status_id = 1 ORDER BY descricao";
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
                                 
                                        </div>
                                                                       
                                </div>
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="fornecedor_id" value="<?php echo $fornecedor_id ?>">
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
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>
<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";


    if(isset($_POST["btnacao"])){

        $descricao         =   fncTrataDados($_POST["descricao"]);
        $qtd               =   fncTrataDados($_POST["qtd"]);
        $valor             =   fncTrataDados($_POST["valor"]);
        $produto_id        =   fncTrataDados($_POST["produto_id"]);
		$fornecedor_id	   =	(int)$_POST["fornecedor_id"];
        $valor             = str_replace(",", ".", $valor);


        if(strlen(trim($descricao)) == 0){
            $erro .= "O campo Descrição deve ser preenchido. <br>";
        }
        if(strlen(trim($qtd)) == 0){
            $erro .= "O campo Quantidade deve ser preenchido. <br>";
        }
        if(strlen(trim($valor)) == 0){
            $erro .= "O campo Valor deve ser preenchido. <br>";
        }
		  if($fornecedor_id == 0){
            $erro .= "O campo Fornecedor deve ser preenchido.<br>";
        }
       
        if(empty($erro)){
            if($produto_id == 0){
                $sql = "INSERT INTO tbl_produto (descricao, qtde, valor, fornecedor_id, empresa_id)  
                VALUES ('$descricao', '$qtd', '$valor','$fornecedor_id',".EMPRESA." )";
            }else{
                $sql = "UPDATE tbl_produto SET descricao = '$descricao', qtde = '$qtd', valor = '$valor',fornecedor_id = '$fornecedor_id', empresa_id = ".EMPRESA."
                WHERE produto = $produto_id";
            }
            $res = pg_query($con, $sql);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Produto Cadastrado com Sucesso.";
            }
        }
    }

    if(isset($_GET['produto'])){
        $produto_id = (int)$_GET['produto'];

        $sql_produto = "select * from tbl_produto where produto = $produto_id ";
        $res_produto = pg_query($con, $sql_produto);
            if(pg_num_rows($res)>0){
                $descricao      = pg_fetch_result($res_produto, 0, 'descricao');
                $qtd            = pg_fetch_result($res_produto, 0, 'qtde');
                $valor          = pg_fetch_result($res_produto, 0, 'valor');
				$fornecedor_id	= pg_fetch_result($res_produto, 0, 'fornecedor_id');
            }           
    }

  if(isset($_GET['excluir'])){
        $produto_id = (int)$_GET['excluir'];

        $sql = "DELETE from tbl_produto WHERE produto = $produto_id";
        $res = pg_query($con, $sql);
        
        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Produto excluído com Sucesso.";
			header("Location: produtos_listar.php");
        }else{
            $erro .= "Falha ao excluir o Produto. <br>Consulte o administrador do sistema. ";
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
                            <div class=" col-md-10 titulo_tela" >Produto</div>
                            <div class="col-md-2 link_tela">
                                <a href="produtos_listar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Lista</a>      
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
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Descrição*</label>
                                                        <input type="text" name="descricao" value="<?php echo $descricao ?>" class="form-control" id="exampleInputEmail1" placeholder="Descrição">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">QTD*</label>
                                                        <input type="text" name="qtd" value="<?php echo $qtd?>"  onkeypress='return SomenteNumero(event)' class="form-control" id="exampleInputEmail1" placeholder="Qtd">
                                                    </div>
                                                </div>
                                                 <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Valor*</label>
                                                        <input type="text" name="valor" value="<?php echo $valor?>"   class="form-control" id="exampleInputEmail1" placeholder="R$">
                                                    </div>
                                                </div>
												 <div class="col-md-3">
                                                    <div class="form-group">
													<label  for="exampleInputEmail1">Fornecedor*</label>
													<select name="fornecedor_id" class="form-control">
														<option value="">Fornecedor</option>       
														<?php 
														$sql_fornecedor = "SELECT fornecedor, nome FROM tbl_fornecedor where status_id = 1 ORDER BY nome";
														$res_fornecedor = pg_query($con, $sql_fornecedor);
														for($i =0; $i<pg_num_rows($res_fornecedor); $i++){
															$fornecedor   = pg_fetch_result($res_fornecedor, $i, 'fornecedor');
															$nome         = pg_fetch_result($res_fornecedor, $i, 'nome');

																if($fornecedor_id == $fornecedor){
																	$selected = " selected ";
																}else{
																	$selected = " ";
																}
															echo "<option value='$fornecedor' $selected >$nome</option>";
														}
														?>
													</select>
												</div>
                                                </div>
                                            </div>
                                        </div>                                 
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="produto_id" value="<?php echo $produto_id ?>">
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
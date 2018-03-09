<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";

    if(isset($_POST["btnacao"])){

        $observacao               =   fncTrataDados($_POST["observacao"]);
        $paciente_id              =   (int)$_POST["paciente"];
        $receita_id               =   (int)$_POST["receita"];
		$funcionario_id           =   (int)$_POST["funcionario"];
	

	

        if(strlen(trim($observacao)) == 0){
            $erro .= "O campo Orientações deve ser preenchido. <br>";
        }
        
        if(empty($erro)){
            if($receita_id == 0){
                $sql = "INSERT INTO tbl_receita (paciente_id, observacao, empresa_id, medico)  
                VALUES ($paciente_id, '$observacao', ".EMPRESA.", $_funcionario_id)returning receita";
            }else{
                $sql = "UPDATE tbl_receita SET paciente_id = '$paciente_id', observacao = '$observacao', empresa_id = ".EMPRESA.", medico = '$_funcionario_id'
                WHERE receita = $receita_id returning receita";
            }
			

               
            $res = pg_query($con, $sql);
			$receita_id       = pg_fetch_result($res, 0, 'receita');
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
			    header("Location: imprimir_orientacoes.php?receita=$receita_id&paciente=$paciente_id&funcionario=$_funcionario_id");
            }
        }
    }

    if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];

        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
        if(pg_num_rows($res_paciente) > 0){
             $nome           = pg_fetch_result($res_paciente, 0, 'nome');
             $telefone       = pg_fetch_result($res_paciente, 0, 'telefone');
             
        }      
    }
    if(isset($_GET["receita"])){
        $receita = (int)$_GET["receita"];
        $sql_receita = "SELECT observacao FROM tbl_receita 
                        WHERE paciente_id= $paciente_id and empresa_id = ".EMPRESA." and receita = $receita";
        $res_receita = pg_query($con, $sql_receita);
        if(pg_num_rows($res_receita) > 0){
             $observacao           = pg_fetch_result($res_receita, 0, 'observacao');
        }
    }


	
	if(isset($_GET['funcionario'])){
        $funcionario_id = (int)$_GET['funcionario'];

        $sql_funcionario = "select * from tbl_funcionario where funcionario = $funcionario_id  ";
        $res_funcionario = pg_query($con, $sql_funcionario);
        if(pg_num_rows($res_funcionario) > 0){
			 $funcionario_id     = pg_fetch_result($res_funcionario, 0, 'funcionario');
             $nome_funcionario   = pg_fetch_result($res_funcionario, 0, 'nome');
             
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
        <link rel="stylesheet" type="text/css" href="./editor/bootstrap3-wysihtml5.min.css"></link>

        <style type="text/css" media="screen">
          .btn.jumbo {
            font-size: 20px;
            font-weight: normal;
            padding: 14px 24px;
            margin-right: 10px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
          }
        </style>
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
                            <div class=" col-md-9 titulo_tela" >Declaração</div>
                         <div class="col-md-3 link_tela">
						        <a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-success btn-sm">
									<i class="fa fa-list-alt"></i>Paciente</a>	
                                <a href="receitas_listar.php?paciente=<?php echo $paciente_id ?>" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Lista</a>       
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
                                 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                      <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                         Paciente
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="panel-body">
                                        <div class='row'>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nome</label>
                                                    <?php echo $nome?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label  for="exampleInputEmail1">Telefone</label>
                                                    <?php echo $telefone?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>		
                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
                                <form id="frm_ficha" method="POST" action="">
                                    <div class="row" id="observacao">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Declaração</label>
                                               <textarea name='observacao' class="textarea" placeholder="Enter text ..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;"><?php echo $observacao ?></textarea>                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 botao">
                                            <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                            <input type="hidden" name="paciente" value="<?php echo $paciente_id ?>">
                                            <input type="hidden" name="receita" value="<?php echo $receita ?>">
                                            <input type="hidden" name="empresa" value="<?php echo EMPRESA ?>">
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

            <script src="./editor/wysihtml5x-toolbar.min.js"></script>
            <!--<script src="./editor/jquery.min.js"></script>
            <script src="./editor/bootstrap.min.js"></script>-->
            <script src="./editor/runtime.min.js"></script>
            <script src="./editor/bootstrap3-wysihtml5.min.js"></script>

            <script>
              $('.textarea').wysihtml5();
            </script>
        </div>
    </body>
</html>
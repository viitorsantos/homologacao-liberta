<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
    include "include/verifica_usuario.php";


    if(isset($_POST["btnacao"])){

        $sala_medico_id        =   fncTrataDados($_POST["sala_medico_id"]);
        $nome                  =   fncTrataDados($_POST["nome"]);
        $data                  =   fncTrataDados($_POST["data"]);
        $convenio              =   fncTrataDados($_POST["convenio"]);
		$data1                 =   fncTrataDados($_POST["data1"]);
		$data2                 =   fncTrataDados($_POST["data2"]);
		$data3                 =   fncTrataDados($_POST["data3"]);
		
	

        if(strlen(trim($nome)) == 0){
            $erro .= "O campo Nome deve ser preenchido. <br>";
        }
       
       
        if(empty($erro)){
            if($sala_medico_id == 0){
                $sql = "INSERT INTO tbl_sala_medico (nome, data, convenio, data1, data2, data3)  
                VALUES ('$nome', '".fnc_formata_data($_POST["data"])."', '$convenio','".fnc_formata_data($_POST["data1"])."',
				'".fnc_formata_data($_POST["data2"])."', '".fnc_formata_data($_POST["data3"])."')";
            }else{
                $sql = "UPDATE tbl_sala_medico SET nome = '$nome', data = '".fnc_formata_data($_POST["data"])."', convenio = '$convenio',
				data1 = '".fnc_formata_data($_POST["data1"])."', data2 = '".fnc_formata_data($_POST["data2"])."', data3 = '".fnc_formata_data($_POST["data3"])."'
                WHERE sala_medico = $sala_medico_id";
            }
            $res = pg_query($con, $sql);
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastrado com Sucesso.";
            }
        }
    }

    if(isset($_GET['sala_medico'])){
        $sala_medico_id = (int)$_GET['sala_medico'];

        $sql_salamedico = "select * from tbl_sala_medico where sala_medico = $sala_medico_id ";
        $res_salamedico = pg_query($con, $sql_salamedico);
            if(pg_num_rows($res)>0){
                $nome          = pg_fetch_result($res_salamedico, 0, 'nome');
				$data          = fnc_data_formatada(pg_fetch_result($res_salamedico, 0, 'data'));
				$convenio      = pg_fetch_result($res_salamedico, 0, 'convenio');
				$data1         = fnc_data_formatada(pg_fetch_result($res_salamedico, 0, 'data1'));
				$data2         = fnc_data_formatada(pg_fetch_result($res_salamedico, 0, 'data2'));
				$data3         = fnc_data_formatada(pg_fetch_result($res_salamedico, 0, 'data3'));
				
            }           
    }

	
  if(isset($_GET['excluir'])){
        $sala_medico_id = (int)$_GET['excluir'];

        $sql = "DELETE from tbl_sala_medico WHERE sala_medico = $sala_medico_id";
        $res = pg_query($con, $sql);
        
        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Excluído com Sucesso.";
			header("Location: residentes_listar.php");
        }else{
            $erro .= "Falha ao excluir. <br>Consulte o administrador do sistema. ";
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
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
		<link href="<?php echo RAIZ ?>css/estilo.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		  <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>		
        
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
       <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]--> 
		 <script>        
			   $(document).ready(function(){
					
					$("#data").mask("99/99/9999");
					$("#data1").mask("99/99/9999");
					$("#data2").mask("99/99/9999");
					$("#data3").mask("99/99/9999");
				
			
				});     
        </script>
		  
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
                            <div class=" col-md-10 titulo_tela" >Sala do Médico</div>
                            <div class="col-md-2 link_tela">
                                <a href="residentes_listar.php" class="btn btn-success btn-sm"><i class="fa fa-list-alt"></i>Lista</a>      
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
												<div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nome*</label>
                                                        <input type="text" name="nome" value="<?php echo $nome ?>" class="form-control"  placeholder="Nome">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Data</label>
                                                        <input type="text" name="data" id="data" value="<?php echo $data?>" maxlength="10" class="form-control"  placeholder="Data">
                                                    </div>
                                                </div>
                                                 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Convênio</label>
                                                        <input type="text" name="convenio" value="<?php echo $convenio?>"   class="form-control" id="exampleInputEmail1" placeholder="Convênio">
                                                    </div>
                                                </div>
                                        </div> 
										<div class='row'>
											 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Data 1</label>
                                                        <input type="text" name="data1" value="<?php echo $data1?>" maxlength="10" class="form-control" id="data1" placeholder="Data 1">
                                                    </div>
                                                </div>
												 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Data 2</label>
                                                        <input type="text" name="data2" value="<?php echo $data2?>" maxlength="10" class="form-control" id="data2" placeholder="Data 2">
                                                    </div>
                                                </div>
												 <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Data 3</label>
                                                        <input type="text" name="data3" value="<?php echo $data3?>" maxlength="10" class="form-control" id="data3" placeholder="Data 3">
                                                    </div>
                                                </div>
										</div>
									 	
                                <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-success" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="sala_medico_id" value="<?php echo $sala_medico_id ?>">
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
     
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
         
        </div>
    </body>
</html>